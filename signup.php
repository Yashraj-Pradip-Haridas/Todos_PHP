<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        echo "User already exists.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->execute([$email, $password]);
        echo "Signup successful! <a href='index.php'>Login</a>";
    }
}
?>

<!-- Inside index.php and signup.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Login / Signup</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="container py-5">

    <h2 class="mb-4">Signup</h2>
    <form
        method="post"
        class="card p-4"
    >
        <label>Email:</label>
        <input
            type="email"
            name="email"
            class="form-control mb-3"
            required
        >

        <label>Password:</label>
        <input
            type="password"
            name="password"
            class="form-control mb-3"
            required
        >

        <input
            type="submit"
            value="Login"
            class="btn btn-primary"
        >
    </form>

    <a
        href="signup.php"
        class="d-block mt-3"
    >Don't have an account? Signup</a>

</body>

</html>