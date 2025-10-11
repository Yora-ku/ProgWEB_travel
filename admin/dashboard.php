<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

include '../config/connect.php';

// Total data
$totalDest = $conn->query("SELECT COUNT(*) AS total FROM destinations")->fetch_assoc()['total'];
$totalBook = $conn->query("SELECT COUNT(*) AS total FROM bookings")->fetch_assoc()['total'];
$totalUser = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

// --- 📊 Ambil data booking per jam (hari ini) ---
$chartData = [];
$query = "
    SELECT HOUR(created_at) AS jam, COUNT(*) AS total
    FROM bookings
    WHERE DATE(created_at) = CURDATE()
    GROUP BY jam
    ORDER BY jam ASC
";
$result = $conn->query($query);

// Isi data 0–23 biar tetap tampil walau jam tertentu kosong
for ($i = 0; $i < 24; $i++) {
    $chartData[$i] = 0;
}
while ($row = $result->fetch_assoc()) {
    $chartData[(int)$row['jam']] = (int)$row['total'];
}

$labels = [];
$data = [];
foreach ($chartData as $hour => $count) {
    $labels[] = sprintf('%02d:00', $hour);
    $data[] = $count;
}

// Ambil aktivitas terbaru
$aktivitas = [];

// destinasi baru
$resDest = $conn->query("SELECT name, created_at FROM destinations ORDER BY created_at DESC LIMIT 3");
while ($row = $resDest->fetch_assoc()) {
    $aktivitas[] = [
        'type' => 'destination',
        'desc' => "🧭 Destinasi baru ditambahkan: <strong>{$row['name']}</strong>",
        'time' => $row['created_at']
    ];
}

// booking baru
$resBook = $conn->query("SELECT b.booking_id, u.username, d.name AS destination, b.created_at 
                         FROM bookings b 
                         JOIN users u ON b.user_id = u.user_id 
                         JOIN destinations d ON b.destination_id = d.destination_id 
                         ORDER BY b.created_at DESC LIMIT 3");
while ($row = $resBook->fetch_assoc()) {
    $aktivitas[] = [
        'type' => 'booking',
        'desc' => "📆 Pemesanan oleh <strong>{$row['username']}</strong> untuk <strong>{$row['destination']}</strong>",
        'time' => $row['created_at']
    ];
}

// user baru
$resUser = $conn->query("SELECT username, created_at FROM users ORDER BY created_at DESC LIMIT 3");
while ($row = $resUser->fetch_assoc()) {
    $aktivitas[] = [
        'type' => 'user',
        'desc' => "👤 Pengguna baru: <strong>{$row['username']}</strong>",
        'time' => $row['created_at']
    ];
}

// Urutkan aktivitas
usort($aktivitas, fn($a, $b) => strtotime($b['time']) - strtotime($a['time']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .sidebar {
      background-color: #1E3358;
      box-shadow: 4px 0 10px rgba(0,0,0,0.2);
    }
    .sidebar a {
      color: #ffffff;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 15px;
      border-radius: 8px;
      transition: background 0.3s ease;
    }
    .sidebar a:hover {
      background-color: #2F4A7B;
    }
    .sidebar .active {
      background-color: #2F4A7B;
    }
    .sidebar h2 {
      color: #ffffff;
      font-size: 1.3rem;
      font-weight: 600;
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="sidebar w-64 flex flex-col py-6 px-4">
      <h2>🏰 Admin Panel</h2>
      <nav class="flex flex-col gap-2">
  <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
  <a href="destination-insert.php"><i class="bi bi-geo-alt-fill"></i> Destinations</a>
  <a href="verifybooking.php" class=""><i class="bi bi-calendar-check"></i> Booking</a>
  <a href="hotel-insert.php"><i class="bi bi-building"></i> Hotel</a>
      </nav>
      <div class="mt-auto">
        <a href="../auth/logout.php" class="bg-red-600 hover:bg-red-700 justify-center">
          <span>🚪</span> Logout
        </a>
      </div>
    </aside>

    <!-- Konten -->
    <main class="flex-1 p-8">
      <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-semibold text-[#1e3358]">Dashboard Admin</h1>
        <p class="text-sm text-gray-500">
          Halo, <span class="font-medium text-[#1e3358]"><?= $_SESSION['user']['username']; ?></span> 👋
        </p>
      </div>

      <!-- Statistik -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white shadow-md rounded-xl p-6 border-t-4 border-[#1e3358]">
          <h2 class="text-lg font-semibold text-[#1e3358] mb-2">Total Destinasi</h2>
          <p class="text-2xl font-bold"><?= $totalDest ?></p>
        </div>
        <div class="bg-white shadow-md rounded-xl p-6 border-t-4 border-[#1e3358]">
          <h2 class="text-lg font-semibold text-[#1e3358] mb-2">Total Booking</h2>
          <p class="text-2xl font-bold"><?= $totalBook ?></p>
        </div>
        <div class="bg-white shadow-md rounded-xl p-6 border-t-4 border-[#1e3358]">
          <h2 class="text-lg font-semibold text-[#1e3358] mb-2">Total Pengguna</h2>
          <p class="text-2xl font-bold"><?= $totalUser ?></p>
        </div>
      </div>

      <!-- Grafik Booking per Jam -->
      <div class="bg-white shadow-md rounded-xl p-6 mb-10">
        <h2 class="text-xl font-semibold text-[#1e3358] mb-4">Grafik Booking Hari Ini (per Jam)</h2>
        <canvas id="bookingChart" height="100"></canvas>
      </div>

  <script>
    const labels = <?= json_encode($labels) ?>;
    const data = <?= json_encode($data) ?>;

    new Chart(document.getElementById('bookingChart'), {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Jumlah Booking per Jam',
          data: data,
          borderColor: '#1e3358',
          backgroundColor: 'rgba(30, 51, 88, 0.2)',
          fill: true,
          tension: 0.3,
          pointBackgroundColor: '#1e3358'
        }]
      },
      options: {
        responsive: true,
        scales: { y: { beginAtZero: true } },
        plugins: { legend: { display: false } }
      }
    });
  </script>
</body>
</html>
