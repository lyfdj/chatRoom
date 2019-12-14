<?php
// phpinfo();exit;
    // 获取聊天内容接口
    require_once "./inc/function.php";
    require_once "./inc/mysql.php";
    $mysql = new mysql();
    // echo $mysql -> getErrorMsg();
    $user_id = 1;
    // 防止非法登录
    if (!$user_id) {
        error("请先登录后重试","https://baidu.com");
    }
    $sql = "SELECT * FROM `info`";
    $res = $mysql -> execute($sql);
    $info = mysqli_fetch_all($res,MYSQLI_ASSOC);
    dump($info);
?>