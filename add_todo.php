<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = trim($_POST['item']);
    if ($item !== '') {
        $stmt = $pdo->prepare("INSERT INTO todos (user_id, item) VALUES (?, ?)");
        $stmt->execute([$_SESSION['user_id'], $item]);
    }
}

header("Location: dashboard.php");
exit;
