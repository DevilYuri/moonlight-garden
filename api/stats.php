<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$host = 'localhost';
$dbname = 'moonlight_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM bookings");
    $totalBookings = $stmt->fetch()['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM guests");
    $totalGuests = $stmt->fetch()['total'];
    
    $today = date('Y-m-d');
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM bookings WHERE visit_date = ?");
    $stmt->execute([$today]);
    $todayBookings = $stmt->fetch()['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM tables");
    $totalTables = $stmt->fetch()['total'];
    
    echo json_encode(['success' => true, 'total_bookings' => $totalBookings, 'total_guests' => $totalGuests, 'today_bookings' => $todayBookings, 'total_tables' => $totalTables]);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>