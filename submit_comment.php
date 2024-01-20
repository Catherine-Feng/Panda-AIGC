<?php
include_once 'functions.php';

// 连接数据库
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$content_id = $_POST['content_id']; // 获取内容的 ID
$comment = $_POST['comment']; // 获取评论文本

// 插入评论到数据库

$sql = "INSERT INTO comments (content_id, user_id, comment_text) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $content_id, $user_id, $comment);


 
$stmt->execute();

if ($stmt->error) {
    echo "Error: " . $stmt->error;
} else {
    echo "评论成功添加";
}

$conn->close();

 



 
?>
