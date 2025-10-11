<?php
include __DIR__ . "/../include/header.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Ambil data dari DB
$sqlDest = "SELECT * FROM destinations";
$destinations = $conn->query($sqlDest);

$sqlHotels = "SELECT * FROM hotels";
$hotels = $conn->query($sqlHotels);

$selectedDest = isset($_GET['destination']) ? intval($_GET['destination']) : null;
$selectedHotel = isset($_GET['hotel']) ? intval($_GET['hotel']) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TravelHub - Booking</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .card-shadow { box-shadow: 0 6px 16px rgba(0,0,0,0.12); }
  </style>
</head>
<body class="bg-gray-900 text-gray-800">

  <!-- Hero -->
  <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-16 text-center">
    <h1 class="text-4xl md:text-5xl font-bold">Booking Travel</h1>
    <p class="mt-3 text-lg text-blue-100">Isi data perjalananmu dan lihat detail hotel pilihanmu ✈️</p>
  </section>

  <!-- Container -->
  <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-10 -mt-12 px-6 relative z-10">

    <!-- Form Booking (Kiri) -->
    <div class="bg-white rounded-3xl card-shadow p-8">
      <h2 class="text-2xl font-bold mb-6 text-center text-[#001f3f]">Form Booking</h2>
      <form action="proses_booking.php" method="POST" class="space-y-6 text-lg">

        <!-- Nama -->
        <div>
          <label class="block font-bold mb-2 text-[#001f3f]">Nama Lengkap</label>
          <input type="text" name="fullname" required
            class="w-full border-2 rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-[#001f3f]">
        </div>

        <!-- Email -->
        <div>
          <label class="block font-bold mb-2 text-[#001f3f]">Email</label>
          <input type="email" name="email" required
            class="w-full border-2 rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-[#001f3f]">
        </div>

        <!-- Telepon -->
        <div>
          <label class="block font-bold mb-2 text-[#001f3f]">No. Telepon</label>
          <input type="tel" name="phone" required
            class="w-full border-2 rounded-xl px-4 py-3 text-gray-900 focus:ring-2 focus:ring-[#001f3f]">
        </div>

       <!-- Destinasi -->
        <!-- Selalu kirim hidden input -->
<input type="hidden" name="destination" value="<?= $selectedDest ?? '' ?>">

<?php if ($selectedDest): ?>
<div>
  <label class="block font-bold mb-2 text-[#001f3f]">Destinasi</label>
  <select id="destination"
    class="w-full border-2 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400 text-[#001f3f]"
    disabled>
    <option value="">Pilih destinasi</option>
    <?php while ($row = $destinations->fetch_assoc()): ?>
      <option value="<?= $row['destination_id'] ?>" <?= ($row['destination_id'] == $selectedDest) ? 'selected' : '' ?>>
        <?= $row['name'] ?>
      </option>
    <?php endwhile; ?>
  </select>
</div>
<?php endif; ?>
        <!-- Hotel -->
         

<?php if ($selectedHotel): ?>
  <input type="hidden" name="hotel" value="<?= $selectedHotel ?>">


       <div>
  <label class="block font-bold mb-2 text-[#001f3f]">Hotel</label>
  <select name="hotel" id="hotel"
    class="w-full border-2 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400 text-[#001f3f]"
    onchange="updateHotelPreview()" <?= $selectedDest ? 'disabled' : '' ?>>
    <option value="">Pilih hotel</option>
<?php while ($row = $hotels->fetch_assoc()): ?>
  <option 
    value="<?= $row['hotel_id'] ?>"
    data-name="<?= htmlspecialchars($row['name']) ?>"
    data-img="<?= !empty($row['image_hotel']) ? '../'.$row['image_hotel'] : 'https://via.placeholder.com/600x400?text=Hotel'; ?>"
    data-desc="<?= htmlspecialchars($row['description']) ?>"
    data-price="<?= (int) $row['price'] ?>"
    <?= ($row['hotel_id'] == $selectedHotel) ? 'selected' : '' ?>>
    <?= $row['name'] ?>
  </option>
<?php endwhile; ?>
  </select>
</div>
<?php endif; ?>
<!-- Tanggal -->
<div class="grid grid-cols-2 gap-4">
  <div>
    <label class="block font-bold mb-2 text-[#001f3f]">Check-in</label>
    <input type="date" name="checkin" id="checkin"
      class="w-full border-2 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400 text-[#001f3f]">
  </div>
  <div>
    <label class="block font-bold mb-2 text-[#001f3f]">Check-out</label>
    <input type="date" name="checkout" id="checkout"
      class="w-full border-2 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400 text-[#001f3f]">
  </div>
</div>

<!-- Jumlah Orang -->
<div>
  <label class="block font-bold mb-2 text-[#001f3f]">Jumlah Orang</label>
  <input type="number" name="guests" id="guests" min="1" value="1"
    class="w-full border-2 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400 text-[#001f3f]">
</div>

<input type="hidden" name="hotel_name" id="hotel_name">
  <input type="hidden" name="hotel_price" id="hotel_price">
  <input type="hidden" name="hotel_desc" id="hotel_desc">

        <!-- Submit -->
        <div class="pt-4">
          <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-xl transition text-xl">
            Pesan Sekarang
          </button>
        </div>
      </form>
    </div>

    <!-- Preview Hotel (Kanan) -->
    <div id="hotelPreview" class="bg-white rounded-3xl card-shadow overflow-hidden p-6 hidden">
      <img id="hotelImg" src="" class="w-full h-64 object-cover rounded-xl mb-4">
      <h3 id="hotelTitle" class="text-2xl font-semibold mb-2 text-[#001f3f]"></h3>
      <p id="hotelDesc" class="text-gray-600 mb-4"></p>
      <p class="text-lg font-bold text-blue-600">Rp <span id="hotelPrice"></span> / malam</p>

      <!-- total harga -->
      <div class="mt-4 border-t pt-4">
        <p class="text-lg font-semibold text-gray-700">Total Harga:</p>
        <p class="text-2xl font-bold text-green-600">Rp <span id="totalPrice">0</span></p>
      </div>
    </div>
  </div>

  <script>
    // Format angka ke rupiah
    function formatRupiah(num) {
      return new Intl.NumberFormat('id-ID').format(num);
    }

    // Animasi angka naik turun
    function animateValue(id, start, end, duration) {
      const obj = document.getElementById(id);
      let startTimestamp = null;
      const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.innerText = formatRupiah(Math.floor(progress * (end - start) + start));
        if (progress < 1) {
          window.requestAnimationFrame(step);
        }
      };
      window.requestAnimationFrame(step);
    }

    function updateHotelPreview() {
    const select = document.getElementById('hotel');
    const option = select.options[select.selectedIndex];

    if (!option.value) {
      document.getElementById('hotelPreview').classList.add('hidden');
      return;
    }

    // Tampilkan preview
    document.getElementById('hotelImg').src = option.getAttribute('data-img');
    document.getElementById('hotelTitle').innerText = option.getAttribute('data-name');
    document.getElementById('hotelDesc').innerText = option.getAttribute('data-desc');
    document.getElementById('hotelPrice').innerText = formatRupiah(option.getAttribute('data-price'));

    // Isi hidden input supaya ikut terkirim
    document.getElementById('hotel_name').value = option.getAttribute('data-name');
    document.getElementById('hotel_price').value = option.getAttribute('data-price');
    document.getElementById('hotel_desc').value = option.getAttribute('data-desc');

    document.getElementById('hotelPreview').classList.remove('hidden');
    hitungTotal();
  }

    function hitungTotal() {
      const hotelSelect = document.getElementById('hotel');
      const option = hotelSelect.options[hotelSelect.selectedIndex];
      const price = parseInt(option?.getAttribute('data-price')) || 0;

      const checkin = new Date(document.getElementById('checkin').value);
      const checkout = new Date(document.getElementById('checkout').value);
      const guests = parseInt(document.getElementById('guests').value) || 1;

      let nights = 0;
      if (checkin && checkout && checkout > checkin) {
        nights = (checkout - checkin) / (1000 * 60 * 60 * 24);
      }

      const total = price * nights * guests;

      const totalElem = document.getElementById('totalPrice');
      const oldValue = parseInt(totalElem.innerText.replace(/\./g, "")) || 0;

      animateValue('totalPrice', oldValue, total, 800);
    }

    // disable tanggal sebelum hari ini
    const today = new Date().toISOString().split("T")[0];
    document.getElementById("checkin").setAttribute("min", today);
    document.getElementById("checkout").setAttribute("min", today);

    // event listener
    document.getElementById('checkin').addEventListener('change', hitungTotal);
    document.getElementById('checkout').addEventListener('change', hitungTotal);
    document.getElementById('guests').addEventListener('input', hitungTotal);

    window.addEventListener("DOMContentLoaded", () => {
  const hotelSelect = document.getElementById('hotel');
  if (hotelSelect.value) {
    updateHotelPreview();
  }
});

  </script>
</body>
</html>
