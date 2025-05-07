<?php
session_start();
require_once '../classes/Auth.php';

if (!Auth::isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new Auth();
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Patikrinti, ar naujas slaptažodis sutampa su patvirtinimu
    if ($newPassword !== $confirmPassword) {
        $message = "Slaptažodžiai nesutampa.";
    } else {
        // Pakeisti slaptažodį
        if ($auth->changePassword($_SESSION['username'], $currentPassword, $newPassword)) {
            $message = "Slaptažodis buvo pakeistas!";
        } else {
            $message = "Neteisingas dabartinis slaptažodis.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Slaptažodžio pakeitimas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Slaptažodžio pakeitimas</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" class="p-4 shadow rounded bg-white">
        <div class="mb-3">
            <label class="form-label">Dabartinis slaptažodis</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Naujas slaptažodis</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Patvirtinkite slaptažodį</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Pakeisti slaptažodį</button>
    </form>
</div>
</body>
</html>
