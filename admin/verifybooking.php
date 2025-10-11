<?php
session_start();
require_once __DIR__ . '/../config/connect.php';

// Pastikan admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header("Location: ../auth/login.php");
  exit();
}

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "UPDATE bookings SET status = 'Confirmed' WHERE booking_id = $id";
  if ($conn->query($sql)) {
    header("Location: booking-data.php?success=Confirmed");
    exit();
  } else {
    echo "Gagal memverifikasi booking.";
  }
} else {
  header("Location: booking-data.php");
  exit();
}
?>
