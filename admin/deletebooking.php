<?php
require_once __DIR__ . '/../config/connect.php';

$id = $_GET['id'];
$hapus = mysqli_query($conn, "DELETE FROM bookings WHERE booking_id = '$id'");

if ($hapus) {
  echo "<script>alert('Data booking berhasil dihapus'); window.location='booking-data.php';</script>";
} else {
  echo "<script>alert('Gagal menghapus data'); history.back();</script>";
}
?>
