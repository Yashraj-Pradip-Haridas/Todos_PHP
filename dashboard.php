<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM todos WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$todos = $stmt->fetchAll();
?>

<h2>Welcome, <?= htmlspecialchars($_SESSION['email']) ?></h2>
<a href="logout.php">Logout</a>

<h3>Your To-Do List</h3>
<ul>
    <?php foreach ($todos as $todo): ?>
        <li><?= htmlspecialchars($todo['item']) ?></li>
    <?php endforeach; ?>
</ul>

<form method="post" action="add_todo.php">
    <input type="text" name="item" required>
    <input type="submit" value="Add">
</form>
