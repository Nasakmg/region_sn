 */
<?php
/*
// Connexion locale (à modifier selon vos paramètres)
$host = 'localhost';
$port = '5432';
$dbname = 'render';      // nom de votre base locale
$user = 'postgres';
$password = 'NASA';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
    */


$database_url = getenv('DATABASE_URL');
if ($database_url) {
    // ---- Sur Render (production) ----
    $parsed = parse_url($database_url);
    $host = $parsed['host'];
    $port = $parsed['port'];
    $dbname = ltrim($parsed['path'], '/');
    $user = $parsed['user'];
    $password = $parsed['pass'];
} else {
    // ---- En local (XAMPP) ----
    $host = 'localhost';
    $port = '5432';
    $dbname = 'render';   // nom de votre base locale
    $user = 'postgres';
    $password = 'NASA';
}

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
