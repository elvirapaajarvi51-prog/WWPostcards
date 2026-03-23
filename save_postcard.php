<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $message = trim($_POST['message']);
    $continent = trim($_POST['continent']);
    $country = trim($_POST['country']);
    $city = trim($_POST['city']);

    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {
        die('Fel vid bilduppladdning.');
    }

    $uploadDir = 'uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $imageName = time() . '_' . basename($_FILES['image']['name']);
    $targetFile = $uploadDir . $imageName;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        die('Kunde inte spara bilden.');
    }

    $stmt = $dbh->prepare("
        INSERT INTO postcard (title, message, image_path, continent, country, city)
        VALUES (:title, :message, :image_path, :continent, :country, :city)
    ");

    $stmt->execute([
        'title' => $title,
        'message' => $message,
        'image_path' => $targetFile,
        'continent' => $continent,
        'country' => $country,
        'city' => $city
    ]);

    header('Location: feed.php');
    exit;
}
