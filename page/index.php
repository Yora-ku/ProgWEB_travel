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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travel.HUB - Explore the World</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
    body { font-family: 'Inter', sans-serif; }

    /* Hero Section */
    .hero {
      position: relative;
      height: 100vh;
      background: url('../asset/index/bluehotelroom.jpg') no-repeat center center/cover;
      display: flex;
      align-items: center;
      color: #fff;
    }
    .hero .overlay {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.4);
    }
    .hero .container {
      position: relative;
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 90%;
      margin: auto;
    }
    .hero-content h1 {
      font-size: 52px;
      font-weight: 800;
      line-height: 1.2;
    }
    .hero-content p {
      margin-top: 15px;
      font-size: 16px;
      max-width: 400px;
    }
    .hero-carousel-wrapper { width: 50%; display: flex; flex-direction: column; align-items: center; }
    .hero-carousel .card {
      width: 220px;
      height: 300px;
      border-radius: 16px;
      margin: 0 10px;
      background-size: cover;
      background-position: center;
      position: relative;
      display: flex;
      align-items: flex-end;
      justify-content: center;
      color: #fff;
      font-weight: bold;
      font-size: 20px;
      box-shadow: 0 12px 24px rgba(0,0,0,0.4);
    }
    .hero-nav {
      margin-top: 20px;
      display: flex;
      align-items: center;
      gap: 20px;
      justify-content: center;
    }
    .hero-nav button {
      background: rgba(255,255,255,0.2);
      border: none;
      color: #fff;
      font-size: 18px;
      padding: 10px 14px;
      border-radius: 50%;
      cursor: pointer;
      transition: 0.3s;
    }
    .hero-nav button:hover { background: rgba(255,255,255,0.5); }
    .hero-nav .indicator { font-size: 20px; font-weight: bold; color: #fff; min-width: 30px; text-align: center; }

    /* Hotel Gallery Custom Styles */
    .gallery-container {
      position: relative;
      height: 400px;
      width: 100%;
      overflow: hidden;
    }
    .gallery-item {
      position: absolute;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
      transition: all 0.3s ease;
      cursor: pointer;
    }
    .gallery-item:hover {
      transform: scale(1.02);
      box-shadow: 0 12px 35px rgba(0,0,0,0.25);
      z-index: 50 !important;
    }
    .gallery-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }
    .gallery-item:hover img {
      transform: scale(1.05);
    }

    /* Ripple effect */
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }
    @keyframes ripple-animation {
        to { transform: scale(4); opacity: 0; }
    }

    /* Scrollbar */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #f1f1f1; }
    ::-webkit-scrollbar-thumb { background: #3b82f6; border-radius: 4px; }
    ::-webkit-scrollbar-thumb:hover { background: #2563eb; }

    /* hotel gallery */
    .gallery-item:hover {
  transform: scale(1.05);
  box-shadow: 0 12px 35px rgba(0,0,0,0.25);
}

/* popular properties */
.tab-btn.active {
    background-color: #1D4ED8; 
    color: #fff;
  }

  /* contact us */
   #contact textarea {
    border-radius: 1.5rem; /* sama seperti input */
  }
  </style>
</head>
<body class="bg-gray-50">

 <!-- Hero Section -->
<section class="hero">
  <div class="overlay"></div>
  <div class="container">
    <div class="hero-content">
      <h1>SEARCH YOUR <br> COMFORT <br> PLACE.</h1>
      <p>With Travel.HUB, u can surround the world without worry.</p>
    </div>

    <div class="hero-carousel-wrapper">
      <div class="hero-carousel owl-carousel">
        <?php 
        mysqli_data_seek($result, 0); 
        while($row = $result->fetch_assoc()) { ?>
          <div class="card" style="background-image:url('../<?= $row['image_url'] ?>')">
            <h3><?= htmlspecialchars($row['name']) ?></h3>
          </div>
        <?php } ?>
      </div>

      <div class="hero-nav">
        <button class="prev"><i class="fas fa-arrow-left"></i></button>
        <span class="indicator">01</span>
        <button class="next"><i class="fas fa-arrow-right"></i></button>
      </div>

      <div class="mt-6 flex gap-4">
        <a href="#hotels" class="px-6 py-3 bg-[#001f3f] text-white rounded-full font-semibold hover:bg-blue-900 transition">
          Explore Hotels
        </a>
        <a href="#contact" class="px-6 py-3 bg-gray-300 text-gray-800 rounded-full font-semibold hover:bg-gray-400 transition">Contact Us</a>
      </div>
    </div>
  </div>
</section>

<!-- HOTEL GALLERY -->
<section class="py-20 bg-white">
   <div class="max-w-7xl mx-auto px-6 text-center mb-16">
    <h2 class="text-4xl font-bold text-[#001f3f] mb-2">HOTELS GALLERIES</h2>
    <p class=" text-[#001f3f]">Discover amazing places around the world</p>
  </div>
  <div class="flex flex-wrap justify-center gap-4">
    <!-- item 1 -->
    <div class="relative w-40 md:w-48 lg:w-56 h-56 overflow-hidden rounded-xl shadow-lg transition-transform duration-300 hover:scale-105">
      <img src="../asset/index/hotelviewnearthesea.png" class="w-full h-full object-cover" alt="Hotel 1">
    </div>
    <!-- item 2-->
    <div class="relative w-40 md:w-48 lg:w-56 h-56 overflow-hidden rounded-xl shadow-lg transition-transform duration-300 hover:scale-105 translate-y-6">
      <img src="../asset/index/Hotel Del Coronado_ A Very Detailed Guide.png" class="w-full h-full object-cover" alt="Hotel 2">
    </div>
    <!-- item 3 -->
    <div class="relative w-40 md:w-48 lg:w-56 h-56 overflow-hidden rounded-xl shadow-lg transition-transform duration-300 hover:scale-105">
      <img src="../asset/index/Marriott Hotels Kansas City.png" class="w-full h-full object-cover" alt="Hotel 3">
    </div>
    <!-- item 4-->
    <div class="relative w-40 md:w-48 lg:w-56 h-56 overflow-hidden rounded-xl shadow-lg transition-transform duration-300 hover:scale-105 translate-y-6">
      <img src="../asset/index/travel.png" class="w-full h-full object-cover" alt="Hotel 4">
    </div>
    <!-- item 5 -->
    <div class="relative w-40 md:w-48 lg:w-56 h-56 overflow-hidden rounded-xl shadow-lg transition-transform duration-300 hover:scale-105">
      <img src="../asset/index/32adbebe-a39b-4dcf-8a32-550d19e5541a.png" class="w-full h-full object-cover" alt="Hotel 5">
    </div>
  </div>
</section>

<!-- POPULAR PROPERTIES -->
<section id="hotels" class="max-w-7xl mx-auto px-6 py-16">
  <div class="text-center mb-10">
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">POPULAR PROPERTIES IN INDONESIA</h2>
    <p class=" text-white">Find your comfort hotels at TravelHub</p>
  </div>
  <div class="flex justify-center gap-3 mb-8">
    <button class="city-tab px-5 py-2 rounded-full font-medium text-white bg-blue-700" data-city="all">All</button>
    <?php
      // ambil daftar kota unik
      $cities = $conn->query("SELECT DISTINCT city FROM hotels");
      while($c = $cities->fetch_assoc()) {
        $cityName = trim($c['city']);
        echo '<button class="city-tab px-5 py-2 rounded-full font-medium bg-gray-200 text-gray-800 hover:bg-gray-300 transition" data-city="'.$cityName.'">'.$cityName.'</button>'; }
    ?>
  </div>

  <div id="hotel-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php
      $hotels = $conn->query("SELECT * FROM hotels");
      while($h = $hotels->fetch_assoc()) { ?>
        <div class="hotel-card bg-white rounded-xl shadow-md overflow-hidden transition-transform duration-300 hover:scale-[1.02]" data-city="<?= trim($h['city']) ?>">
          <div class="relative">
            <img src="../<?= $h['image_hotel'] ?>" alt="<?= htmlspecialchars($h['name']) ?>" class="w-full h-48 object-cover">
            <!-- badge rating -->
            <div class="absolute top-3 left-3 bg-blue-700 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
              <?= $h['rating'] ?>/10 • <?= $h['reviews'] ?> reviews
            </div>
          </div>
          <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-1"><?= htmlspecialchars($h['name']) ?></h3>
            <p class="text-sm text-gray-600"><?= htmlspecialchars($h['address']) ?></p>
          </div>
        </div>
    <?php } ?>
  </div>
</section>

<!-- CONTACT US -->
<section id="contact" class="bg-gray-50">
  <div class="max-w-7xl mx-auto py-20">
     <div class="max-w-7xl mx-auto px-6 text-center mb-16">
    <h2 class="text-4xl font-bold text-[#001f3f] mb-2">CONTACT US</h2>
    <p class="text-[#001f3f]">We always here to help out whatever way we can</p>
  </div>
    <div class="grid md:grid-cols-2 shadow-lg rounded-2xl overflow-hidden">
      <div class="w-full h-[500px]">
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.9059060054897!2d106.96404697504853!3d-6.406122162653088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6995d20156e367%3A0x5b7cd089c3c57813!2sSMK%20Bina%20Mandiri%20Multimedia%20Cileungsi!5e0!3m2!1sid!2sid!4v1758730867585!5m2!1sid!2sid" class="w-full h-full" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <div class="bg-[#1E3A8A] text-white p-10 flex flex-col justify-center h-[500px]">
        <h2 class="text-3xl font-extrabold mb-2 py-7">Confirm your messages here</h2>
        <form id="contactForm" class="flex flex-col gap-4">
          <div class="flex items-center bg-white text-gray-700 rounded-full px-4 py-3">
            <i class="fas fa-user mr-3 text-gray-500"></i>
            <input type="text" id="name" placeholder="Name" class="flex-1 bg-transparent outline-none" required>
          </div>

          <div class="flex items-center bg-white text-gray-700 rounded-full px-4 py-3">
            <i class="fas fa-envelope mr-3 text-gray-500"></i>
            <input type="email" id="email" placeholder="Email" class="flex-1 bg-transparent outline-none" required>
          </div>

          <div class="flex items-center bg-white text-gray-700 rounded-full px-4 py-3">
            <i class="fas fa-phone mr-3 text-gray-500"></i>
            <input type="tel" id="phone" placeholder="Telephone" class="flex-1 bg-transparent outline-none" required>
          </div>
          <textarea id="message" placeholder="Type your messages.." rows="3" class="w-full rounded-xl px-4 py-3 text-[#cacaca] mt-2 focus:outline-none resize-none"></textarea>
          <button type="submit" class="mt-4 bg-white text-[#cacaca] font-bold rounded-full py-3 transition hover:bg-gray-200">SEND YOUR MESSAGE</button>
        </form>
      </div>
    </div>
  </div>
</section>
</main>

<script>
   $(document).ready(function(){
      // Hero Carousel
      var $carousel = $('.hero-carousel');
      var $indicator = $('.hero-nav .indicator');
      $carousel.owlCarousel({ loop:true, margin:20, nav:false, items:3, center:true, onChanged:updateIndicator });
      $('.hero-nav .next').click(()=> $carousel.trigger('next.owl.carousel'));
      $('.hero-nav .prev').click(()=> $carousel.trigger('prev.owl.carousel'));
      function updateIndicator(event) {
        let index = (event.item.index - event.relatedTarget._clones.length/2 + event.item.count) % event.item.count;
        $indicator.text((index+1).toString().padStart(2,'0'));
      }
      updateIndicator({item:{index:0,count:$carousel.find('.owl-item:not(.cloned)').length},relatedTarget:{_clones:[]}});

      // Gallery responsive adjustments
      function adjustGallery() {
        const screenWidth = $(window).width();
        const $container = $('.gallery-container');
        const $items = $('.gallery-item');
        
        if (screenWidth < 768) {
          // Mobile layout
          $container.css('height', '300px');
          $items.each(function(index) {
            const mobileStyles = [
              'top: 0; left: 0; width: 120px; height: 160px; z-index: 10;',
              'top: 80px; left: 100px; width: 140px; height: 100px; z-index: 20;',
              'top: 0; left: 220px; width: 100px; height: 80px; z-index: 15;',
              'top: 30px; right: 80px; width: 100px; height: 120px; z-index: 25;',
              'top: 0; right: 0; width: 90px; height: 140px; z-index: 30;'
            ];
            if (mobileStyles[index]) {
              $(this).attr('style', mobileStyles[index]);
            }
          });
        } else if (screenWidth < 1024) {
          // Tablet layout
          $container.css('height', '350px');
          $items.each(function(index) {
            const tabletStyles = [
              'top: 0; left: 0; width: 160px; height: 220px; z-index: 10;',
              'top: 100px; left: 130px; width: 200px; height: 140px; z-index: 20;',
              'top: 0; left: 300px; width: 150px; height: 110px; z-index: 15;',
              'top: 30px; right: 110px; width: 140px; height: 160px; z-index: 25;',
              'top: 0; right: 0; width: 120px; height: 190px; z-index: 30;'
            ];
            if (tabletStyles[index]) {
              $(this).attr('style', tabletStyles[index]);
            }
          });
        } else {
          // Desktop layout (original)
          $container.css('height', '400px');
          $items.each(function(index) {
            const desktopStyles = [
              'top: 0; left: 0; width: 200px; height: 280px; z-index: 10;',
              'top: 120px; left: 160px; width: 260px; height: 180px; z-index: 20;',
              'top: 0; left: 380px; width: 200px; height: 140px; z-index: 15;',
              'top: 40px; right: 140px; width: 180px; height: 200px; z-index: 25;',
              'top: 0; right: 0; width: 160px; height: 240px; z-index: 30;'
            ];
            if (desktopStyles[index]) {
              $(this).attr('style', desktopStyles[index]);
            }
          });
        }
      }
      
      // Initial adjustment and on resize
      adjustGallery();
      $(window).resize(adjustGallery);

      // Gallery hover effects
      $('.gallery-item').hover(
        function() {
          $(this).css('z-index', '100');
        },
        function() {
          // Reset to original z-index after hover
          adjustGallery();
        }
      );
    });
// popular properties
 // Filter hotel berdasarkan city
  const tabs = document.querySelectorAll('.city-tab');
  const hotels = document.querySelectorAll('.hotel-card');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      // reset style tab
      tabs.forEach(t => t.classList.remove('bg-blue-700','text-white'));
      tabs.forEach(t => t.classList.add('bg-gray-200','text-gray-800'));
      tab.classList.add('bg-blue-700','text-white');
      tab.classList.remove('bg-gray-200','text-gray-800');

      const city = tab.dataset.city;
      hotels.forEach(h => {
        if(city === 'all' || h.dataset.city.trim() === city){
          h.classList.remove('hidden');
        } else {
          h.classList.add('hidden');
        }
      });
    });
  });

  // contact us
    document.getElementById('contactForm').addEventListener('submit', function(e){
    e.preventDefault();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const message = document.getElementById('message').value;

    const whatsappNumber = "6283125464551"; // ganti dengan nomor WA kamu
    const text = `Halo, saya ${name} (${email} / ${phone}) ingin menghubungi: ${message}`;
    const url = `https://wa.me/${6285283866535}?text=${encodeURIComponent(text)}`;

    window.open(url, "_blank");
  });
</script>

<?php
include __DIR__ . "/../include/footer.php";
?>