<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['create_postcard'])) {
    $user_id = $_SESSION['user_id'];

    $title = trim($_POST['title']);
    $message = trim($_POST['message']);
    $continent = trim($_POST['continent']);
    $country = trim($_POST['country']);
    $city = trim($_POST['city']);

    if (
        empty($title) ||
        empty($message) ||
        empty($continent) ||
        empty($country) ||
        empty($city)
    ) {
        echo '<div class="container mt-3"><div class="alert alert-danger">Alla fält måste fyllas i.</div></div>';
    } elseif (!isset($_FILES['image'])) {
        echo '<div class="container mt-3"><div class="alert alert-danger">Ingen fil skickades.</div></div>';
    } elseif ($_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
        echo '<div class="container mt-3"><div class="alert alert-danger">Du måste välja en bild.</div></div>';
    } elseif ($_FILES['image']['error'] === UPLOAD_ERR_INI_SIZE || $_FILES['image']['error'] === UPLOAD_ERR_FORM_SIZE) {
        echo '<div class="container mt-3"><div class="alert alert-danger">Bilden är för stor.</div></div>';
    } elseif ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        echo '<div class="container mt-3"><div class="alert alert-danger">Fel vid uppladdning. Felkod: ' . $_FILES['image']['error'] . '</div></div>';
    } else {
        $uploadDir = 'uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $sql = "INSERT INTO postcard (user_id, title, message, image_path, continent, country, city, created_at)
                    VALUES (:user_id, :title, :message, :image_path, :continent, :country, :city, NOW())";

            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                ':user_id' => $user_id,
                ':title' => $title,
                ':message' => $message,
                ':image_path' => $targetFile,
                ':continent' => $continent,
                ':country' => $country,
                ':city' => $city
            ]);

            header('Location: feed.asia.php');
            exit;
        } else {
            echo '<div class="container mt-3"><div class="alert alert-danger">Bilden kunde inte laddas upp.</div></div>';
        }
    }
}
