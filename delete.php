<?php
require_once __DIR__.'/boot.php';

if (isset($_POST['delete']) && !empty($_POST['delete_id'])) {
    $stmt = pdo()->prepare("DELETE FROM `movies` WHERE `id` = :id");
    $stmt->execute(['id' => $_POST['delete_id']]);
    $_SESSION['flash'] = "Deleted.";
    header('location: index.php');
}