<?php
session_start();
include_once 'functions.php';

// 检查用户是否登录
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$allowed_file_types = ['jpg', 'png', 'jpeg', 'gif'];

// 获取InfoID
$infoId = $_GET['id']; // 请确保进行适当的验证和清理

// 从数据库获取所有相关图片
$query = "SELECT * FROM images WHERE InfoID = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $infoId);
$stmt->execute();
$result = $stmt->get_result();

$images = [];
while ($row = $result->fetch_assoc()) {
    $images[] = $row;
}

// 获取文本信息
$query = "SELECT Spell FROM info WHERE InfoID = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $infoId);
$stmt->execute();
$textResult = $stmt->get_result()->fetch_assoc();
$spell = $textResult['Spell'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 获取更新后的文本信息
    $updatedSpell = $_POST['spell'];

    // 更新文本信息
    $updateQuery = "UPDATE info SET Spell = ? WHERE InfoID = ?";
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->bind_param("si", $updatedSpell, $infoId);
    $updateStmt->execute();

    // 遍历已上传的图片，检查是否有新图片替换
// 遍历已上传的图片，检查是否有新图片替换
// 遍历已上传的图片，检查是否有新图片替换
foreach ($images as $image) {
    $imageId = $image['ImageID'];
    if (!empty($_FILES["new_image_$imageId"]['name'])) {
        // 检查文件类型和上传错误
        $imageFileType = strtolower(pathinfo($_FILES["new_image_$imageId"]['name'], PATHINFO_EXTENSION));
        if ($_FILES["new_image_$imageId"]['error'] != UPLOAD_ERR_OK || !in_array($imageFileType, $allowed_file_types)) {
            echo "文件上传错误或类型不符合要求。";
            continue;
        }

        // 创建目标目录
        $target_dir = "uploads/" . date('Y/m/d/') ;
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // 自动生成新文件名并构建目标文件路径
        $new_filename = uniqid() . "." . $imageFileType;
        $target_file = $target_dir . $new_filename;

        // 移动文件到目标目录
        if (move_uploaded_file($_FILES["new_image_$imageId"]['tmp_name'], $target_file)) {
            // 更新数据库记录
            $updateImageQuery = "UPDATE images SET ImageAddr = ? WHERE ImageID = ?";
            $updateImageStmt = $db->prepare($updateImageQuery);
            $updateImageStmt->bind_param("si", $target_file, $imageId);
            $updateImageStmt->execute();
            echo "文件 " . htmlspecialchars(basename($new_filename)) . " 已经上传。<br>";
        } else {
            echo "上传文件时出错。";
        }
    }
}
    // 重定向或显示成功消息
    echo "更新成功！";
        header('Location: guanli-edit.php?id=' . $infoId);
}

$db->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>编辑上传</title>
    <!-- 添加CSS和JavaScript -->
        <link rel="stylesheet" href="style/bootstrap.min.css">
        <style>
    .container {
        max-width: 800px;
        margin: auto;
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .img-thumbnail {
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .btn-primary {
        width: 100%;
        padding: 10px;
    }

    @media (max-width: 576px) {
        .container {
            padding: 10px;
        }
    }
</style>
    <link rel="stylesheet" href="style/guanli.css">
 <script type="text/javascript" src="style/guanli.js"></script>
</head>
<body>    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><?php  echo "欢迎，" .$_SESSION['username']; ?> 登录后台管理系统</a>

 
    <a class="btn btn-info my-2 my-sm-0" href="admin-guanli.php?canshu=wdzy">我的咒语</a>
    <a class="btn btn-warning my-2 my-sm-0" href="admin-guanli.php?canshu=sczy">上传咒语</a>
    <a class="btn btn-danger my-2 my-sm-0" href="logout.php">退出登录</a> 
 
    </nav>
<div class="container mt-5">
    <h1 class="mb-4">编辑上传</h1>
    <form action="guanli-edit.php?id=<?php echo $infoId; ?>" method="post" enctype="multipart/form-data">
        <label for="spell">文字信息:</label>
       <textarea name="spell" class="form-control" rows="4"><?php echo htmlspecialchars($spell); ?></textarea>


        <?php foreach ($images as $image): ?>
            <div>
                <img src="<?php echo htmlspecialchars($image['ImageAddr']); ?>" alt="Image" width="100">
                <input type="file" name="new_image_<?php echo $image['ImageID']; ?>">
            </div>
        <?php endforeach; ?>

    <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
</body>
</html>
