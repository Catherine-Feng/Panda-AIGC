<?php
 
include_once 'functions.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['uname'];$password = $_POST['psw'];$email = $_POST['email']; 
}

$sql = "SELECT * FROM Users WHERE UserName = '$username'"; 
$conn = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$result =$conn->query($sql);

if ($result->num_rows > 0) {
    while($row =$result->fetch_assoc()) {
      # if (password_verify($password,$row['Password'])) {
         if ($row['Password']==$password) {
            session_start();
            $_SESSION['username'] =$username;
            $_SESSION['UserID'] =$row['UserID'];
           # echo '登录成功！欢迎 ' . $username;
            header("Location: admin-guanli.php?canshu=wdzy");   
        } else {
            echo '登录失败！密码错误。';
        }
    }
} else {
    echo "登录失败！用户名不存在。";
}$conn->close();
?>