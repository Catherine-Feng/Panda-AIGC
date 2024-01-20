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
 


    $target_dir = "uploads/";$allowed_file_types = ['jpg', 'png', 'jpeg', 'gif']; 
    $imageNameVal=array();
    $files_to_upload = ['cover_image', 'additional_image1', 'additional_image2', 'additional_image3'];

 echo $UserID=$_POST['UserID'];
 
    $CategoryID=$_POST['category'];
 
    $Spell=$_POST['spell'];

    // 创建今天日期的新目录，如：uploads/2021/09/30/$target_dir .= date('Y/m/d/');
    $target_dir .= date('Y/m/d/');
    // 检查文件夹是否存在，如果不存在则创建
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    foreach ($files_to_upload as$file) {
        $imageFileType = strtolower(pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION)); 

        if ($_FILES[$file]['error'] != UPLOAD_ERR_OK || !in_array($imageFileType, $allowed_file_types)) {
            // 文件上传出错或文件类型不在允许的列表中
            echo "文件上传错误或类型不符合要求。";
            continue;
        }

        // 自动生成文件的新名称，例如：12345678.jpg$new_filename = uniqid() . "." . $imageFileType;
        $new_filename = uniqid() . "." . $imageFileType;
        // 这是文件要上传的完整路径$target_file = $target_dir .$new_filename;
        $target_file = $target_dir .$new_filename;
        // 打印出新文件名以便调试
        echo 'New filename: ' . $new_filename . '<br>';
        
        // 打印出目标文件的完整路径以便调试
        echo 'Target file: ' .$target_file . '<br>';
        $imageNameVal[]=$target_file ;
        // 使用 move_uploaded_file() 函数将文件移动到目标目录
        if (move_uploaded_file($_FILES[$file]['tmp_name'], $target_file)) {
            echo "文件". htmlspecialchars( basename($new_filename)). "已经上传。";
            
           

        } else {
            echo "上传文件时出错。";
        }
    }


#var_dump( $imageNameVal);

uploadImageAndInfo( $imageNameVal[0],$imageNameVal[1],$imageNameVal[2],$imageNameVal[3],  $UserID, $CategoryID, $Spell) ;
header('Location: admin-guanli.php?canshu=wdzy'); // 请替换为您的列表页面
?>