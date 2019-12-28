<?php
    // 为聊天室成员单独获取身份

    require_once "../inc/function.php";
    require_once "../inc/mysql.php";
    $user = $_SESSION['user'];
    if ($user) {
        $id = $user['id'];
    }else{
        $insData['temp_tag'] = 1;
        $insData['name'] = "游客";
        $insData['created_at'] = time();
        $insData['add_user'] = "auto";

        $mysql = new mysql();
        $id = $mysql -> insert("user",$insData);
    }
    $data['code'] = 0;
    $data['id'] = $id;
    $data['name'] = "游客：".$id;
    echo json_encode($data);
?>