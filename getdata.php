<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

$host = 'nozomi.proxy.rlwy.net';
$db = 'railway';
$user = 'postgres';
$pass ='ndvHNRMKNruHvUwqZzGRlaiCMdGwcEds';
$port ='20866';
$dsn ="pgsql:host=$host;port=$port;dbname=$db;";

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $pdo->query("SELECT * FROM product");
    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($product);
    } catch (PDOException $e){
        echo json_encode(['VOI NYT-' => $e->getMessage()]);
    }

?>
