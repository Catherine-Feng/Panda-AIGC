<?php
session_start();
include_once 'functions.php';

// 检查用户是否登录
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// 获取InfoID
$infoId = $_GET['id']; // 请确保进行适当的验证和清理

if ($infoId) {
    // 执行逻辑删除
    $query = "UPDATE info SET is_deleted = 1 WHERE InfoID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $infoId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "记录已被删除";
    } else {
        echo "删除失败或记录不存在";
    }
} else {
    echo "无效的ID";
}

$db->close();

// 重定向回列表页面或其他页面
header('Location: admin-guanli.php?canshu=wdzy'); // 请替换为您的列表页面
exit();
?>
