<?php
include __DIR__ . '/../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name        = $_POST['name'];
    $location    = $_POST['location'];
    $description = $_POST['description'];
    $price       = $_POST['price'];

    // upload gambar
    $imagePath = null;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../asset/image/"; // keluar dari folder admin
        $fileName  = time() . "_" . basename($_FILES['image']['name']);
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // simpan path relatif ke database
            $imagePath = "asset/image/" . $fileName;
        }
    }


    $sql = "INSERT INTO destinations (name, location, description, price, image_url) 
            VALUES ('$name', '$location', '$description', '$price', '$imagePath')";

    if ($conn->query($sql)) {
        header("Location: destination-insert.php");
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
  <title>Add Destination</title>
</head>
<body>
  <h1>Add Destination</h1>
  <form action="" method="post" enctype="multipart/form-data">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Location:</label><br>
    <input type="text" name="location"><br><br>

    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price"><br><br>

    <label>Image:</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Save</button>
  </form>
</body>
</html>
