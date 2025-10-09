<?php
session_start();
require_once __DIR__ . '/../config/connect.php';
require_once __DIR__ . '/../config/baseurl.php';

// Cek login & role admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// Ambil ID destinasi
if (!isset($_GET['id'])) {
    header("Location: destination-insert.php");
    exit();
}
$id = intval($_GET['id']);

// Ambil data destinasi
$result = mysqli_query($conn, "SELECT * FROM destinations WHERE destination_id = $id");
$destination = mysqli_fetch_assoc($result);
if (!$destination) {
    header("Location: destination-insert.php");
    exit();
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name        = mysqli_real_escape_string($conn, $_POST['name']);
    $location    = mysqli_real_escape_string($conn, $_POST['location']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price       = mysqli_real_escape_string($conn, $_POST['price']);

    $imagePath = $destination['image_url']; // default
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../asset/image/";
        $fileName  = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = "asset/image/" . $fileName;
            // Hapus file lama
            if ($destination['image_url'] && file_exists("../" . $destination['image_url'])) {
                unlink("../" . $destination['image_url']);
            }
        }
    }

    $sql = "UPDATE destinations 
            SET name='$name', location='$location', description='$description', price='$price', image_url='$imagePath' 
            WHERE destination_id=$id";
    mysqli_query($conn, $sql);
    header("Location: destination-insert.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Destinasi — TravelHub Admin</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="p-10 bg-gray-100">

<div class="max-w-2xl mx-auto bg-white rounded-xl shadow p-8">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">Edit Destinasi</h2>
    <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label class="block mb-1">Nama</label>
            <input type="text" name="name" value="<?= htmlspecialchars($destination['name']) ?>" required
                   class="w-full border rounded p-2">
        </div>
        <div>
            <label class="block mb-1">Lokasi</label>
            <input type="text" name="location" value="<?= htmlspecialchars($destination['location']) ?>"
                   class="w-full border rounded p-2">
        </div>
        <div>
            <label class="block mb-1">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full border rounded p-2"><?= htmlspecialchars($destination['description']) ?></textarea>
        </div>
        <div>
            <label class="block mb-1">Harga</label>
            <input type="number" step="0.01" name="price" value="<?= $destination['price'] ?>"
                   class="w-full border rounded p-2">
        </div>
        <div>
            <label class="block mb-1">Gambar</label>
            <?php if ($destination['image_url']): ?>
                <img src="../<?= $destination['image_url'] ?>" alt="" class="w-32 h-32 object-cover mb-2 rounded border">
            <?php endif; ?>
            <input type="file" name="image" class="w-full border rounded p-2">
        </div>
        <div class="flex justify-between items-center">
            <a href="destination-insert.php" class="px-4 py-2 bg-gray-400 rounded text-white hover:bg-gray-500">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 rounded text-white hover:bg-blue-500">Update</button>
        </div>
    </form>
</div>

</body>
</html>
