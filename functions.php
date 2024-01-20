<?php
require_once 'config.php';
 

function insert_user($username,$password, $email) {



 
$con = mysqli_connect(   DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

    if (!$con) {
        die('Could not connect: ' . mysqli_connect_error());
    }$sql = "INSERT INTO users (UserName, Password, Email) VALUES ('$username', '$password', '$email')";

    if (!mysqli_query($con,$sql)) {
        die('Error: ' . mysqli_error($con));
    }

    

    echo '<script type="text/javascript">';
    echo 'alert("'.$username.'注册成功，请去登录！");';
    echo 'window.location.href = "login.html";';
    echo '</script>';


 
    
    mysqli_close($con);





}







function select_categories() {
$conn = mysqli_connect(   DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
 
$sql = "SELECT CategoryID, Name  FROM categories";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
   
         $output[] = "<option value='".$row["CategoryID"]."'>".$row["Name"]."</option>";
    }
} else {
  #  echo "0 结果";
}
$conn->close();
   return $output;
}



function uploadImageAndInfo($CoverImageAddr, $AdditionalImageAddr1,$AdditionalImageAddr2, $AdditionalImageAddr3,   $UserID, $CategoryID, $Spell) {
    // 数据库连接$db = mysqli_connect('localhost', 'username', 'password', 'dbname');
    $db = mysqli_connect(   DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$db){
        die("Database Connection Failed" . mysqli_error($db));
    }

    // 插入 Info 表数据
  echo  $sql = "INSERT INTO Info ( Spell, UserID, CategoryID) VALUES ('$Spell', '$UserID','$CategoryID')";
    if (!mysqli_query($db,$sql)) {
        die('Error: ' . mysqli_error($db));
    }

    // 获取插入的 InfoID$InfoID = mysqli_insert_id($db);
    $InfoID = mysqli_insert_id($db);
    // 插入封面图片到 images 表
  echo  $sql = "INSERT INTO images (ImageAddr, InfoID, Type) VALUES ( '$CoverImageAddr', '$InfoID','1')";
    if (!mysqli_query($db,$sql)) {
        die('Error: ' . mysqli_error($db));
    }

    // 插入其他三个附加图片到 images 表
 
     echo   $sql = "INSERT INTO images (ImageAddr, InfoID, Type) VALUES ( '$AdditionalImageAddr1' , '$InfoID','2' )";
        if (!mysqli_query($db,$sql)) {
            die('Error: ' . mysqli_error($db));
        }
 
 
     echo   $sql = "INSERT INTO images (ImageAddr, InfoID, Type) VALUES ( '$AdditionalImageAddr2' , '$InfoID','2' )";
        if (!mysqli_query($db,$sql)) {
            die('Error: ' . mysqli_error($db));
        }
 
 
     echo   $sql = "INSERT INTO images (ImageAddr, InfoID, Type) VALUES ( '$AdditionalImageAddr3' , '$InfoID','2' )";
        if (!mysqli_query($db,$sql)) {
            die('Error: ' . mysqli_error($db));
        }
 

    mysqli_close($db);
}