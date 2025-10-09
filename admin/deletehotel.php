<?php
include '../config/connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $hapus = mysqli_query($conn, "DELETE FROM hotels WHERE hotel_id = '$id'");

    if ($hapus) {
        echo "<script>alert('Data hotel berhasil dihapus!'); window.location='hotel-insert.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.'); window.location='hotel-insert.php';</script>";
    }
} else {
    header("Location: hotel-insert.php");
    exit;
}
?>
