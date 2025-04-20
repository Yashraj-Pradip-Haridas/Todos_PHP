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

<h2>Signup</h2>
<form method="post">
    Email: <input
        type="email"
        name="email"
        required
    ><br>
    Password: <input
        type="password"
        name="password"
        required
    ><br>
    <input
        type="submit"
        value="Signup"
    >
</form>