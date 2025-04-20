<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['todo_id'])) {
    $todo_id = $_POST['todo_id'];
    $user_id = $_SESSION['user_id'];

    // Only delete the to-do if it belongs to the logged-in user
    $stmt = $pdo->prepare("DELETE FROM todos WHERE id = ? AND user_id = ?");
    $stmt->execute([$todo_id, $user_id]);
}

header("Location: dashboard.php");
exit;