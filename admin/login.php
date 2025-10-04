<?php
include 'config.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $result = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: index.php");
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Login Admin - Asiatek</title>

    <style>
        body {
            background: linear-gradient(135deg, #b8860b, #ffd700, #daa520);
            background-size: 400% 400%;
            animation: gradientMove 10s ease infinite;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
            backdrop-filter: blur(6px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.3);
        }

        .brand-title {
            font-weight: 800;
            font-size: 1.8rem;
            color: #b8860b;
            text-shadow: 0 1px 2px rgba(0,0,0,0.15);
            margin-bottom: 10px;
        }

        .brand-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 45px 12px 15px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .input-group input:focus {
            border-color: #b8860b;
            background: #fff;
            box-shadow: 0 0 8px rgba(184, 134, 11, 0.4);
            outline: none;
        }

        .input-group i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #b8860b;
            font-size: 18px;
        }

        .btn-login {
            background: linear-gradient(135deg, #b8860b, #ffd700);
            border: none;
            border-radius: 10px;
            height: 45px;
            font-weight: 600;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #a67c00, #e5c100);
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }

        .text-danger {
            font-size: 0.9rem;
            margin-top: 15px;
            color: #dc3545;
        }
    </style>

    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="login-card text-center">
        <div class="brand-title">Asiatek Admin</div>
        <div class="brand-subtitle">Silakan login untuk melanjutkan</div>

        <form method="post">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
                <i class="fa fa-user"></i>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fa fa-lock"></i>
            </div>
            <button name="login" class="btn-login w-100">Login</button>
        </form>

        <?php if (isset($error)) echo "<div class='text-danger'>$error</div>"; ?>
    </div>
</body>
</html>
