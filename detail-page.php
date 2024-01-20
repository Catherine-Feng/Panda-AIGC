<?php
include_once 'functions.php';
    // Get infoid from URL
    $infoid =$_GET['infoid'];

    // Database connection
    $conn = new mysqli(   DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

    // Check connection
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from database
 

// 预处理语句 获取对应的图片信息进行展示放到数组里
$stmt = $conn->prepare("SELECT Info.Spell, Images.ImageAddr, Images.Type FROM Info INNER JOIN Images ON Info.InfoID = Images.InfoID WHERE Info.InfoID = ?");
$stmt->bind_param("i", $infoid); // "i" 表示参数是整数
$stmt->execute();
$result = $stmt->get_result();


    // Check if data exists
    if($result->num_rows > 0) {
        // Initialize an empty array to hold all rows
        $data = array();

        // Fetch all rows from result set
        while ($row = $result->fetch_assoc()) {$data[] = $row;
        }
    } else {
        echo "No data found";
    }$conn->close();




 //点赞数量信息展示
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$content_id = $infoid; // 获取内容 ID
$sql = "SELECT likes_count FROM Info WHERE InfoID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $content_id);
$stmt->execute();
$result = $stmt->get_result();

$likes_count = 0;
if ($row = $result->fetch_assoc()) {
    $likes_count = $row['likes_count'];
}

$conn->close();
 
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Detail Page</title>
<style>
 
    #comments {
        margin-top: 20px;
    }
    .comment {
        background-color: #f4f4f4;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }
    .comment-text {
        margin: 0 0 10px 0;
    }
    .comment-date {
        margin: 0;
        font-size: 0.8em;
        color: #666;
        float: right;
    }
 

    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background: #f4f4f4;
        color: #333;
    }
    .container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .detail-img1 {
        max-width: 100%;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    .detail-img2 {
        max-width: 27%;
        margin: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    .detail-info {
        padding: 20px;
        list-style: none;
        width: 100%;
    }
    .detail-info li {
        margin-bottom: 10px;
        font-size: 1.2em;
    }
    .title {
        font-weight: bold;
        color: #444;
    }


      .additional-images {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        margin: 20px 0;
    }

    .detail-img2 {
        flex: 0 0 calc(33.333% - 20px); /* 分配空间，减去间距 */
        margin: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }


</style>
<style>
    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .like-section {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    .like-button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-right: 10px;
    }
    .like-button:hover {
        background-color: #45a049;
    }
    #like-count {
        font-size: 18px;
    }
    .comment-section {
        margin-top: 20px;
        width:100%;
    }
    #comments {
        margin-bottom: 20px;
        border-top: 1px solid #ddd;
        padding-top: 10px;
    }
    #comment-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    .submit-button {
        background-color: #008CBA;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
    .submit-button:hover {
        background-color: #007B9A;
    }
</style>
<script>// 页面加载完成后执行以下代码 点赞功能: 当用户点击点赞按钮时，脚本会发送一个请求到服务器（like_script.php），请求中包含了内容的ID。服务器响应点赞的结果，如果成功，页面上的点赞计数会更新。


document.addEventListener('DOMContentLoaded', function() {

    // 为点赞按钮添加点击事件监听器
    document.getElementById('like-button').addEventListener('click', function() {
        var contentId = this.getAttribute('data-content-id'); // 获取内容的 ID

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'like_script.php?content_id=' + contentId, true); // 发送请求到 like_script.php，并传递内容ID
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) { // 当请求完成且响应状态码为200时
                var response = xhr.responseText;
                if (response !== '您已经点过赞了') { // 如果响应不是“已点过赞”的消息
                    document.getElementById('like-count').innerText = response; // 更新点赞计数
                } else {
                    alert(response); // 显示“已点过赞”的消息
                }
            }
        }
        xhr.send(); // 发送请求
    });

    var contentId = <?php echo $infoid;?>; // 从PHP变量获取内容的ID  

    // 使用 fetch API 获取评论 加载评论: 在页面加载时，脚本会从get_comments.php获取指定内容ID的评论，并将它们展示在页面上。评论数据是以JSON格式从服务器获取的。
    fetch('get_comments.php?content_id=' + contentId)
        .then(response => response.json()) // 解析响应为JSON
        .then(comments => {
            var commentsContainer = document.getElementById('comments'); // 获取评论容器元素
            commentsContainer.innerHTML = ''; // 清空现有评论

            comments.forEach(function(comment) { // 遍历每个评论
                var commentDiv = document.createElement('div'); // 创建新的div元素用于展示评论
                commentDiv.className = 'comment'; // 设置类名
                // 设置评论内容和日期
                commentDiv.innerHTML = '<p class="comment-text">' + comment.comment_text +
                                       '</p><p class="comment-date">' + comment.created_at + '</p>';
                commentsContainer.appendChild(commentDiv); // 将评论添加到容器中
            });
        })
        .catch(error => console.error('Error:', error)); // 处理请求错误
});

 



//这个函数首先发送一个 HTTP 请求到 get_comments.php，携带内容ID (contentId)。服务器响应此请求，并返回相关评论的数据。函数接着解析这些数据，并动态地更新页面上的评论区域。通过清空现有的评论容器并基于最新数据添加新的评论元素，该函数确保页面上始终显示最新的评论信息。如果在请求或处理过程中遇到任何错误，它们会被捕获并记录到控制台。这有助于调试和维护。
// fetchLatestComments 函数用于从服务器异步获取指定内容ID的评论，并将它们显示在页面上
function fetchLatestComments(contentId) {
    // 使用 fetch API 向 'get_comments.php' 发送请求，携带内容ID作为查询参数
    fetch('get_comments.php?content_id=' + contentId)
        .then(response => response.json()) // 将响应体转换为 JSON 格式
        .then(comments => {
            // 获取页面中用于展示评论的容器元素
            var commentsContainer = document.getElementById('comments');
            commentsContainer.innerHTML = ''; // 清空容器中的现有评论

            // 遍历每条评论数据
            comments.forEach(function(comment) {
                // 为每条评论创建一个新的 div 元素
                var commentDiv = document.createElement('div');
                // 设置新元素的类名为 'comment'，用于应用样式
                commentDiv.className = 'comment';

                // 设置新评论元素的 HTML 内容，包括评论文本和创建日期
                commentDiv.innerHTML = '<p class="comment-text">' + comment.comment_text +
                                       '</p><p class="comment-date">' + comment.created_at + '</p>';

                // 将新评论元素添加到评论容器中
                commentsContainer.appendChild(commentDiv);
            });
        })
        .catch(error => {
            // 如果在请求或处理过程中出现错误，将错误记录到控制台
            console.error('Error:', error);
        });
}
//submitComment这个函数展示了如何使用原生 JavaScript 和 XMLHttpRequest 对象来处理表单提交和异步数据交互。通过 AJAX 请求，它允许用户在不重新加载页面的情况下提交评论，并立即看到更新后的评论列表。这种实时交互可以提升用户体验。此外，使用 encodeURIComponent 函数编码评论文本是很重要的，因为它确保了在发送到服务器之前对文本进行了适当的编码，防止潜在的安全问题。
// 定义函数 submitComment，处理评论提交事件
function submitComment(event) {
    event.preventDefault(); // 阻止表单的默认提交行为，以便使用 AJAX

    // 获取内容ID和评论文本的值
    var contentId = document.getElementById('content-id').value; // 假设有一个隐藏的输入字段来存储内容ID
    var commentText = document.getElementById('comment-text').value; // 获取用户输入的评论文本

    // 检查评论文本是否为空
    if (commentText === '') {
        alert('评论内容不能为空！'); // 如果为空，显示警告
        return; // 并阻止表单提交
    }

    // 创建一个新的 XMLHttpRequest 对象用于发送请求
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'submit_comment.php', true); // 配置请求为 POST 方法，指向 submit_comment.php
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); // 设置请求头

    // 当请求加载完成时执行的函数
    xhr.onload = function() {
        if (xhr.status == 200) { // 如果响应状态码为 200，表示请求成功
            console.log(xhr.responseText); // 在控制台打印响应文本
            document.getElementById('comment-text').value = ''; // 清空评论输入框
            fetchLatestComments(contentId); // 重新获取最新评论并更新页面
        } else {
            console.error('评论提交失败'); // 如果响应状态码不是 200，表示请求失败
        }
    };

    // 发送请求，包含内容ID和编码后的评论文本
    xhr.send('content_id=' + contentId + '&comment=' + encodeURIComponent(commentText));
}

 
 
</script>




 

</head>
<body>

           <!-- Adding a navbar with login, register buttons and a search box -->
<!-- 第一行：LOGO、注册、登录 -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="pubu.php" style="    font-weight: bold; color: #000;">PANDA</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="regedit.html"><span class="glyphicon glyphicon-user"></span> 注册</a></li>
            <li><a href="login.html"><span class="glyphicon glyphicon-log-in"></span> 登录</a></li>
        </ul>
    </div>
</nav>

<!-- 第二行：分类 -->
<div class="container-fluid category-bar">
    <ul class="nav navbar-nav">
        <li><a href="pubu.php?category=1">图标</a></li>
        <li><a href="pubu.php?category=2">场景</a></li>
        <li><a href="pubu.php?category=3">背景</a></li>
        <li><a href="pubu.php?category=4">人物</a></li>
        <li><a href="pubu.php?category=5">插画</a></li>
        <li><a href="pubu.php?category=6">科技</a></li>
        <li><a href="pubu.php?category=7">界面</a></li>
        <li><a href="pubu.php?category=8">国风</a></li>
        <!-- 更多分类 -->
    </ul>
</div>



<div class="container">
    <!-- 封面图 -->
    <img class="detail-img1" src="<?php echo $data[0]['ImageAddr']; ?>" alt="Cover Image">

    <!-- 附加图 -->
    <div class="additional-images">
        <?php 
        foreach ($data as $row) {
            if ($row['Type'] == 2) { // 假设 Type 为 2 代表附加图
                echo '<img class="detail-img2" src="'.$row['ImageAddr'].'" alt="Additional Image">';
            }
        }
        ?>
    </div>

    <!-- 信息 -->
    <ul class="detail-info">
        <li><span class="title">咒语:</span> <?php echo $data[0]['Spell']; ?></li> 
    </ul>
</div>


<div class="container">
    <!-- 点赞按钮 -->
    <div class="like-section">
         
        <button id="like-button" class="like-button" data-content-id="<?php echo $infoid;?>">👍 点赞</button>

<span id="like-count"><?php echo $likes_count; ?></span>

 
    </div>

    <!-- 评论部分 -->
    <div class="comment-section">
        <h3>评论</h3>
<div id="comments">
    <!-- 示例评论 -->
    <div class="comment">
    
    </div>
    <!-- 可以添加更多评论 -->
</div>

        <form id="comment-form" onsubmit="submitComment(event)"> 

            <textarea id="comment-text" placeholder="添加评论..."></textarea>
            <?php
            if($allowComments){
                echo ' <button type="submit" class="submit-button">提交评论</button>';}
            else{
                  echo ' <button disabled  type="submit" class="submit-button">管理员禁止评论</button><style>#comments{display:none;}</style>';}
                  ?>
            <input type="hidden" id="content-id" value="<?php echo $infoid;?>">

        </form>
    </div>
</div>


</body>
</html>