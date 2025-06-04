<?php
session_start();
require_once 'includes/db.php';

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$message = "";

// Récupération du billet
$stmt = $pdo->prepare("SELECT * FROM tickets WHERE id_ticket = ?");
$stmt->execute([$id]);
$ticket = $stmt->fetch();

if (!$ticket) {
    $message = "❌ Billet introuvable.";
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $evenement = $_POST['evenement'];
    $date = $_POST['date_event'];
    $type = $_POST['type_billet'];

    $stmt = $pdo->prepare("UPDATE tickets SET nom=?, prenom=?, email=?, evenement=?, date_event=?, type_billet=? WHERE id_ticket=?");
    if ($stmt->execute([$nom, $prenom, $email, $evenement, $date, $type, $id])) {
        header("Location: dashboard.php");
        exit;
    } else {
        $message = "❌ Erreur lors de la modification.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un billet – JO 2024</title>
    <link rel="stylesheet" href="css/style_jo_bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-warning mb-4">✏️ Modifier un billet</h2>

    <?php if ($message): ?><div class="alert alert-danger"><?= $message ?></div><?php endif; ?>

    <form method="POST" class="bg-dark p-4 rounded shadow-lg text-light">
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" value="<?= htmlspecialchars($ticket['nom']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom" value="<?= htmlspecialchars($ticket['prenom']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($ticket['email']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Événement</label>
            <input type="text" name="evenement" value="<?= htmlspecialchars($ticket['evenement']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date_event" value="<?= $ticket['date_event'] ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Type de billet</label>
            <select name="type_billet" class="form-select" required>
                <option value="standard" <?= $ticket['type_billet'] === 'standard' ? 'selected' : '' ?>>Standard</option>
                <option value="vip" <?= $ticket['type_billet'] === 'vip' ? 'selected' : '' ?>>VIP</option>
                <option value="enfant" <?= $ticket['type_billet'] === 'enfant' ? 'selected' : '' ?>>Enfant</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="dashboard.php" class="btn btn-secondary">⬅️ Retour</a>
            <button type="submit" class="btn btn-warning">Mettre à jour</button>
        </div>
    </form>
</div>
</body>
</html>
