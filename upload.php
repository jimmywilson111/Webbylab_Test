<?php

require_once __DIR__.'/boot.php';

if (isset($_FILES['file_input']) && $_FILES['file_input']['error'] === UPLOAD_ERR_OK) {
    $content = file($_FILES['file_input']['tmp_name'], FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
    $sliced_array = array_chunk($content, 4);
    $data = [];
    foreach ($sliced_array as $item) {
        foreach ($item as $line) {
            $explosion = explode(":", $line);
            $key = strtolower($explosion[0]);
            $value = ltrim($explosion[1]);
            $data[$key] = $value;
        }

        $stmt = pdo()->prepare("INSERT INTO `movies` (`title`, `year`, `format`, `stars`) VALUES (:title, :year, :format, :stars)");
        $stmt->execute([
            'title' => $data['title'],
            'year' => $data['release year'],
            'format' => $data['format'],
            'stars' => serialize($data['stars']),
        ]);
    }
    $_SESSION['flash'] = "Info from file uploaded successful.";
    header('location: index.php');
}

