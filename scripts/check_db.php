<?php
require __DIR__ . '/../vendor/autoload.php';

// Load environment variables if vlucas/phpdotenv is available
if (class_exists(\Dotenv\Dotenv::class)) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->safeLoad();
}

$host = getenv('DB_HOST') ?: '127.0.0.1';
$port = getenv('DB_PORT') ?: '3306';
$db   = getenv('DB_DATABASE') ?: '';
$user = getenv('DB_USERNAME') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: '';

echo "Connecting to MySQL at $host:$port, database '$db' as user '$user'\n";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $stmt = $pdo->query("SHOW VARIABLES LIKE 'datadir'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Result:\n";
    print_r($result);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}

// Also list tables quickly
try {
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_NUM);
    echo "\nTables in $db:\n";
    foreach ($tables as $t) {
        echo " - " . $t[0] . "\n";
    }
} catch (Exception $e) {
    echo "Could not list tables: " . $e->getMessage() . "\n";
}

return 0;
