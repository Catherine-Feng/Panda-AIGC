<?php
include_once 'functions.php';

// 连接数据库
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$content_id = $_GET['content_id']; // 获取内容 ID

// 生成一个唯一的标识符，用于标记点赞状态
$like_identifier = 'liked_' . $content_id;

// 检查 Cookie 是否已设置，即用户是否已经点过赞
if (!isset($_COOKIE[$like_identifier])) {
    // 更新数据库中的点赞计数
    $updateSql = "UPDATE Info SET likes_count = likes_count + 1 WHERE InfoID = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("i", $content_id);
    $updateStmt->execute();

    // 设置一个 Cookie 来标记已点赞
    setcookie($like_identifier, 'true', time() + (86400 * 30), "/"); // 有效期30天

    // 获取并返回新的点赞计数
    $countSql = "SELECT likes_count FROM Info WHERE InfoID = ?";
    $countStmt = $conn->prepare($countSql);
    $countStmt->bind_param("i", $content_id);
    $countStmt->execute();
    $countResult = $countStmt->get_result()->fetch_assoc();
    echo $countResult['likes_count'];
} else {
    echo "您已经点过赞了";
}

$conn->close();
?>
