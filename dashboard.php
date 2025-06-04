<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM tickets ORDER BY date_event ASC");
$tickets = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard – Billets JO</title>
    <link rel="stylesheet" href="css/style_jo_bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center mb-4">Tableau de Bord des Billets</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <span>Bienvenue <strong><?= $_SESSION['username'] ?></strong></span>
        </div>
        <div>
            <a href="add_ticket.php" class="btn btn-success btn-sm">➕ Ajouter un billet</a>
            <a href="logout.php" class="btn btn-danger btn-sm">Se déconnecter</a>
        </div>
    </div>

    <?php if (empty($tickets)): ?>
        <div class="alert alert-info">Aucun billet enregistré pour le moment.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Événement</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td><?= htmlspecialchars($ticket['nom']) ?></td>
                        <td><?= htmlspecialchars($ticket['prenom']) ?></td>
                        <td><?= htmlspecialchars($ticket['email']) ?></td>
                        <td><?= htmlspecialchars($ticket['evenement']) ?></td>
                        <td><?= htmlspecialchars($ticket['date_event']) ?></td>
                        <td>
                            <span class="badge bg-primary"><?= htmlspecialchars($ticket['type_billet']) ?></span>
                        </td>
                        <td>
                            <a href="edit_ticket.php?id=<?= $ticket['id_ticket'] ?>" class="btn btn-warning btn-sm">✏️</a>
                            <a href="delete_ticket.php?id=<?= $ticket['id_ticket'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce billet ?')">🗑️</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
