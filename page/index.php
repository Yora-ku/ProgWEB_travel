<?php
include __DIR__ . "/../include/header.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}


$sql = "SELECT * FROM destinations";
$result = $conn->query($sql);

$sqlHotels = "SELECT * FROM hotels LIMIT 2";
$resultHotels = $conn->query($sqlHotels);

$sqlGallery = "SELECT * FROM hotels LIMIT 5";
$resultGallery = $conn->query($sqlGallery);
?>

<main class="bg-gray-50">
  <!-- HERO -->
  <section id="home" class="relative bg-cover bg-center" style="background-image: url('<?= asset_url("hero-bg.jpg") ?>');">
    <div class="bg-black/40">
      <div class="max-w-7xl mx-auto px-6 py-32 flex flex-col md:flex-row items-center gap-12">
        <div class="text-white flex-1">
          <p class="text-sm uppercase tracking-wider mb-2">Search your comfort place</p>
          <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">SEARCH YOUR<br>COMFORT<br>PLACE</h1>
          
          <div class="flex flex-wrap gap-4 mb-4">
            <?php while($row = $result->fetch_assoc()) { ?>
              <div class="flex items-center bg-white/30 rounded-full px-3 py-1 gap-2 backdrop-blur-sm">
                <img class="w-6 h-6 rounded-full object-cover" src="../<?= $row['image_url'] ?>" alt="<?= $row['name'] ?> icon" />
                <span class="text-sm font-semibold"><?= strtoupper($row['location']) ?></span>
              </div>
            <?php } ?>
          </div>

          <p class="mb-6 text-gray-200">Discover stays and experiences tailored for your next journey.</p>

          <div class="flex gap-4">
            <a href="#hotels" class="px-6 py-3 bg-blue-600 rounded-full text-white font-semibold hover:bg-blue-700 transition">Explore Hotels</a>
            <a href="#contact" class="px-6 py-3 bg-white/20 rounded-full text-white font-semibold hover:bg-white/30 transition">Contact Us</a>
          </div>
        </div>
        <div class="flex-1 hidden md:flex justify-end">
        </div>
      </div>
    </div>
  </section>

  <!-- HOTEL GALLERY -->
  <section class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-2xl font-bold mb-6">Hotel Gallery</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
      <?php while($gallery = $resultGallery->fetch_assoc()) { ?>
        <div class="overflow-hidden rounded-lg shadow-md">
          <img src="../<?= $gallery['image_hotel'] ?>" alt="<?= $gallery['name'] ?>" class="w-full h-40 object-cover transition-transform hover:scale-105">
        </div>
      <?php } ?>
    </div>
  </section>

  <!-- POPULAR PROPERTIES -->
  <section id="hotels" class="max-w-7xl mx-auto px-6 py-12">
    <h2 class="text-2xl font-bold mb-6">POPULAR PROPERTIES IN INDONESIA</h2>

    <div class="flex gap-4 mb-6">
      <button class="px-4 py-2 bg-blue-600 text-white rounded-full">Bali</button>
      <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full">Yogyakarta</button>
      <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-full">Central Jakarta</button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
      <?php while($hotel = $resultHotels->fetch_assoc()) { ?>
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
          <img src="../<?= $hotel['image_hotel'] ?>" alt="<?= $hotel['name'] ?>" class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="font-semibold text-lg mb-1"><?= $hotel['name'] ?></h3>
            <p class="text-gray-500 text-sm mb-2"><?= $hotel['address'] ?>, <?= $hotel['city'] ?></p>
            <div class="flex items-center justify-between text-sm text-gray-600">
              <span class="bg-yellow-400 text-black px-2 py-1 rounded-full"><?= $hotel['rating'] ?>/5.0</span>
              <span><?= $hotel['reviews'] ?> reviews</span>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>

    <section id="contact" class="bg-gray-50 py-16">
  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12">
    
    <!-- Info Panel -->
    <div class="bg-white p-8 rounded-xl shadow-lg flex flex-col gap-4">
      <h3 class="text-3xl font-bold text-gray-900">Never stop exploring the world.</h3>
      <p class="text-gray-600 text-lg">We are dedicated to connecting you with unforgettable journeys and unique experiences around the world.</p>
      <h4 class="font-semibold text-gray-800 mt-4">About Us</h4>
      <p class="text-gray-500">We help travelers find places they love. From boutique stays to business-friendly hotels, our curated listings keep things simple and inspiring.</p>
      <div class="grid gap-2 mt-6 text-gray-700">
        <div><strong>Call:</strong> <a href="tel:+6283125464551" class="text-blue-600 hover:underline">+62 831-2546-4551</a></div>
        <div><strong>Email:</strong> <a href="mailto:travelhub@gmail.com" class="text-blue-600 hover:underline">travelhub@gmail.com</a></div>
      </div>
    </div>

    <!-- Contact Form Panel -->
    <div class="bg-white p-8 rounded-xl shadow-lg flex flex-col gap-4">
      <h3 class="text-2xl font-bold text-gray-900">We are always here to help</h3>
      <p class="text-gray-600 mb-4">SEND YOUR MESSAGE</p>
      <form onsubmit="event.preventDefault(); this.reset(); alert('Message sent!');" class="space-y-4">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <input type="text" placeholder="Your name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" required>
          <input type="email" placeholder="Email address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" required>
        </div>
        
        <input type="text" placeholder="Subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
        
        <textarea placeholder="Write your message..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none h-36 transition"></textarea>
        
        <div class="flex justify-end">
          <button class="px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition duration-300 font-semibold" type="submit">Contact Us</button>
        </div>
      </form>
    </div>

  </div>
    </section>


</main>

<?php
include __DIR__ . "/../include/footer.php";
?>
