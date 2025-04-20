<?php
$host = 'localhost';
$db   = 'todo_app';
$user = 'todo_user';
$pass = 'secret123'; // Use your actual password here
$port = 3308;  // The new MySQL port you are using

try {
    // Specify the port in the DSN (Data Source Name)
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Connected successfully!";
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}
?>