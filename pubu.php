<!DOCTYPE html>
<html>
<head>
    <title>瀑布流加载</title>
        <!-- Add Bootstrap CSS for navbar -->
    <link rel="stylesheet" href="style/bootstrap.min.css"> 
    <link rel="stylesheet" href="style/style.css"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- content="width=device-width"：这指定宽度应该与设备的屏幕宽度相同。这意味着网页的宽度将根据查看网站的设备（如手机、平板电脑或桌面电脑）的屏幕宽度来调整。
    initial-scale=1.0"：这设置网页的初始缩放比例为 1.0，即网页的初始大小应该是 100%。这意味着网页在加载时不会放大也不会缩小，而是以其原始大小显示。-->

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
        <li><a href="?category=1">图标</a></li>
        <li><a href="?category=2">场景</a></li>
        <li><a href="?category=3">背景</a></li>
        <li><a href="?category=4">人物</a></li>
        <li><a href="?category=5">插画</a></li>
        <li><a href="?category=6">科技</a></li>
        <li><a href="?category=7">界面</a></li>
        <li><a href="?category=8">国风</a></li>
        <!-- 更多分类 -->
    </ul>
</div>




    <div id="container" class="clearfix"></div>

    <script src="style/jquery-3.6.0.min.js"></script>
    <script>
        let currentPage = 0;// 定义一个变量 currentPage 来跟踪当前请求的页面
        let currentCategory = <?php
       echo $category = isset($_GET['category']) ? $_GET['category'] : 0; // 使用 null 作为默认值

        ?> // 新增变量存储当前分类
        const container = $('#container');// 获取页面中 id 为 container 的元素

        const showMoreItems = function () {$.ajax({   // 定义一个函数 showMoreItems 来发送 AJAX 请求$.ajax({ // 使用 jQuery 的 ajax 方法来发送请求
                 url: `script.php?page=${currentPage}&category=${currentCategory}`,// 请求的 url，其中包含当前页面
                method: "GET",// 请求的方法为 GET
                dataType: "json",// 返回的数据类型为 json
                success: function (data) {// 请求成功时，执行的回调函数
                    data.forEach(item => {// 遍历返回的数据
                            let newElement = $(// 利用 jQuery 创建一个新的 HTML 元素
        `<div class="item">
            <h3>${item.spell}</h3>
            <a href="detail-page.php?infoid=${item.infoID}">
                <img src="${item.imageAddr}" alt="Image of ${item.spell}" title="${item.spell}" />
            </a>
        </div>`
    )
                        container.append(newElement);// 将新的元素添加到 container 中
                    })
                    currentPage++; // currentPage 加 1
                },
                error: function(e) { // 请求失败时，执行的回调函数
                    console.error(e);// 打印错误到控制台
                }
            });
        };$(window).on('scroll', function() { // 当用户滚动浏览器窗口时，触发的事件
            if($(window).scrollTop() +$(window).innerHeight() >= $(document).height()) {// 判断滚动条是否到达底部
                showMoreItems();// 如果到底，请求更多的数据
            }
        });

 
        //第一次加载页面，请求数据     // 当页面加载完后，立即请求数据
        showMoreItems();
    </script>
</body>
</html>