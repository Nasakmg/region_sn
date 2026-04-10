
<?php
$database_url = getenv('DATABASE_URL');
if ($database_url) {
    // Parser l'URL
    $parsed = parse_url($database_url);
    $host = $parsed['host'] ?? 'localhost';
    $port = isset($parsed['port']) ? $parsed['port'] : 5432;
    $dbname = ltrim($parsed['path'] ?? '', '/');
    $user = $parsed['user'] ?? '';
    $password = $parsed['pass'] ?? '';
} else {
    // Environnement local
    $host = 'localhost';
    $port = 5432;
    $dbname = 'render';
    $user = 'postgres';
    $password = 'NASA';
}

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Connexion DB : ' . $e->getMessage()]);
    exit;
}
?>

