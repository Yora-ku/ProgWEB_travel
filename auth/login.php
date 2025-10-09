<?php
session_start();
require_once __DIR__ . '/../config/connect.php';
require_once __DIR__ . '/../config/baseurl.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    $username = mysqli_real_escape_string($conn, $username);

    // 🔍 Ambil user sesuai username/email dan role
    $sql = "SELECT * FROM users WHERE (username='$username' OR email='$username') AND role='$role' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = [
                'user_id' => $row['user_id'],
                'username' => $row['username'],
                'role' => $row['role']
            ];

            // ✅ Redirect sesuai role
            if ($row['role'] === 'admin') {
                header("Location: " . base_url('/admin/dashboard.php'));
                exit;
            } elseif ($row['role'] === 'user') {
                header("Location: " . base_url('/page/index.php'));
                exit;
            } else {
                $error = "Role tidak dikenali!";
            }
        } else {
            $error = "⚠️ Password salah!";
        }
    } else {
        $error = "⚠️ Username/Email tidak ditemukan atau role salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Travel.HUB Login</title>
  <link href="<?= base_url('/src/output.css')?>" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="h-screen w-screen flex items-center justify-center relative bg-cover bg-center" 
      style="background-image: url('<?= asset_url("background.jpg") ?>');">
  
  <div class="absolute inset-0 bg-black/40"></div>

  <div class="absolute top-6 left-6 z-10 text-3xl font-bold text-white drop-shadow-lg">
      Travel<span class="text-blue-500">.</span>HUB
  </div>

  <div class="relative z-20 w-full max-w-4xl bg-white/20 backdrop-blur-xl rounded-2xl shadow-2xl p-10 flex flex-col md:flex-row gap-10 items-center">
    
    <!-- Logo -->
    <div class="flex flex-col items-center flex-1">
        <div class="w-36 h-36 flex items-center justify-center rounded-full bg-blue-600/90 shadow-lg text-white flex-col">
            <i class="fas fa-map-marker-alt text-4xl mb-2"></i>
            <span class="font-semibold text-lg">Travel.HUB</span>
        </div>
        <h2 class="mt-6 text-white text-2xl font-bold drop-shadow">Travel HUB</h2>
    </div>

    <!-- Form Login -->
    <div class="flex-1 w-full">
      <h2 class="text-white text-xl font-semibold mb-6 text-center uppercase tracking-wide">Login to Continue</h2>
      
      <?php if (!empty($error)): ?>
        <div class="bg-red-600/80 text-white px-4 py-2 rounded-lg mb-4 shadow-lg text-center">
            <?= $error; ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="relative mb-4">
            <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
            <input type="text" name="username" placeholder="Username/Email" required
                   class="w-full pl-12 pr-4 py-3 rounded-full bg-white/90 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none shadow transition">
        </div>

        <div class="relative mb-4">
            <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
            <input type="password" name="password" placeholder="Password" required
                   class="w-full pl-12 pr-4 py-3 rounded-full bg-white/90 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none shadow transition">
        </div>

       <!-- 🔽 Dropdown Role -->
<div class="relative mb-6">
  <select name="role" required
          class="w-full py-3 px-4 rounded-full bg-white/90 focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none shadow">
      <option value="" disabled selected>Pilih Role</option>
      <?php
      $roleQuery = mysqli_query($conn, "SELECT DISTINCT LOWER(role) AS role FROM users ORDER BY role ASC");
      while ($roleRow = mysqli_fetch_assoc($roleQuery)) {
          echo '<option value="' . htmlspecialchars($roleRow['role']) . '">' . ucfirst($roleRow['role']) . '</option>';
      }
      ?>
  </select>
</div>
      
        <button type="submit" 
                class="w-full py-3 rounded-full bg-gradient-to-r from-blue-900 to-blue-500 text-white font-semibold uppercase tracking-wide shadow-md hover:shadow-xl transition transform hover:-translate-y-0.5">
            Log in
        </button>
      </form>
      <p class="text-center mt-6 text-white/80 text-sm">
        Don't have an account? 
        <a href="signup.php" class="font-bold text-white hover:underline">Sign up</a>
      </p>
    </div>
  </div>
</body>
</html>
