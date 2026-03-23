<?php

require_once '../config/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    die('Du måste vara inloggad.');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Fel metod.');
}

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    die('Ogiltigt vykorts-id.');
}

$user_id = $_SESSION['user_id'];
$postcard_id = (int) $_POST['id'];

/* Hämta bildvägen först så att filen kan raderas */
$sql = "SELECT image_path
        FROM postcard
        WHERE id = :id AND user_id = :user_id";

$stmt = $dbh->prepare($sql);
$stmt->execute([
    ':id' => $postcard_id,
    ':user_id' => $user_id
]);

$postcard = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$postcard) {
    die('Vykortet finns inte eller tillhör inte dig.');
}

/* Radera databasträffen */
$sql = "DELETE FROM postcard
        WHERE id = :id AND user_id = :user_id";

$stmt = $dbh->prepare($sql);
$stmt->execute([
    ':id' => $postcard_id,
    ':user_id' => $user_id
]);

/* Radera bildfil om den finns */
if (!empty($postcard['image_path']) && file_exists('../../' . $postcard['image_path'])) {
    unlink('../../' . $postcard['image_path']);
}

header('Location: ../../my_page.php');
exit;
