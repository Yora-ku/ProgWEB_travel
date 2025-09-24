<?php
include __DIR__ . "/../include/header.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}
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
      background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e') no-repeat center center/cover;
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
  </style>
</head>
<body class="bg-gray-50">

  <!-- Hero Section -->
  <section class="hero">
    <div class="overlay"></div>
    <div class="container">
      <div class="hero-content">
        <h1>NEVER STOP <br> EXPLORING <br> THE WORLD.</h1>
        <p>With Travel.HUB, it’s easy to explore the world without a worry.</p>
      </div>
      <div class="hero-carousel-wrapper">
        <div class="hero-carousel owl-carousel">
          <div class="card" style="background-image:url('../asset/hotels/swiss.jpg')"></div>
          <div class="card" style="background-image:url('../asset/hotels/jepang.jpg')"></div>
          <div class="card" style="background-image:url('../asset/hotels/italia.jpg')"></div>
          <div class="card" style="background-image:url('../asset/hotels/perancis.jpg')"></div>
        </div>
        <div class="hero-nav">
          <button class="prev"><i class="fas fa-arrow-left"></i></button>
          <span class="indicator">01</span>
          <button class="next"><i class="fas fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </section>

  <!-- Travel Adventures -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
    <div class="relative">
      <div class="w-96 h-96 mx-auto relative">
        <div 
          class="absolute inset-8 rounded-full flex items-center justify-center shadow-2xl overflow-hidden"
          style="background-image: url('/pweb/ProgWEB_travel/asset/hotels/pesawat1.png'); background-position:center; background-size:cover; background-repeat:no-repeat;">
        </div>
      </div>
    </div>

    <div>
      <h2 class="text-4xl font-bold text-gray-800 mb-6">
        Our Travels Have <br><span class=text-[#001f3f]">Adventures</span>
      </h2>
      <p class="text-gray-600 mb-8 leading-relaxed">
        Experience unforgettable adventures with our carefully curated travel packages. 
        From pristine beaches to majestic mountains, we bring you the world's most beautiful destinations.
      </p>
      <div class="grid grid-cols-3 gap-8 mb-8">
        <div class="text-center">
          <div class="text-3xl font-bold text-[#001f3f] mb-2">24K+</div>
          <div class="text-gray-600 text-sm">Happy Customers</div>
        </div>
        <div class="text-center">
          <div class="text-3xl font-bold text-[#001f3f] mb-2">20+</div>
          <div class="text-gray-600 text-sm">Years Experience</div>
        </div>
        <div class="text-center">
          <div class="text-3xl font-bold text-[#001f3f] mb-2">10,000+</div>
          <div class="text-gray-600 text-sm">Destinations</div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- Destinations -->
<section class="py-20 bg-gradient-to-r from-blue-900 to-blue-600 text-white">
  <div class="max-w-7xl mx-auto px-6 text-center mb-16">
    <h2 class="text-4xl font-bold mb-4">Choose your destination</h2>
    <p class="text-gray-300">Discover amazing places around the world</p>
  </div>

  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php
    include __DIR__ . "/../config/connect.php"; 

    $sql = "SELECT * FROM destinations";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-105 transition">
          <div class="h-48 overflow-hidden">
            <img src="../'.$row['image_url'].'" alt="'.$row['name'].'" class="w-full h-full object-cover">
          </div>
          <div class="p-6 text-gray-800">
            <h4 class="font-bold mb-2">'.$row['name'].' - '.$row['location'].'</h4>
            <p class="text-gray-600 text-sm mb-4">'.substr($row['description'],0,100).'...</p>
            <p class="text-blue-600 font-semibold mb-4">Rp '.number_format($row['price'],0,',','.').'</p>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">Learn More</button>
          </div>
        </div>';
      }
    } else {
      echo "<p class='text-white col-span-3'>No destinations found.</p>";
    }
    ?>
  </div>
</section>

   <!-- Mobile App Section -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
    
    <!-- Mockup HP -->
    <div class="flex justify-center">
      <div class="relative w-64 h-[520px] bg-black rounded-[2.5rem] shadow-2xl overflow-hidden">
        <div class="absolute top-0 left-1/2 w-24 h-6 bg-black rounded-b-2xl z-20" style="transform: translateX(-50%);"></div>
        <img src="../asset/hotels/Flight Ticket Booking Landing Page1.jpg" alt="App Screenshot" class="w-full h-full object-cover">
      </div>
    </div>

   <!-- Text & Features -->
<div class="text-[#001f3f]">
  <h2 class="text-4xl font-bold mb-6">Get free flight status updates on the go</h2>
  <ul class="space-y-6">
    <li class="flex items-start gap-4">
      <img src="../asset/hotels/ticketpesawat.png" class="w-12 h-12 flex-shrink-0" alt="icon">
      <p class="flex-1">Track over <span class="font-bold">110,000 global flights</span> in real time</p>
    </li>
    <li class="flex items-start gap-4">
      <img src="../asset/hotels/boarding.png" class="w-12 h-12 flex-shrink-0" alt="icon">
      <p class="flex-1">Easily navigate airports with check-in counter, boarding gate, and baggage claim info</p>
    </li>
    <li class="flex items-start gap-4">
      <img src="../asset/hotels/realtimestatus.png" class="w-12 h-12 flex-shrink-0" alt="icon">
      <p class="flex-1">Get <span class="font-bold">real-time flight status</span> updates anytime</p>
    </li>
  </ul>
</div>
</section>
  <script>
    $(document).ready(function(){
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
    });
  </script>
</body>
</html>

<?php
include __DIR__ . "/../include/footer.php";
?>
