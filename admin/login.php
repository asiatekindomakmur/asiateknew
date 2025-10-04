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
</head>
<body class="bg-light d-flex align-items-center" style="height:100vh;">
<div class="container text-center">
    <div class="col-md-4 mx-auto p-4 bg-white shadow rounded">
        <h4>Login Admin</h4>
        <form method="post">
            <input type="text" name="username" placeholder="Username" class="form-control mb-3" required>
            <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
            <button name="login" class="btn btn-primary w-100">Login</button>
        </form>
        <?php if (isset($error)) echo "<div class='text-danger mt-3'>$error</div>"; ?>
    </div>
</div>
</body>
</html>
