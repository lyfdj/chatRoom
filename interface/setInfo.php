<?php
    // 发送聊天信息接口
    require_once "../inc/function.php";
    require_once "../inc/mysql.php";
    // 用户id
    $user = $_SESSION['user'];
    if (!$user) {
        // 游客身份发布内容
        $user_id = (int)$_POST['identity'];
    }
    // 防止非法登录
    if (!$user_id) {
        error("请先登录后重试","https://baidu.com");
    }
    $content = $_POST['content'];
    $created_at = time();

    $mysql = new mysql();
    $sql = "INSERT INTO `info`(user_id,content,created_at) VALUES('{$user_id}','{$content}','{$created_at}')";

    // echo $mysql -> getErrorMsg();
    $res = $mysql -> execute($sql);
    if ($res) {
        $data['code'] = 0;
    }else{
        $data['code'] = 1;
    }
    echo json_encode($data);
?>