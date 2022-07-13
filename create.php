<?php
require_once __DIR__.'/boot.php';

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $year = $_POST['year'];
    $format = $_POST['format'];
    $actors = explode (",", $_POST['stars']);

    $stmt = pdo()->prepare("INSERT INTO `movies` (`title`, `year`, `format`, `stars`) VALUES (:title, :year, :format, :stars)");
    $stmt->execute([
        'title' => $_POST['title'],
        'year' => $_POST['year'],
        'format' => $_POST['format'],
        'stars' => serialize($_POST['stars']),
    ]);
    $_SESSION['flash'] = "New item created successful.";
    header('location: index.php');
}