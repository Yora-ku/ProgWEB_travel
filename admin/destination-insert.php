<?php
session_start();
require_once __DIR__ . '/../config/connect.php';

// Cek login & role admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header("Location: ../auth/login.php");
  exit();
}

// Simpan data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name        = $_POST['name'];
    $location    = $_POST['location'];
    $description = $_POST['description'];
    $price       = $_POST['price'];

    // Upload gambar
    $imagePath = null;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../asset/image/";
        $fileName  = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = "asset/image/" . $fileName;
        }
    }

    // Simpan ke database
    $sql = "INSERT INTO destinations (name, location, description, price, image_url) 
            VALUES ('$name', '$location', '$description', '$price', '$imagePath')";

    if ($conn->query($sql)) {
        $successMsg = "✅ Destination berhasil ditambahkan!";
    } else {
        $errorMsg = "❌ Gagal menambahkan: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Destination | TravelHub Admin</title>
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

    .sidebar a i { margin-right: 10px; font-size: 18px; }

    .sidebar .logout {
      margin-top: auto;
      margin-bottom: 20px;
      background-color: #dc3545;
      color: white;
      text-align: center;
      font-weight: 500;
    }

    /* === MAIN === */
    .main-content {
      margin-left: 230px;
      padding: 40px;
    }

    .card {
      background: rgba(255,255,255,0.12);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,0.1);
      padding: 32px;
      border-radius: 16px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }

    label { display: block; margin-bottom: 8px; font-weight: 600; color: #cbd5e1; }
    input, textarea {
      width: 100%;
      padding: 10px 14px;
      border-radius: 10px;
      background-color: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.2);
      color: white;
      outline: none;
      transition: all 0.2s;
    }
    input:focus, textarea:focus {
      border-color: #3b82f6;
      background-color: rgba(255,255,255,0.15);
    }

    button {
      background-color: #2563eb;
      color: white;
      padding: 12px 20px;
      border-radius: 10px;
      font-weight: 600;
      transition: background-color 0.2s;
    }
    button:hover { background-color: #3b82f6; }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
  <a href="destination-insert.php" class="active"><i class="bi bi-geo-alt-fill"></i> Destinations</a>
  <a href="booking-data.php"><i class="bi bi-calendar-check"></i> Booking</a>
  <a href="hotel-insert.php"><i class="bi bi-building"></i> Hotel</a>
  <a href="../auth/logout.php" class="logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
  <h2 class="text-3xl font-bold mb-8 text-center text-blue-100">🌍 Tambah Destinasi Baru</h2>

  <div class="card">
    <?php if (!empty($successMsg)): ?>
      <div class="bg-green-600/30 text-green-300 p-3 rounded-md mb-4"><?= $successMsg ?></div>
    <?php elseif (!empty($errorMsg)): ?>
      <div class="bg-red-600/30 text-red-300 p-3 rounded-md mb-4"><?= $errorMsg ?></div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data" class="space-y-5">
      <div>
        <label for="name">Nama Destinasi</label>
        <input type="text" name="name" id="name" required placeholder="Contoh: Tokyo Tower">
      </div>

      <div>
        <label for="location">Lokasi</label>
        <input type="text" name="location" id="location" placeholder="Contoh: Tokyo, Jepang">
      </div>

      <div>
        <label for="description">Deskripsi</label>
        <textarea name="description" id="description" rows="4" placeholder="Tuliskan deskripsi destinasi..."></textarea>
      </div>

      <div>
        <label for="price">Harga (Rp)</label>
        <input type="number" step="0.01" name="price" id="price" placeholder="Contoh: 1500000">
      </div>

      <div>
        <label for="image">Gambar Destinasi</label>
        <input type="file" name="image" id="image" accept="image/*">
      </div>

      <button type="submit" class="w-full">💾 Simpan Destinasi</button>
    </form>
  </div>
</div>

<footer class="text-center py-6 text-gray-500 text-sm mt-auto dark:text-gray-400">
  &copy; <?= date('Y') ?> TravelHub Admin
</footer>

</body>
</html>
