<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$host = 'localhost';
$dbname = 'moonlight_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $date = $_GET['date'] ?? date('Y-m-d');
    
    $stmt = $pdo->query("SELECT * FROM tables ORDER BY is_vip, table_number");
    $allTables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $stmt = $pdo->prepare("SELECT table_id FROM bookings WHERE visit_date = ?");
    $stmt->execute([$date]);
    $bookedIds = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    $tables = [];
    foreach ($allTables as $t) {
        $tables[] = [
            'id' => $t['id'],
            'number' => $t['table_number'],
            'name' => $t['name'],
            'capacity' => $t['capacity'],
            'is_vip' => (bool)$t['is_vip'],
            'is_available' => !in_array($t['id'], $bookedIds),
            'description' => $t['description'],
            'features' => $t['features']
        ];
    }
    echo json_encode(['success' => true, 'tables' => $tables, 'date' => $date], JSON_UNESCAPED_UNICODE);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>