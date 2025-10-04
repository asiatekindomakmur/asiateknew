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
    <title>Login Admin</title>

    <style>
        body {
            background: linear-gradient(135deg, #007bff, #6610f2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        .login-card h4 {
            margin-bottom: 25px;
            font-weight: 600;
            color: #343a40;
        }

        .form-control {
            height: 45px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #6610f2);
            border: none;
            border-radius: 8px;
            height: 45px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056d2, #520dc2);
            transform: translateY(-1px);
        }

        .text-danger {
            font-size: 0.9rem;
            margin-top: 15px;
        }

        .brand-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 10px;
        }

        .brand-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="login-card text-center">
        <div class="brand-title">Company Admin</div>
        <div class="brand-subtitle">Silakan login untuk melanjutkan</div>

        <form method="post">
            <input type="text" name="username" placeholder="Username" class="form-control mb-3" required>
            <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
            <button name="login" class="btn btn-primary w-100">Login</button>
        </form>

        <?php if (isset($error)) echo "<div class='text-danger'>$error</div>"; ?>
    </div>
</body>
</html>
