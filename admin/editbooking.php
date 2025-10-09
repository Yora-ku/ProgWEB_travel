<?php
require_once __DIR__ . '/../config/connect.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM bookings WHERE booking_id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
  echo "Data tidak ditemukan!";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $full_name   = $_POST['full_name'];
  $phone       = $_POST['phone_number'];
  $check_in    = $_POST['check_in'];
  $check_out   = $_POST['check_out'];
  $guests      = $_POST['guests'];
  $status      = $_POST['status'];

  // validasi tanggal
  if (strtotime($check_out) < strtotime($check_in)) {
    echo "<script>alert('Tanggal check-out tidak boleh sebelum check-in'); history.back();</script>";
    exit;
  }

  $update = mysqli_query($conn, "UPDATE bookings 
    SET full_name='$full_name', phone_number='$phone', check_in='$check_in', 
        check_out='$check_out', guests='$guests', status='$status' 
    WHERE booking_id='$id'");

  if ($update) {
    echo "<script>alert('Data berhasil diperbarui!'); window.location='booking-data.php';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui data');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Booking</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0b1733] text-white flex justify-center items-center min-h-screen">
  <div class="bg-[#14264c] p-8 rounded-2xl w-full max-w-lg shadow-xl">
    <h2 class="text-2xl font-semibold mb-6 text-center text-blue-300">Edit Data Booking</h2>
    <form method="POST" class="space-y-4">
      <div>
        <label class="block mb-1">Nama Lengkap</label>
        <input type="text" name="full_name" value="<?= htmlspecialchars($data['full_name']) ?>" required class="w-full px-4 py-2 rounded-md bg-white/20 border border-white/10 outline-none">
      </div>
      <div>
        <label class="block mb-1">Nomor Telepon</label>
        <input type="text" name="phone_number" value="<?= htmlspecialchars($data['phone_number']) ?>" required class="w-full px-4 py-2 rounded-md bg-white/20 border border-white/10 outline-none">
      </div>
      <div class="flex gap-4">
        <div class="flex-1">
          <label class="block mb-1">Check-in</label>
          <input type="date" name="check_in" value="<?= $data['check_in'] ?>" required class="w-full px-4 py-2 rounded-md bg-white/20 border border-white/10 outline-none">
        </div>
        <div class="flex-1">
          <label class="block mb-1">Check-out</label>
          <input type="date" name="check_out" value="<?= $data['check_out'] ?>" required class="w-full px-4 py-2 rounded-md bg-white/20 border border-white/10 outline-none">
        </div>
      </div>
      <div>
        <label class="block mb-1">Jumlah Tamu</label>
        <input type="number" name="guests" value="<?= $data['guests'] ?>" required class="w-full px-4 py-2 rounded-md bg-white/20 border border-white/10 outline-none">
      </div>
      <div>
        <label class="block mb-1">Status</label>
        <select name="status" class="w-full px-4 py-2 rounded-md bg-white/20 border border-white/10 outline-none">
          <option value="Pending" <?= $data['status']=='Pending'?'selected':'' ?>>Pending</option>
          <option value="Confirmed" <?= $data['status']=='Confirmed'?'selected':'' ?>>Confirmed</option>
          <option value="Cancelled" <?= $data['status']=='Cancelled'?'selected':'' ?>>Cancelled</option>
        </select>
      </div>
      <div class="flex justify-between mt-6">
        <a href="booking-data.php" class="bg-gray-600 hover:bg-gray-500 px-4 py-2 rounded-lg">Kembali</a>
        <button type="submit" class="bg-blue-600 hover:bg-blue-500 px-6 py-2 rounded-lg">Simpan</button>
      </div>
    </form>
  </div>
</body>
</html>
