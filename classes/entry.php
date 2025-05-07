<?php
session_start();
require_once '../classes/Auth.php';

if (!Auth::isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$auth = new Auth();
$userId = $_SESSION['user_id'];

// Gauti visus įrašus
$sql = "SELECT * FROM entries WHERE user_id = :user_id ORDER BY timestamp DESC";
$stmt = $auth->pdo->prepare($sql);
$stmt->execute(['user_id' => $userId]);
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Įrašų peržiūra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Jūsų įrašai</h2>

    <?php if (empty($entries)): ?>
        <p>Neturite jokių įrašų.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pavadinimas</th>
                    <th>Aprašymas</th>
                    <th>Vieta</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entries as $entry): ?>
                    <tr>
                        <td><?= htmlspecialchars($entry['title']) ?></td>
                        <td><?= htmlspecialchars($entry['description']) ?></td>
                        <td><?= htmlspecialchars($entry['location']) ?></td>
                        <td><?= htmlspecialchars($entry['timestamp']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
