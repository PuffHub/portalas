<?php
require_once '../classes/User.php';
require_once '../classes/PasswordGenerator.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();

    // Gauname duomenis
    $username   = $_POST['username'] ?? '';
    $firstName  = $_POST['first_name'] ?? '';
    $lastName   = $_POST['last_name'] ?? '';
    $email      = $_POST['email'] ?? '';
    $password   = $_POST['password'] ?? '';

    // Registruojam vartotoją
    $result = $user->register($username, $firstName, $lastName, $email, $password);

    if ($result === true) {
        $message = "Registracija sėkminga! Galite prisijungti.";
    } else {
        $message = $result; // Klaida iš User klasės
    }
}

// Generuojam slaptažodį (jei paprašyta)
$generatedPassword = '';
if (isset($_POST['generate_password'])) {
    $generatedPassword = PasswordGenerator::generate();
}
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Vartotojo registracija</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" class="p-4 shadow rounded bg-white">

        <div class="mb-3">
            <label class="form-label">Vartotojo vardas</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Vardas</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pavardė</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">El. paštas</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Slaptažodis</label>
            <input type="text" name="password" class="form-control" value="<?= htmlspecialchars($generatedPassword) ?>" required>
        </div>

        <div class="mb-3 d-flex gap-2">
            <button type="submit" name="generate_password" class="btn btn-warning">Generuoti slaptažodį</button>
            <button type="submit" class="btn btn-primary">Registruotis</button>
        </div>
    </form>
</div>
</body>
</html>
