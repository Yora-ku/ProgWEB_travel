<?php
session_start();
require_once __DIR__ . '/../config/connect.php';
require_once __DIR__ . '/../config/baseurl.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm  = mysqli_real_escape_string($conn, $_POST['confirm']);

    // cek password sama
    if ($password !== $confirm) {
        $error = "Password dan Konfirmasi tidak sama!";
    } else {
        // cek username/email sudah ada
        $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Username atau Email sudah digunakan!";
        } else {
            // hash password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // simpan ke database
           $role = mysqli_real_escape_string($conn, $_POST['role'] ?? 'user');
            $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hash', '$role')";
            if (mysqli_query($conn, $sql)) {
                $success = "Pendaftaran berhasil! Silakan <a href='login.php' class='underline font-semibold'>Login</a>";
            } else {
                $error = "Gagal daftar, coba lagi!";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travel.HUB Sign Up</title>
  <link href="<?= base_url('/src/output.css')?>" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="h-screen w-screen flex items-center justify-center relative bg-cover bg-center" style="background-image: url('<?= asset_url("background.jpg") ?>');">
  <!-- Overlay -->
  <div class="absolute inset-0 bg-black/40"></div>
  <!-- Logo pojok kiri atas -->
  <div class="absolute top-6 left-6 z-10 text-3xl font-bold text-white drop-shadow-lg">
      Travel<span class="text-blue-500">.</span>HUB
  </div>
  <!-- Register Card -->
  <div class="relative z-20 w-full max-w-4xl bg-white/20 backdrop-blur-xl rounded-2xl shadow-2xl p-10 flex flex-col md:flex-row gap-10 items-center">
    <!-- Logo Section -->
    <div class="flex flex-col items-center flex-1">
        <div class="w-36 h-36 flex items-center justify-center rounded-full bg-blue-600/90 shadow-lg text-white flex-col">
            <i class="fas fa-map-marker-alt text-4xl mb-2"></i>
            <span class="font-semibold text-lg">Travel.HUB</span>
        </div>
        <h2 class="mt-6 text-white text-2xl font-bold drop-shadow">Travel HUB</h2>
    </div>

    <!-- Form Section -->
    <div class="flex-1 w-full">
      <h2 class="text-white text-xl font-semibold mb-6 text-center uppercase tracking-wide">Create Account</h2>
      
      <?php if (!empty($error)): ?>
        <div class="bg-red-600/80 text-white px-4 py-2 rounded-lg mb-4 shadow-lg">
            <?= $error; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($success)): ?>
        <div class="bg-green-600/80 text-white px-4 py-2 rounded-lg mb-4 shadow-lg">
            <?= $success; ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="">
        <!-- Username -->
        <div class="relative mb-4">
            <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
            <input type="text" name="username" placeholder="Username" required
                   class="w-full pl-12 pr-4 py-3 rounded-full bg-white/90 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none shadow transition">
        </div>

        <!-- Email -->
        <div class="relative mb-4">
            <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
            <input type="email" name="email" placeholder="Email" required
                   class="w-full pl-12 pr-4 py-3 rounded-full bg-white/90 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none shadow transition">
        </div>

        <!-- Password -->
        <div class="relative mb-4">
            <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
            <input type="password" name="password" placeholder="Password" required
                   class="w-full pl-12 pr-4 py-3 rounded-full bg-white/90 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none shadow transition">
        </div>

        <!-- Confirm Password -->
        <div class="relative mb-6">
            <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
            <input type="password" name="confirm" placeholder="Confirm Password" required
                   class="w-full pl-12 pr-4 py-3 rounded-full bg-white/90 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none shadow transition">
        </div>

        <!-- Role (optional for admin panel use) -->
<div class="relative mb-6">
  <i class="fas fa-user-shield absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
  <select name="role" class="w-full pl-12 pr-4 py-3 rounded-full bg-white/90 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none shadow transition">
    <option value="user" selected>User</option>
    <option value="admin">Admin</option>
  </select>
</div>


        <!-- Button -->
        <button type="submit" 
                class="w-full py-3 rounded-full bg-gradient-to-r from-blue-900 to-blue-500 text-white font-semibold uppercase tracking-wide shadow-md hover:shadow-xl transition transform hover:-translate-y-0.5">
            Sign Up
        </button>
      </form>

      <!-- Login link -->
      <p class="text-center mt-6 text-white/80 text-sm">
        Already have an account? 
        <a href="login.php" class="font-bold text-white hover:underline">Log in</a>
      </p>
    </div>
  </div>

</body>
</html>