<?php
session_start(); // 开启回话
include_once 'functions.php';
if (isset($_SESSION['username'])) {
    // 如果用户已经登录，那我们就显示后台页面内容
  #  echo "欢迎，" .$_SESSION['username']; 
    // 这里可以放你后台页面的主要代码

} else {
    // 如果用户没有登录，我们就重定向到登录页面
    header("Location: login.html");   // "login.php" 应为你的登录页面路径
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
 
    <title>后台管理系统</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/guanli.css">
 <script type="text/javascript" src="style/guanli.js"></script>

</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><?php  echo "欢迎，" .$_SESSION['username']; ?> 登录后台管理系统</a>

 
    <a class="btn btn-info my-2 my-sm-0" href="admin-guanli.php?canshu=wdzy">我的咒语</a>
    <a class="btn btn-warning my-2 my-sm-0" href="admin-guanli.php?canshu=sczy">上传咒语</a>
    <a class="btn btn-danger my-2 my-sm-0" href="logout.php">退出登录</a> 
 
    </nav>

    <div class="container-fluid">
        <div class="row"  >
     

          <main role="main" class="col-12 mx-auto px-4">
               <!-- 主要内容将在这里展示 -->
               <?php 
               if ($_GET['canshu'] =='sczy'){



                $categories = select_categories();
                $fenlei= implode('',$categories);


echo ' 
  <div class="container mt-5">
         <h2 class="mb-4">上传图片</h2>
        <form action="upload_process.php" method="post" enctype="multipart/form-data"  onsubmit="return validateForm()">
            <div class="form-group">
                <label for="cover_image">封面图</label>
                <input type="file" class="form-control" name="cover_image" id="cover_image" accept="image/*">
            </div>
            <div class="form-group">
                <label for="additional_image1">附加图1</label>
                <input type="file" class="form-control" name="additional_image1" id="additional_image1" accept="image/*">
            </div>
            <div class="form-group">
                <label for="additional_image2">附加图2</label>
                <input type="file" class="form-control" name="additional_image2" id="additional_image2" accept="image/*">
            </div>
            <div class="form-group">
                <label for="additional_image3">附加图3</label>
                <input type="file" class="form-control" name="additional_image3" id="additional_image3" accept="image/*">
            </div>
            <div class="form-group">
                <label for="spell">咒语</label>
                <textarea class="form-control" name="spell" id="spell"></textarea>
            </div>
            <div class="form-group">
                <label for="category">分类</label>
                <select class="form-control" name="category" id="category">
                   
                    '.$fenlei.'
                    
                </select>
            </div>
             <input type="hidden" name="UserID" id="UserID" value="'. $_SESSION['UserID'].'">
            <button type="submit" class="btn btn-primary" name="submit">上传</button>
        </form>
    </div>';}elseif ($_GET['canshu'] =='wdzy'){echo '  ';

?>

    <div class="container mt-4">
        <h2 class="mb-4">上传管理</h2>
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th>图片</th>
                <th>文字信息</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $db = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
// 查询数据库，获取用户上传的图片和信息

//超级管理员模式
    if(SUPER_ADMIN_USERNAME== $_SESSION['username']  and  SUPER_ADMIN_ENABLED==true){
$stmt = $db->prepare('SELECT Info.Spell, Info.InfoID, images.ImageAddr FROM Info INNER JOIN images ON Info.InfoID = images.InfoID WHERE Info.is_deleted=0 and   images.Type = 1 ORDER BY `info`.`InfoID` DESC');

    }else{
$stmt = $db->prepare('SELECT Info.Spell, Info.InfoID, images.ImageAddr FROM Info INNER JOIN images ON Info.InfoID = images.InfoID WHERE Info.is_deleted=0 and Info.UserID = ? AND images.Type = 1 ORDER BY `info`.`InfoID` DESC');$stmt->bind_param("i", $_SESSION['UserID']);
}

$stmt->execute();
$result = $stmt->get_result();


           while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td><a href='detail-page.php?infoid=".$row['InfoID']."'   target='_blank'  ><img src='" . htmlspecialchars($row['ImageAddr']) . "' alt='图片' width='100'></a></td>";
                echo "<td>" . htmlspecialchars($row['Spell']) . "</td>";
                echo "<td>
                        <a  class=\"btn btn-success btn-block\" href='guanli-edit.php?id=" . $row['InfoID'] . "'>编辑图片</a>  
                        <a  class=\"btn btn-primary btn-block \" href='guanli-editpinglun.php?content_id=" . $row['InfoID'] . "'>管理评论</a> 
                        <a  class=\"btn btn-danger btn-block\" onclick='return confirmDelete();'  href='guanli-delete.php?id=" . $row['InfoID'] . "'  >删除图片</a> 
 

                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php



$db->close();


}



 ?>


           </main>

        </div>
   </div>
</body>
</html>