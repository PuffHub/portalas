<?php
session_start();
require_once '../classes/Auth.php';

if (!Auth::isLoggedIn()) {
    header("Location: includes/index.php");
    exit;
}

$username = $_SESSION['username'];
$title = "Valdymo panelė";
?>


<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Sveiki, <?= htmlspecialchars($username) ?>!</h2>
        <a href="logout.php" class="btn btn-danger">Atsijungti</a>
    </div>

    <div class="card p-4 shadow-sm">
        <h4>Veiksmai:</h4>
        <ul>
            <li><a href="change_password.php">Pakeisti slaptažodį</a></li>
            <li><a href="create_entry.php">Naujas įrašas</a></li>
            <li><a href="view_entries.php">Peržiūrėti visus įrašus</a></li>
        </ul>
    </div>
</div>
<?php
include '../includes/footer.php'; ?>