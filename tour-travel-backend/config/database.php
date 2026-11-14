<?php
$host=getenv('DB_HOST')?:'127.0.0.1';$name=getenv('DB_NAME')?:'tour_travel_db';$user=getenv('DB_USER')?:'root';$pass=getenv('DB_PASS')?:'';
try{$pdo=new PDO("mysql:host=$host;dbname=$name;charset=utf8mb4",$user,$pass,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES=>false]);}catch(PDOException $e){http_response_code(500);header('Content-Type: application/json');echo json_encode(['message'=>'Database connection failed. Check backend/config/database.php']);exit;}
