<?php
include __DIR__ . "/../include/header.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

// cek apakah ada destination_id
if (!isset($_GET['destination_id'])) {
    die("Destination tidak ditemukan.");
}

$destination_id = intval($_GET['destination_id']);

// ambil data destinasi (opsional, untuk judul halaman)
$destQuery = $conn->prepare("SELECT * FROM destinations WHERE destination_id = ?");
$destQuery->bind_param("i", $destination_id);
$destQuery->execute();
$destination = $destQuery->get_result()->fetch_assoc();

if (!$destination) {
    die("Destination tidak valid.");
}

// ambil daftar hotel berdasarkan destination
$hotelQuery = $conn->prepare("SELECT * FROM hotels WHERE destination_id = ?");
$hotelQuery->bind_param("i", $destination_id);
$hotelQuery->execute();
$hotels = $hotelQuery->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel List</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>


<body class="bg-gray-100 min-h-screen p-6">
      <div class="max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">🏨 Hotel di <?= htmlspecialchars($destination['name']) ?></h1>

    <div class="grid gap-6">
      <?php while($hotel = $hotels->fetch_assoc()): ?>
        <div class="bg-white rounded-2xl shadow-md overflow-hidden flex">
          <!-- Foto hotel (sementara pakai 1 gambar dari field database misalnya hotel.image) -->
          <div class="w-48">
            <img src="../<?= htmlspecialchars($hotel['image_hotel']) ?>" class="object-cover w-full h-full"/>
          </div>
          <div class="p-4 flex-1">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">
              <?= htmlspecialchars($hotel['name']) ?> ⭐⭐⭐⭐
            </h2>
            <p class="text-gray-600">Kota: <?= htmlspecialchars($hotel['city']) ?></p>
            <p class="text-gray-600">Lokasi: <?= htmlspecialchars($hotel['address']) ?></p>
            <p class="text-gray-600">Rating: <?= htmlspecialchars($hotel['rating']) ?>/5</p>
            <p class="text-gray-600">Review: <?= htmlspecialchars($hotel['reviews']) ?></p>

            <div class="text-right">
      <div class="flex justify-between items-center mt-4">
  <p class="text-xl font-bold text-blue-600">
    Rp <?= number_format($hotel['price'], 0, ',', '.') ?> / malam
  </p>
  <a href="booking.php?destination=<?= $destination_id ?>&hotel=<?= $hotel['hotel_id'] ?>"
     class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl">
    Pesan Sekarang
  </a>
</div>

    </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

    <!-- SwiperJS JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        new Swiper(".mySwiper1", {
            loop: true,
            pagination: {
                el: ".mySwiper1 .swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: ".mySwiper1 .swiper-button-next",
                prevEl: ".mySwiper1 .swiper-button-prev"
            }
        });
        new Swiper(".mySwiper2", {
            loop: true,
            pagination: {
                el: ".mySwiper2 .swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: ".mySwiper2 .swiper-button-next",
                prevEl: ".mySwiper2 .swiper-button-prev"
            }
        });
        new Swiper(".mySwiper3", {
            loop: true,
            pagination: {
                el: ".mySwiper3 .swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: ".mySwiper3 .swiper-button-next",
                prevEl: ".mySwiper3 .swiper-button-prev"
            }
        });
        new Swiper(".mySwiper4", {
            loop: true,
            pagination: {
                el: ".mySwiper4 .swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: ".mySwiper4 .swiper-button-next",
                prevEl: ".mySwiper4 .swiper-button-prev"
            }
        });
    </script>
</body>

</html>
<?php include __DIR__ . "/../include/footer.php"; ?>