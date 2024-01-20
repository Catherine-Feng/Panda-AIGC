<?php
session_start();
include_once 'functions.php'; // 包含您的数据库连接和功能
// 检查用户是否登录
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);



// 获取评论列表
$content_id = $_GET['content_id']; // 获取传递过来的 content_id
$sql = "SELECT * FROM comments WHERE content_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $content_id);
$stmt->execute();
$result = $stmt->get_result();


// 处理删除操作
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_stmt = $mysqli->prepare("DELETE FROM comments WHERE comment_id = ?");
    $delete_stmt->bind_param("i", $delete_id);
    $delete_stmt->execute();


    // 删除后重定向到没有 delete 参数的页面
    $redirectUrl = "guanli-editpinglun.php?content_id=".$content_id; // 这里替换为实际的列表页面 URL
    header("Location: " . $redirectUrl);


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
 
 
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <!-- 您的其他头部信息 -->
     <link rel="stylesheet" href="style/guanli.css">
 <script type="text/javascript" src="style/guanli.js"></script>

    <meta charset="UTF-8">
    <title>评论管理</title>
    <!-- 添加一些基本的样式 -->
    <script>
function confirmDelete(commentId) {
    var confirmResult = confirm("您确定要删除这条评论吗？");
    if (confirmResult) {
        // 用户确认删除，允许链接的默认行为
      //  window.location.href = '?content_id=<?php echo $content_id; ?>&delete=' + commentId;
        return true;
    } else {
        // 用户取消删除，阻止链接的默认行为
        return false;
    }
}
</script>
<style type="text/css">
 
    .container {
        
        margin-top: 50px;
    }
    .table {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
 
</style>
</head>
<body>    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><?php  echo "欢迎，" .$_SESSION['username']; ?> 登录后台管理系统</a>

 
    <a class="btn btn-info my-2 my-sm-0" href="admin-guanli.php?canshu=wdzy">我的咒语</a>
    <a class="btn btn-warning my-2 my-sm-0" href="admin-guanli.php?canshu=sczy">上传咒语</a>
    <a class="btn btn-danger my-2 my-sm-0" href="logout.php">退出登录</a> 
 
    </nav>
    <div class="container mt-4">
        <h2 class="mb-4">评论管理</h2>
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th>评论 ID</th>
                <th>用户 ID</th>
                <th>评论内容</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['comment_id']; ?></td>
                <td>匿名评论</td>
                <td><?php echo htmlspecialchars($row['comment_text']); ?></td>
                <td>
      

<a href="?content_id=<?php echo $content_id; ?>&delete=<?php echo $row['comment_id']; ?>" 
   onclick="return confirmDelete(<?php echo $row['comment_id']; ?>);" class="btn btn-danger btn-sm">删除</a>


                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
