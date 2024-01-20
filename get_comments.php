<?php
include_once 'functions.php';

// 连接数据库
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$content_id = $_GET['content_id']; // 获取内容的 ID

$sql = "SELECT comment_text, created_at FROM comments WHERE content_id = ? ORDER BY created_at DESC LIMIT 3";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $content_id);
$stmt->execute();
$result = $stmt->get_result();

$comments = [];
while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
}

echo json_encode($comments);

$conn->close();
?>
