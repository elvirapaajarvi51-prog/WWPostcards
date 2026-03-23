<?php
// Defines information for database connection
define('DB_HOST', 'localhost');
define('DB_NAME', 'WWPostcards');
define('DB_USER', 'root');
define('DB_PASS', 'root');
// Connects to database
try {
    $dbh = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_FOUND_ROWS => true
        )
    );
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
