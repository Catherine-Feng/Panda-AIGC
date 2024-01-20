<?php
include_once 'functions.php';

// 获取页面和分类参数
// $page = isset($_GET['page']) ? $_GET['page'] : 0;//预留
$category = isset($_GET['category']) ? $_GET['category'] : null; // 使用 null 作为默认值

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

$sql = "
SELECT Info.InfoID, Info.Spell, Images.ImageAddr, Images.Type
FROM Info 
JOIN Images ON Info.InfoID = Images.InfoID
JOIN categories ON Info.CategoryID = categories.CategoryID
WHERE Info.is_deleted = 0 AND Images.Type = 1
";

if (!empty($category)) {
    $sql .= " AND categories.CategoryID = '{$category}'"; // 仅当 category 不为空时添加
}

$sql .= " ORDER BY Info.InfoID DESC";

$result = $mysqli->query($sql);
$data = array();

while ($row = mysqli_fetch_array($result)) {
    $data[] = array(
        'infoID' => $row['InfoID'],
        'spell' => $row['Spell'],
        'imageAddr' => $row['ImageAddr'],
        'type' => $row['Type'],
    );
}

echo json_encode($data);

$mysqli->close();
?>
