<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$host = 'localhost';
$dbname = 'moonlight_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Ошибка БД: ' . $e->getMessage()]);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Нет данных']);
    exit;
}

$name = trim($data['name'] ?? '');
$phone = trim($data['phone'] ?? '');
$date = $data['date'] ?? '';
$guests = (int)($data['guests'] ?? 2);
$tableId = (int)($data['table_id'] ?? 0);

if (empty($name)) { echo json_encode(['success' => false, 'message' => 'Введите имя']); exit; }
if (!preg_match('/^\+7\d{10}$/', $phone)) { echo json_encode(['success' => false, 'message' => 'Неверный формат телефона']); exit; }
if (empty($date)) { echo json_encode(['success' => false, 'message' => 'Выберите дату']); exit; }
if ($tableId <= 0) { echo json_encode(['success' => false, 'message' => 'Выберите столик']); exit; }

$stmt = $pdo->prepare("SELECT id FROM bookings WHERE visit_date = ? AND table_id = ?");
$stmt->execute([$date, $tableId]);
if ($stmt->fetch()) {
    echo json_encode(['success' => false, 'message' => 'Столик уже забронирован на эту дату']);
    exit;
}

$stmt = $pdo->prepare("SELECT capacity FROM tables WHERE id = ?");
$stmt->execute([$tableId]);
$table = $stmt->fetch();
if ($table && $guests > $table['capacity']) {
    echo json_encode(['success' => false, 'message' => 'Слишком много гостей (максимум ' . $table['capacity'] . ')']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO bookings (guest_name, phone, visit_date, guests_count, table_id, status) VALUES (?, ?, ?, ?, ?, 'new')");
    $stmt->execute([$name, $phone, $date, $guests, $tableId]);
    
    $stmt = $pdo->prepare("SELECT id FROM guests WHERE phone = ?");
    $stmt->execute([$phone]);
    if ($stmt->fetch()) {
        $stmt = $pdo->prepare("UPDATE guests SET total_visits = total_visits + 1, last_visit = ? WHERE phone = ?");
        $stmt->execute([$date, $phone]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO guests (name, phone, last_visit, total_visits) VALUES (?, ?, ?, 1)");
        $stmt->execute([$name, $phone, $date]);
    }
    
    echo json_encode(['success' => true, 'message' => 'Бронь подтверждена!']);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Ошибка: ' . $e->getMessage()]);
}
?>