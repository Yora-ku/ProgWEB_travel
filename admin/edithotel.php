<?php
include __DIR__ . '/../config/connect.php';
$id = $_GET['id'] ?? null;

if (!$id) {
  header("Location: hotel-insert.php");
  exit;
}

$hotel = $conn->query("SELECT * FROM hotels WHERE hotel_id='$id'")->fetch_assoc();

// === UPDATE HOTEL ===
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name        = $_POST['name'];
  $address     = $_POST['address'];
  $city        = $_POST['city'];
  $rating      = $_POST['rating'];
  $reviews     = $_POST['reviews'];
  $description = $_POST['description'];
  $destination = $_POST['destination_id'];
  $price       = $_POST['price'];

  $imagePath = $hotel['image_hotel'];
  if (!empty($_FILES['image']['name'])) {
    $targetDir  = "../asset/hotels/";
    $fileName   = time() . "_" . basename($_FILES['image']['name']);
    $targetFile = $targetDir . $fileName;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
      $imagePath = "asset/hotels/" . $fileName;
    }
  }

  $sql = "UPDATE hotels 
          SET name='$name', address='$address', city='$city', rating='$rating',
              reviews='$reviews', image_hotel='$imagePath', description='$description',
              destination_id='$destination', price='$price'
          WHERE hotel_id='$id'";
  if ($conn->query($sql)) {
    header("Location: hotel-insert.php?updated=1");
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
  <title>Edit Hotel — TravelHub Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; background-color: #0d1b3d; color: white; }
    .card { background-color: #152955; border: 1px solid #1e3a8a; }
  </style>
</head>
<body class="min-h-screen flex flex-col">

  <!-- Navbar -->
  <nav class="bg-[#0f1e42] py-4 px-8 flex justify-between items-center shadow-md border-b border-blue-800">
    <h1 class="text-2xl font-bold tracking-wide">🏨 Travel<span class="text-blue-400">Hub</span> Admin</h1>
    <a href="hotel-insert.php" class="bg-blue-600 px-4 py-2 rounded-lg hover:bg-blue-500 transition">Kembali</a>
  </nav>

  <div class="flex-grow container mx-auto px-6 py-10">
    <h2 class="text-3xl font-bold mb-6 text-center">✏️ Edit Data Hotel</h2>

    <div class="card rounded-2xl shadow-lg p-8 max-w-4xl mx-auto">
      <form action="" method="post" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
          <label class="block text-sm mb-1">Nama Hotel</label>
          <input type="text" name="name" value="<?= $hotel['name'] ?>" class="w-full rounded-lg p-3 bg-[#0f1e42] border border-blue-800 text-black">
        </div>

        <div>
          <label class="block text-sm mb-1">Alamat</label>
          <input type="text" name="address" value="<?= $hotel['address'] ?>" class="w-full rounded-lg p-3 bg-[#0f1e42] border border-blue-800 text-black">
        </div>

        <div>
          <label class="block text-sm mb-1">Kota</label>
          <input type="text" name="city" value="<?= $hotel['city'] ?>" class="w-full rounded-lg p-3 bg-[#0f1e42] border border-blue-800 text-black">
        </div>

        <div>
          <label class="block text-sm mb-1">Rating</label>
          <input type="number" step="0.1" name="rating" value="<?= $hotel['rating'] ?>" class="w-full rounded-lg p-3 bg-[#0f1e42] border border-blue-800 text-black">
        </div>

        <div>
          <label class="block text-sm mb-1">Jumlah Review</label>
          <input type="number" name="reviews" value="<?= $hotel['reviews'] ?>" class="w-full rounded-lg p-3 bg-[#0f1e42] border border-blue-800 text-black">
        </div>

        <div>
          <label class="block text-sm mb-1">Harga (IDR)</label>
          <input type="number" step="0.01" name="price" value="<?= $hotel['price'] ?>" class="w-full rounded-lg p-3 bg-[#0f1e42] border border-blue-800 text-black">
        </div>

        <div class="md:col-span-2">
          <label class="block text-sm mb-1">Deskripsi</label>
          <textarea name="description" rows="3" class="w-full rounded-lg p-3 bg-[#0f1e42] border border-blue-800 text-black"><?= $hotel['description'] ?></textarea>
        </div>

        <div>
          <label class="block text-sm mb-1">Destinasi</label>
          <select name="destination_id" class="w-full rounded-lg p-3 bg-[#0f1e42] border border-blue-800 text-black">
            <?php
            $destQuery = $conn->query("SELECT destination_id, name FROM destinations");
            while ($dest = $destQuery->fetch_assoc()) {
              $selected = $dest['destination_id'] == $hotel['destination_id'] ? 'selected' : '';
              echo "<option value='{$dest['destination_id']}' $selected>{$dest['name']}</option>";
            }
            ?>
          </select>
        </div>

        <div>
          <label class="block text-sm mb-1">Gambar Baru</label>
          <input type="file" name="image" class="w-full text-sm text-gray-200">
          <img src="../<?= $hotel['image_hotel'] ?>" alt="" class="w-32 mt-2 rounded-lg">
        </div>

        <div class="md:col-span-2 text-right">
          <button type="submit" class="bg-blue-600 hover:bg-blue-500 px-6 py-2 rounded-lg font-semibold transition">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
