<?php
session_start();
require_once 'includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM tickets WHERE id_ticket = ?");
    $stmt->execute([$id]);
}

header("Location: dashboard.php");
exit;
