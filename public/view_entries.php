<?php
session_start();
require_once '../classes/Auth.php';
require_once '../classes/Database.php';

if (!Auth::isLoggedIn()) {
    header("Location: index.php");
    exit;
}

$title = "Įrašų sąrašas";
$username = $_SESSION['username'];
?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Visi įrašai</h2>

    <?php
    try {
        $db = (new Database())->getConnection();
        $stmt = $db->query("
            SELECT entries.id, entries.description AS text, entries.created_at, entries.ip_address, users.username
            FROM entries
            JOIN users ON entries.user_id = users.id
            ORDER BY entries.created_at DESC
        ");
        $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Klaida gaunant įrašus: " . htmlspecialchars($e->getMessage()) . "</div>";
        $entries = [];
    }
    ?>

    <?php if (count($entries) > 0): ?>
        <div class="list-group">
            <?php foreach ($entries as $entry): ?>
                <div class="list-group-item mb-3">
                    <h5 class="mb-1">Autorius: <?= htmlspecialchars($entry['username']) ?></h5>
                    <p>
                        <?= !empty($entry['text']) ? nl2br(htmlspecialchars($entry['text'])) : "Nėra teksto" ?>
                    </p>
                    <small class="text-muted">
                        Įrašyta: <?= htmlspecialchars($entry['created_at']) ?> |
                        IP: <?= htmlspecialchars($entry['ip_address']) ?>
                    </small>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Nėra jokių įrašų.</p>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
