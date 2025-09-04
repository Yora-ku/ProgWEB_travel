<?php
include __DIR__ . "/../include/header.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

$sqlDest = "SELECT * FROM destinations LIMIT 6";
$resultDest = $conn->query($sqlDest);
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
        <h1 class="text-2xl font-bold mb-4">🏨 7179 Properti Ditemukan</h1>
        <!-- Search / Filter -->
        <div class="bg-white rounded-2xl shadow-md p-4 mb-6 flex flex-wrap items-center gap-4">
            <!-- Lokasi -->
            <div class="flex items-center gap-2">
                <span class="text-blue-600">📍</span>
                <span class="border rounded-lg px-3 py-2 bg-gray-100 font-bold text-gray-800">
                    Switzerland
                </span>
            </div>


            <!-- Tanggal -->
            <div class="flex items-center gap-2">
                <span class="text-blue-600">📅</span>
                <input type="date" class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <span>-</span>
                <input type="date" class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Jumlah Orang -->
            <div class="flex items-center gap-2">
                <span class="text-blue-600">👤</span>
                <input type="text" placeholder="1 room, 2 adults, 0 children" class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 w-64">
            </div>

            <!-- Tombol Cari -->
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg ml-auto">
                🔍 Cari
            </button>
        </div>


        <div class="grid gap-6">

            <!-- Hotel 1 -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden flex">
                <!-- Slider -->
                <div class="w-48">
                    <div class="swiper mySwiper1 h-full">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><a href="#" target="_blank"><img src="../asset/hotels/0221r12000lztpayeD89E_R_960_660_R5_D.webp" class="object-cover w-full h-full" /></a></div>
                            <div class="swiper-slide"><a href="#" target="_blank"><img src="../asset/hotels/0581012000d4872db3D23_R_600_400_R5.webp" class="object-cover w-full h-full" /></a></div>
                            <div class="swiper-slide"><a href="#" target="_blank"><img src="../asset/hotels/0225612000kzxeq5b23DF_R_600_400_R5.webp" class="object-cover w-full h-full" /></a></div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <!-- Info -->
                <div class="p-4 flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2"><a href="#" target="_blank" class="hover:text-blue-600 transition">Swiss Star Zurich Airport – Self Check-IN ⭐⭐⭐⭐⭐</a></h2>
                    <p class="text-gray-600">Rating: <span class="font-bold">7.2/10</span> (97 reviews)</p>
                    <p class="text-gray-600">Lokasi: Kloten</p>
                    <p class="text-gray-600">Fasilitas: Double Room, 2 Single Beds</p>
                    <p class="text-sm text-gray-400 mt-2">Last booked 6 hrs ago</p>
                </div>
            </div>

            <!-- Hotel 2 -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden flex">
                <div class="w-48">
                    <div class="swiper mySwiper2 h-full">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><a href="#"><img src="../asset/hotels/Royal Savoy.jpg" class="object-cover w-full h-full" /></a></div>
                            <div class="swiper-slide"><a href="#"><img src="../asset/hotels/Royal Savoy1.jpg" class="object-cover w-full h-full" /></a></div>
                            <div class="swiper-slide"><a href="#"><img src="../asset/hotels/Royal Savoy2.jpg" class="object-cover w-full h-full" /></a></div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="p-4 flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2"><a href="#" target="_blank" class="hover:text-blue-600 transition">Royal Savoy Hotel & Spa ⭐⭐⭐⭐⭐</a></h2>
                    <p class="text-gray-600">Rating: <span class="font-bold">8.5/10</span> (250 reviews)</p>
                    <p class="text-gray-600">Lokasi: Lausanne</p>
                    <p class="text-gray-600">Fasilitas: Superior Room</p>
                    <p class="text-sm text-gray-400 mt-2">Last booked 2 hrs ago</p>
                </div>
            </div>

            <!-- Hotel 3 -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden flex">
                <div class="w-48">
                    <div class="swiper mySwiper3 h-full">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><a href="#"><img src="../asset/hotels/courtyard.webp" class="object-cover w-full h-full" /></a></div>
                            <div class="swiper-slide"><a href="#"><img src="../asset/hotels/courtyard.jpg" class="object-cover w-full h-full" /></a></div>
                            <div class="swiper-slide"><a href="#"><img src="../asset/hotels/courtyard1.jpg" class="object-cover w-full h-full" /></a></div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="p-4 flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2"><a href="#" target="_blank" class="hover:text-blue-600 transition">Courtyard by Marriot Basel⭐⭐⭐⭐</a></h2>
                    <p class="text-gray-600">Rating: <span class="font-bold">7.8/10</span> (134 reviews)</p>
                    <p class="text-gray-600">Lokasi: Pratteln</p>
                    <p class="text-gray-600">Fasilitas: Standard Room</p>
                    <p class="text-sm text-gray-400 mt-2">Last booked 10 hrs ago</p>
                </div>
            </div>

            <!-- Hotel 4 -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden flex">
                <div class="w-48">
                    <div class="swiper mySwiper4 h-full">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><a href="#"><img src="../asset/hotels/schloss.webp" class="object-cover w-full h-full" /></a></div>
                            <div class="swiper-slide"><a href="#"><img src="../asset/hotels/schloss.jpg" class="object-cover w-full h-full" /></a></div>
                            <div class="swiper-slide"><a href="#"><img src="../asset/hotels/schloss1.jpg" class="object-cover w-full h-full" /></a></div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="p-4 flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2"><a href="#" target="_blank" class="hover:text-blue-600 transition">Hotel Schloss Hünigen ⭐⭐⭐⭐</a></h2>
                    <p class="text-gray-600">Rating: <span class="font-bold">9.1/10</span> (312 reviews)</p>
                    <p class="text-gray-600">Lokasi: Konolfingen</p>
                    <p class="text-gray-600">Fasilitas: Deluxe Suite</p>
                    <p class="text-sm text-gray-400 mt-2">Last booked 30 min ago</p>
                </div>
            </div>

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