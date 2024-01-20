<?php
session_start(); // 开始session，在删除之前需要开始session
session_destroy(); // 删除所有的session变量
header("Location: login.html"); // 重定向到登录页
exit();
?>