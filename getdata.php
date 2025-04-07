<?php
$host = 'nozomi.proxy.rlwy.net';
$db = 'railway';
$user = 'postgres';
$pass ='ndvHNRMKNruHvUwqZzGRlaiCMdGwcEds';
$port ='20866';
$dsn ="pgsql:host=$host;port=$port;dbname=$db;";

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $stmt = $pdo->query("SELECT * FROM product");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo $row['id'] . "<br>";
    }

    echo "Toimii ig";
    } catch (PDOException $e){
        echo "No vittu >:(" . $e->getMessage();
    }

?>