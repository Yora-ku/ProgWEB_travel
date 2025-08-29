<?php
include __DIR__ . "/../include/header.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

$sqlDest = "SELECT * FROM destinations LIMIT 6";
$resultDest = $conn->query($sqlDest);
?>

<main class="bg-gray-50">

  <!-- HERO -->
  <section class="relative bg-cover bg-center" style="background-image:url('<?= asset_url("hero-bg.jpg") ?>')">
    <div class="bg-black/50">
      <div class="max-w-7xl mx-auto px-6 py-32 text-center text-white">
        <h1 class="text-5xl md:text-6xl font-extrabold leading-tight">NEVER STOP<br>EXPLORING THE WORLD.</h1>
        <p class="mt-6 text-lg text-gray-200">Find your next adventure with us</p>
      </div>
    </div>
  </section>

  <!-- SEARCH DESTINATION -->
    <section class="max-w-5xl mx-auto px-6 -mt-10 relative z-10">
        <form class="bg-white rounded-2xl shadow-xl p-6 grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
            
            <!-- Destination -->
            <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Destination</label>
            <input type="text" placeholder="Where to?" 
                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm 
                    focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <!-- Date -->
            <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
            <input type="date" 
                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm 
                    focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <!-- Guests -->
            <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Guests</label>
            <select 
                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm 
                    focus:border-blue-500 focus:ring-2 focus:ring-blue-500 outline-none">
                <option>1 room, 2 adults, 0 children</option>
                <option>2 rooms, 4 adults, 0 children</option>
                <option>1 room, 2 adults, 2 children</option>
            </select>
            </div>

            <!-- Button -->
            <div class="flex items-end">
            <button class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold shadow-md hover:bg-blue-700 transition">
                Search
            </button>
            </div>

        </form>
    </section>



  <!-- STATS -->
  <section class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 sm:grid-cols-3 text-center gap-8">
    <div>
      <h3 class="text-3xl font-bold text-blue-600">24K+</h3>
      <p class="text-gray-600">Customers</p>
    </div>
    <div>
      <h3 class="text-3xl font-bold text-blue-600">20+</h3>
      <p class="text-gray-600">Countries</p>
    </div>
    <div>
      <h3 class="text-3xl font-bold text-blue-600">10,000+</h3>
      <p class="text-gray-600">Bookings</p>
    </div>
  </section>

  <!-- MOBILE PROMO -->
  <section class="bg-blue-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
      <img src="<?= asset_url("mobile-app.png") ?>" class="w-64 mx-auto md:mx-0">
      <div>
        <h2 class="text-3xl font-bold mb-4">Get free flight status updates on the go</h2>
        <ul class="space-y-3 text-lg">
          <li>✔ Track over 100,000 flights in real-time</li>
          <li>✔ Quickly explore alternate routes & airlines</li>
          <li>✔ Save money with flight alerts</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- DESTINATIONS -->
  <section class="max-w-7xl mx-auto px-6 py-16">
    <h2 class="text-2xl font-bold mb-8 text-center">Choose Your Destination</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <?php while($dest = $resultDest->fetch_assoc()) { ?>
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
          <img src="../<?= $dest['image_url'] ?>" class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="font-semibold text-lg"><?= $dest['name'] ?></h3>
            <p class="text-gray-500 text-sm"><?= $dest['location'] ?></p>
          </div>
        </div>
      <?php } ?>
    </div>
  </section>

</main>

<?php include __DIR__ . "/../include/footer.php"; ?>
