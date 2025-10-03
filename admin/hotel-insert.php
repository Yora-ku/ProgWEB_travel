<?php
include __DIR__ . '/../config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name           = $_POST['name'];
    $address        = $_POST['address'];
    $city           = $_POST['city'];
    $rating         = $_POST['rating'];
    $reviews        = $_POST['reviews'];
    $description    = $_POST['description'];
    $destination_id = $_POST['destination_id'];
    $price          = $_POST['price']; // 👈 ambil harga

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
  <title>Add Hotel</title>
</head>
<body>
  <h1>Add Hotel</h1>
  <form action="" method="post" enctype="multipart/form-data">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Address:</label><br>
    <input type="text" name="address"><br><br>

    <label>City:</label><br>
    <input type="text" name="city"><br><br>

    <label>Rating:</label><br>
    <input type="number" step="0.1" name="rating"><br><br>

    <label>Reviews:</label><br>
    <input type="number" name="reviews"><br><br>

    <label>Price (IDR):</label><br>
    <input type="number" step="0.01" name="price" required><br><br> <!-- 👈 field harga -->

    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Destination:</label><br>
    <select name="destination_id" required>
      <?php
      $destQuery = $conn->query("SELECT destination_id, name FROM destinations");
      while ($dest = $destQuery->fetch_assoc()) {
          echo "<option value='{$dest['destination_id']}'>{$dest['name']}</option>";
      }
      ?>
    </select>
    <br><br>

    <label>Image:</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">Save</button>
  </form>
</body>
</html>
