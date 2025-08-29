<?php
session_start();
include "db.php";

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
        // cek username/email sudah ada atau belum
        $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Username atau Email sudah digunakan!";
        } else {
            // hash password
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // simpan ke database
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hash')";
            if (mysqli_query($conn, $sql)) {
                $success = "Pendaftaran berhasil! Silakan <a href='login.php'>Login</a>";
            } else {
                $error = "Gagal daftar, coba lagi!";
            }
        }
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Travel.HUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            background-image: url('background.jpg');
            background-size: cover;
            background-position: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .santorini-bg {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60%;
            background: url('background.jpg');
            background-size: cover;
            background-position: bottom;
            background-repeat: no-repeat;
        }

        .container-fluid {
            height: 100vh;
            position: relative;
            z-index: 2;
        }

        .top-left-logo {
            position: absolute;
            top: 30px;
            left: 30px;
            z-index: 10;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .top-left-logo .dot {
            color: #007BFF;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 800px;
            width: 100%;
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .logo-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .logo {
            width: 150px;
            height: 150px;
            background: rgba(0, 123, 191, 0.9);
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            margin-bottom: 20px;
        }

        .logo i {
            font-size: 2.5rem;
            margin-bottom: 8px;
        }

        .logo-text {
            font-size: 1.4rem;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .brand-title {
            color: white;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .form-section {
            flex: 1;
        }

        .register-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 25px;
            padding: 15px 20px;
            padding-left: 50px;
            margin-bottom: 20px;
            font-size: 14px;
            transition: all 0.3s ease;
            height: 50px;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border: none;
            outline: none;
        }

        .form-control::placeholder {
            color: #999;
            font-size: 14px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            z-index: 5;
            font-size: 16px;
        }

        .btn-register {
            background: linear-gradient(45deg, #1e3a8a, #3b82f6);
            border: none;
            border-radius: 25px;
            padding: 12px;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: linear-gradient(45deg, #1e40af, #2563eb);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            color: white;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }

        .login-link a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-left: 5px;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .resolution-badge {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(59, 130, 246, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            backdrop-filter: blur(10px);
        }

        @media (max-width: 768px) {
            .top-left-logo {
                font-size: 1.5rem;
                top: 20px;
                left: 20px;
            }

            .register-card {
                flex-direction: column;
                max-width: 400px;
                gap: 20px;
                margin: 20px;
                padding: 30px 25px;
                margin-top: 80px;
            }
            
            .logo {
                width: 120px;
                height: 120px;
            }
            
            .logo i {
                font-size: 2rem;
            }
            
            .logo-text {
                font-size: 1.2rem;
            }
            
            .brand-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="santorini-bg"></div>
    
    <!-- Top Left Logo -->
    <div class="top-left-logo">
        Travel<span class="dot">.</span>HUB
    </div>
    
    <div class="container-fluid d-flex">
        <!-- Register Section -->
        <div class="d-flex align-items-center justify-content-center flex-grow-1">
            <div class="register-card">
                <!-- Logo Section -->
                <div class="logo-section">
                    <div class="logo">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="logo-text">Travel.HUB</div>
                    </div>
                    <div class="brand-title">Travel HUB</div>
                </div>

                <!-- Form Section -->
                <div class="form-section">
                    <h2 class="register-title">Create Account</h2>
                    
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background: rgba(220, 53, 69, 0.8); border: none; color: white;">
                            <?php echo $error; ?>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="background: rgba(25, 135, 84, 0.8); border: none; color: white;">
                            <?php echo $success; ?>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="input-group">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                        
                        <div class="input-group">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        
                        <div class="input-group">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>

                        <div class="input-group">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" class="form-control" name="confirm" placeholder="Confirm Password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-register">Sign Up</button>
                    </form>
                    
                    <div class="login-link">
                        Already have an account? <a href="login.php">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resolution Badge
    <div class="resolution-badge">
        2295 × 2621
    </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add floating animation to logo
            const logo = document.querySelector('.logo');
            if (logo) {
                logo.style.animation = 'float 3s ease-in-out infinite';
            }
            
            // Add focus effects to inputs
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });
        });
        
        // CSS for floating animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>