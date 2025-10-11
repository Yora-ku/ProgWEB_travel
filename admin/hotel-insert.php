<?php
include __DIR__ . '/../config/connect.php';
session_start();

// Cek login & role
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header("Location: ../auth/login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name           = $_POST['name'];
  $address        = $_POST['address'];
  $city           = $_POST['city'];
  $rating         = $_POST['rating'];
  $reviews        = $_POST['reviews'];
  $description    = $_POST['description'];
  $destination_id = $_POST['destination_id'];
  $price          = $_POST['price'];

  $imagePath = null;
  if (!empty($_FILES['image']['name'])) {
    $targetDir  = "../asset/hotels/";
    $fileName   = time() . "_" . basename($_FILES['image']['name']);
    $targetFile = $targetDir . $fileName;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
      $imagePath = "asset/hotels/" . $fileName;
    }
  }

  $sql = "INSERT INTO hotels (name, address, city, rating, reviews, image_hotel, description, destination_id, price) 
          VALUES ('$name', '$address', '$city', '$rating', '$reviews', '$imagePath', '$description', '$destination_id', '$price')";
  
  if ($conn->query($sql)) {
    header("Location: hotel-insert.php?success=1");
    exit;
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Hotel | TravelHub Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; background-color: #0b1733; color: white; overflow-x: hidden; }

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
    .sidebar a.active { background-color: #153c7a; }
    .sidebar a i { margin-right: 10px; font-size: 18px; }
    .sidebar .logout {
      margin-top: auto;
      margin-bottom: 20px;
      background-color: #dc3545;
      color: white;
      text-align: center;
      font-weight: 500;
    }

    .main-content {
      margin-left: 230px;
      padding: 40px;
    }

    .card {
      background: rgba(255,255,255,0.1);
      border-radius: 20px;
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,0.15);
    }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
  <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
  <a href="destination-insert.php"><i class="bi bi-geo-alt-fill"></i> Destinations</a>
  <a href="booking-data.php"><i class="bi bi-calendar-check"></i> Booking</a>
  <a href="hotel-insert.php" class="active"><i class="bi bi-building"></i> Hotel</a>
  <a href="../auth/logout.php" class="logout"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
  <h2 class="text-3xl font-bold mb-8 text-center text-blue-100">🏨 Tambah Hotel Baru</h2>

  <?php if (isset($_GET['success'])): ?>
    <div class="mb-6 p-4 bg-green-600 text-white rounded-xl shadow-lg">
      ✅ Hotel berhasil ditambahkan!
    </div>
  <?php endif; ?>

  <div class="card p-8 shadow-xl max-w-3xl mx-auto">
    <form action="" method="post" enctype="multipart/form-data" class="space-y-6">
      
      <div>
        <label class="block text-gray-200 mb-2 font-semibold">Nama Hotel</label>
        <input type="text" name="name" required class="w-full p-3 rounded-lg bg-white/20 text-white placeholder-gray-300 border border-white/10 outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div class="grid grid-cols-2 gap-6">
        <div>
          <label class="block text-gray-200 mb-2 font-semibold">Alamat</label>
          <input type="text" name="address" class="w-full p-3 rounded-lg bg-white/20 text-white placeholder-gray-300 border border-white/10 outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
          <label class="block text-gray-200 mb-2 font-semibold">Kota</label>
          <input type="text" name="city" class="w-full p-3 rounded-lg bg-white/20 text-white placeholder-gray-300 border border-white/10 outline-none focus:ring-2 focus:ring-blue-400">
        </div>
      </div>

      <div class="grid grid-cols-2 gap-6">
        <div>
          <label class="block text-gray-200 mb-2 font-semibold">Rating</label>
          <input type="number" step="0.1" name="rating" class="w-full p-3 rounded-lg bg-white/20 text-white border border-white/10 outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div>
          <label class="block text-gray-200 mb-2 font-semibold">Jumlah Review</label>
          <input type="number" name="reviews" class="w-full p-3 rounded-lg bg-white/20 text-white border border-white/10 outline-none focus:ring-2 focus:ring-blue-400">
        </div>
      </div>

      <div>
        <label class="block text-gray-200 mb-2 font-semibold">Harga per malam (Rp)</label>
        <input type="number" step="0.01" name="price" required class="w-full p-3 rounded-lg bg-white/20 text-white border border-white/10 outline-none focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <label class="block text-gray-200 mb-2 font-semibold">Deskripsi</label>
        <textarea name="description" rows="4" class="w-full p-3 rounded-lg bg-white/20 text-white border border-white/10 outline-none focus:ring-2 focus:ring-blue-400"></textarea>
      </div>

      <div>
        <label class="block text-gray-200 mb-2 font-semibold">Destinasi Terkait</label>
        <select name="destination_id" required class="w-full p-3 rounded-lg bg-white/20 text-white border border-white/10 outline-none focus:ring-2 focus:ring-blue-400">
          <?php
          $destQuery = $conn->query("SELECT destination_id, name FROM destinations");
          while ($dest = $destQuery->fetch_assoc()) {
              echo "<option value='{$dest['destination_id']}'>{$dest['name']}</option>";
          }
          ?>
        </select>
      </div>

      <div>
        <label class="block text-gray-200 mb-2 font-semibold">Gambar Hotel</label>
        <input type="file" name="image" class="block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-500 cursor-pointer">
      </div>

      <div class="text-center pt-4">
        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-8 py-3 rounded-xl font-semibold shadow-lg transition">Simpan Hotel</button>
      </div>

    </form>
  </div>
</div>

<footer class="text-center py-6 text-gray-500 text-sm mt-12">
  &copy; <?= date('Y') ?> TravelHub Admin
</footer>
</body>
</html>
