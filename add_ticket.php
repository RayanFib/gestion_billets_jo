<?php
session_start();
require_once 'includes/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $evenement = $_POST['evenement'];
    $date = $_POST['date_event'];
    $type = $_POST['type_billet'];

    $stmt = $pdo->prepare("INSERT INTO tickets (nom, prenom, email, evenement, date_event, type_billet) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$nom, $prenom, $email, $evenement, $date, $type])) {
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "Une erreur est survenue.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un billet – JO 2024</title>
    <link rel="stylesheet" href="css/style_jo_bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-warning mb-4">📝 Ajouter un billet</h2>

    <?php if ($message): ?>
        <div class="alert alert-danger"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST" action="" class="bg-dark p-4 rounded shadow-lg text-light">
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Événement</label>
            <input type="text" name="evenement" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date_event" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Type de billet</label>
            <select name="type_billet" class="form-select" required>
                <option value="standard">Standard</option>
                <option value="vip">VIP</option>
                <option value="enfant">Enfant</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="dashboard.php" class="btn btn-secondary">⬅️ Retour</a>
            <button type="submit" class="btn btn-success">Ajouter le billet</button>
        </div>
    </form>
</div>
</body>
</html>
