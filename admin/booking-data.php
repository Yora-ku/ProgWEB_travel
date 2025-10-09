<?php
session_start();
require_once __DIR__ . '/../config/connect.php';

// Cek login & role
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header("Location: ../auth/login.php");
  exit();
}

// Ambil data booking + total harga dari DB
$sql = "SELECT 
            b.booking_id, 
            b.full_name, 
            b.phone_number, 
            b.check_in, 
            b.check_out, 
            b.guests,
            b.total_price,             
            d.name AS destination, 
            h.name AS hotel, 
            b.created_at
        FROM bookings b
        LEFT JOIN destinations d ON b.destination_id = d.destination_id
        LEFT JOIN hotels h ON b.hotel_id = h.hotel_id
        ORDER BY b.created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Booking | TravelHub Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
  body { font-family: 'Inter', sans-serif; background-color: #0b1733; color: white; overflow-x: hidden; }

  /* === SIDEBAR === */
  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 230px;
    height: 100vh;
    background-color: #0b1e3f;
    display: flex;
    flex-direction: column;
    padding-top: 30px;
  }

  .sidebar a {
    color: #fff;
    text-decoration: none;
    padding: 12px 20px;
    display: flex;
    align-items: center;
    font-size: 15px;
    border-radius: 10px;
    margin: 5px 15px;
    transition: background 0.3s;
  }

  .sidebar a:hover,
  .sidebar a.active {
    background-color: #153c7a;
  }

  .sidebar a i {
    margin-right: 10px;
    font-size: 18px;
  }

  .sidebar .logout {
    margin-top: auto;
    margin-bottom: 20px;
    background-color: #dc3545;
    color: white;
    text-align: center;
    font-weight: 500;
  }

  /* === MAIN CONTENT === */
  .main-content {
    margin-left: 230px;
    padding: 30px;
  }

  .card { background: rgba(255,255,255,0.12); backdrop-filter: blur(8px); }

  .table-scroll::-webkit-scrollbar { height: 6px; }
  .table-scroll::-webkit-scrollbar-thumb { background: #2c3e70; border-radius: 10px; }

  table {
    border-collapse: collapse;
    width: 100%;
    min-width: 900px;
    background-color: #0b1733;
    border: 1px solid rgba(255,255,255,0.1);
  }
  th, td {
    padding: 12px 16px;
    text-align: left;
    border: 1px solid rgba(255,255,255,0.08);
  }
  thead {
    background-color: #162a50;
    color: #cbd5e1;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  tbody tr:nth-child(even) { background-color: rgba(255,255,255,0.04); }
  tbody tr:hover { background-color: rgba(255,255,255,0.1); transition: background-color 0.2s ease-in-out; }
  .text-green-400 { color: #4ade80; }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
  <a href="destination-insert.php"><i class="bi bi-geo-alt-fill"></i> Destinations</a>
  <a href="booking.php" class="active"><i class="bi bi-calendar-check"></i> Booking</a>
  <a href="hotel-insert.php"><i class="bi bi-building"></i> Hotel</a>
  <a href="../auth/logout.php" class="logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
  <h2 class="text-3xl font-bold mb-8 text-center text-blue-100">📘 Data Pemesanan</h2>

  <div class="card rounded-2xl p-6 shadow-xl border border-white/10">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-xl font-semibold text-blue-100">Riwayat Booking Terbaru</h3>
      <input type="text" id="search" placeholder="🔍 Cari nama atau destinasi..." 
             class="px-4 py-2 rounded-lg bg-white/20 text-white placeholder-gray-300 outline-none focus:ring-2 focus:ring-blue-400">
    </div>

    <div class="overflow-x-auto table-scroll rounded-lg shadow-inner border border-white/10">
      <table class="min-w-full">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Destinasi</th>
            <th>Hotel</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Tamu</th>
            <th>Total</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="bookingTable">
        <?php if ($result->num_rows > 0):
          $no = 1;
          while ($row = $result->fetch_assoc()): ?>
            <tr class="hover:bg-white/10 transition">
              <td><?= $no++ ?></td>
              <td class="font-semibold"><?= htmlspecialchars($row['full_name']) ?></td>
              <td><?= htmlspecialchars($row['destination']) ?></td>
              <td><?= htmlspecialchars($row['hotel']) ?></td>
              <td><?= date("d M Y", strtotime($row['check_in'])) ?></td>
              <td><?= date("d M Y", strtotime($row['check_out'])) ?></td>
              <td><?= $row['guests'] ?></td>
              <td class="text-green-400 font-semibold">Rp <?= number_format($row['total_price'], 0, ',', '.') ?></td>
              <td class="text-sm text-gray-300"><?= date("d M Y", strtotime($row['created_at'])) ?></td>
              <td class="text-center whitespace-nowrap">
                <a href="editbooking.php?id=<?= $row['booking_id'] ?>" 
                   class="inline-flex items-center bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded-md text-sm transition mr-2">Edit</a>
                <a href="deletebooking.php?id=<?= $row['booking_id'] ?>" 
                   onclick="return confirm('Yakin ingin menghapus booking ini?')" 
                   class="inline-flex items-center bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded-md text-sm transition">Hapus</a>
              </td>
            </tr>
        <?php endwhile; else: ?>
          <tr><td colspan="10" class="text-center py-6 text-gray-400">Belum ada data booking 😢</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<footer class="text-center py-6 text-gray-500 text-sm mt-auto dark:text-gray-400">
      &copy; <?= date('Y') ?> TravelHub Admin
    </footer>

<script>
  // 🔍 Filter pencarian tabel
  document.getElementById('search').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#bookingTable tr');
    rows.forEach(row => {
      const name = row.cells[1]?.textContent.toLowerCase();
      const destination = row.cells[2]?.textContent.toLowerCase();
      row.style.display = (name.includes(searchValue) || destination.includes(searchValue)) ? '' : 'none';
    });
  });
</script>
</body>
</html>
