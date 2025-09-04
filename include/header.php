<?php 
session_start();
require_once __DIR__ . '/../config/connect.php';
include_once __DIR__ . '/../config/baseurl.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>TravelHub — Hotels</title>
  <link href="<?= base_url('/src/output.css')?>" rel="stylesheet">
</head>

<body class="bg-gray-900 text-gray-100 font-sans">
  <div class="max-w-[1180px] mx-auto px-6">
  <!-- Top mini-bar -->
    <div class="flex justify-end gap-4 text-sm text-gray-400 py-2">
      <?php if(isset($_SESSION['user'])): ?>
    <!-- Jika sudah login -->
    <span>Welcome, <?= $_SESSION['user'] ?></span>
    <a href="<?= base_url('auth/logout.php') ?>" class="hover:text-white transition">Logout</a>
<?php else: ?>
    <!-- Jika belum login -->
    <a href="<?= base_url('auth/login.php')?>" class="hover:text-white transition">Login</a>
    <span>/</span>
    <a href="<?= base_url('auth/signup.php')?>" class="hover:text-white transition">Register</a>
<?php endif; ?>

    </div>
  </div>

  <!-- Header / Nav -->
  <header class="sticky top-0 z-50 bg-gray-900/60 backdrop-blur-md border-b border-gray-800">
    <div class="max-w-[1180px] mx-auto px-6 flex items-center justify-between py-4">
      <!-- Brand / Logo -->
      <a href="#" class="flex items-center gap-3">
        <img src="<?=asset_url('image/Logo.png')?>" alt="TravelHub Logo" class="w-10 h-10 rounded-lg shadow-md">
        <span class="font-bold text-xl tracking-wide">TravelHub</span>
      </a>

      <!-- Nav Menu -->
      <nav class="flex gap-7">
        <a href="<?= base_url('page/hotel.php') ?>" class="font-semibold text-gray-400 hover:text-white transition">Homes</a>
        <a href="<?= base_url('page/index.php') ?>" class="font-semibold text-gray-400 hover:text-white transition">Hotels</a>
        <a href="#contact" class="font-semibold text-gray-400 hover:text-white transition">Contact Us</a>
      </nav>
    </div>
  </header>