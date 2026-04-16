
<?php
/*如果需要防止解锁码被多次使用，添加一个简单的标记接口：

服务器端 /codes/mark_used.php*/
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$code = $_GET['code'] ?? '';
$bookId = $_GET['book_id'] ?? '';

if (!$code || !$bookId) {
    echo json_encode(['success' => false]);
    exit;
}

$file = '../codes/valid_codes.json';
$data = json_decode(file_get_contents($file), true);

if (isset($data[$bookId][$code])) {
    $data[$bookId][$code]['used'] = true;
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>