<?php
include_once 'functions.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['uname'];$password = $_POST['psw'];$email = $_POST['email']; 
        insert_user($username, $password,$email);
  
}