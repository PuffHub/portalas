<?php
session_start();
require_once '../classes/Auth.php';

if (!Auth::isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Įrašyti į duomenų bazę
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $location = $_POST['location'] ?? '';

    if (!empty($title) && !empty($description)) {
        $auth = new Auth();
        $userId = $_SESSION['user_id'];
        $timestamp = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'];

        // Įrašyti į DB
        $sql = "INSERT INTO entries (user_id, title, description, location, timestamp, ip_address) 
                VALUES (:user_id, :title, :description, :location, :timestamp, :ip)";
      $auth = new Auth();
$pdo = $auth->getPdo(); // Gaunam PDO ryšį per metodą

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'user_id' => $userId,
    'title' => $title,
    'description' => $description,
    'location' => $location,
    'timestamp' => $timestamp,
    'ip' => $ip
]);

        $message = "Įrašas buvo sėkmingai sukurtas!";
    } else {
        $message = "Visi laukai turi būti užpildyti!";
    }
}
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Naujas įrašas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Naujas įrašas</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" class="p-4 shadow rounded bg-white">
        <div class="mb-3">
            <label class="form-label">Pavadinimas</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Aprašymas</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Vieta</label>
            <input type="text" name="location" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Įrašyti</button>
    </form>
</div>
</body>
</html>
