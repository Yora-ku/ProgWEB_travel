<?php
include __DIR__ . "/../config/connect.php";
include __DIR__ . '/../config/baseurl.php';
session_start();

// cek login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Akses tidak valid.");
}

// Ambil data user login
$user_id = $_SESSION['user'];

// Ambil data dari form
$destination_id = isset($_POST['destination']) ? intval($_POST['destination']) : null;
$hotel_id       = isset($_POST['hotel']) ? intval($_POST['hotel']) : null;
$fullname       = trim($_POST['fullname']);
$phone          = trim($_POST['phone']);
$checkin        = $_POST['checkin'];
$checkout       = $_POST['checkout'];
$guests         = intval($_POST['guests']) ?: 1;
$hotel_price    = isset($_POST['hotel_price']) ? (int) $_POST['hotel_price'] : 0;

// Validasi sederhana
$errors = [];
if (!$destination_id) $errors[] = "Destinasi wajib dipilih.";
if (!$hotel_id) $errors[] = "Hotel wajib dipilih.";
if ($fullname === "") $errors[] = "Nama lengkap wajib diisi.";
if ($phone === "") $errors[] = "Nomor telepon wajib diisi.";
if ($checkin === "" || $checkout === "") $errors[] = "Tanggal wajib diisi.";
if (strtotime($checkout) <= strtotime($checkin)) $errors[] = "Tanggal check-out harus setelah check-in.";

if (count($errors) > 0) {
    echo "<h2>Terjadi kesalahan:</h2><ul>";
    foreach ($errors as $e) {
        echo "<li>" . htmlspecialchars($e) . "</li>";
    }
    echo "</ul><a href='javascript:history.back()'>Kembali</a>";
    exit();
}

// Hitung total harga
$nights = (strtotime($checkout) - strtotime($checkin)) / (60 * 60 * 24);
$total_price = $hotel_price * $nights * $guests;

// Simpan booking ke database
$stmt = $conn->prepare("
    INSERT INTO bookings 
    (user_id, hotel_id, destination_id, check_in, check_out, full_name, phone_number, total_price, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Pending')
");

$stmt->bind_param(
    "iiissssd",
    $user_id, $hotel_id, $destination_id,
    $checkin, $checkout, $fullname, $phone, $total_price
);

if ($stmt->execute()) {
    $lastId = $stmt->insert_id;
    header("Location:" . base_url("page/hotel.php?success=1&booking_id=" . $lastId));
    exit();
    
} else {
    echo "Gagal menyimpan booking: " . $conn->error;
}
?>
<?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var successModal = new bootstrap.Modal(document.getElementById('checkoutSuccess'));
    successModal.show();
  });
</script>
<?php endif; ?>

<!-- Modal -->

