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

<!DOCTYPE html>
<html>

<head>
    <title>To-Do Dashboard</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <!-- Add inside <head> -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="container py-4">

    <h2 class="mb-4">Welcome, <?= htmlspecialchars($_SESSION['email']) ?></h2>
    <a
        href="logout.php"
        class="btn btn-outline-secondary mb-3"
    >Logout</a>

    <div class="card p-3 mb-4">
        <h4>Add New To-Do</h4>
        <form
            method="post"
            action="add_todo.php"
            class="d-flex gap-2"
        >
            <input
                type="text"
                name="item"
                class="form-control"
                placeholder="Your task..."
                required
            >
            <button
                type="submit"
                class="btn btn-primary"
            >Add</button>
        </form>
    </div>

    <div class="card p-3">
        <h4>Your To-Do List</h4>
        <ul class="list-group mt-3">
            <?php foreach ($todos as $todo): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= htmlspecialchars($todo['item']) ?>
                <form
                    method="post"
                    action="delete_todo.php"
                    class="m-0"
                >
                    <input
                        type="hidden"
                        name="todo_id"
                        value="<?= $todo['id'] ?>"
                    >
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

</body>

</html>