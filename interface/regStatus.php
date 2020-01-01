<?php
    // 为聊天室成员单独获取身份
    @session_start();
    require_once "../inc/function.php";
    require_once "../inc/mysql.php";
    $user = $_SESSION['user'];
    if ($user) {
        $data['id'] = $user['id'];
        $data['name'] = $user['name'];
    }else{
        $insData['temp_tag'] = 1;
        $insData['name'] = "游客";
        $insData['created_at'] = time();
        $insData['add_user'] = "auto";

        $mysql = new mysql();
        $data['id'] = $mysql -> insert("user",$insData);
        $data['name'] = "游客：".$id;
    }
    $data['code'] = 0;
    echo json_encode($data);
?>