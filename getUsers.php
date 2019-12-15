<?php
    // 获取所有聊天用户接口
    require_once "./inc/mysql.php";
    require_once "./inc/function.php";
    $mysql = new mysql();
    $rows = $mysql -> table("user") -> field("id,nickname,name,created_at") -> where("1=1") -> select();
    $data['code'] = 0;
    $data['count'] = count($rows);
    $data['data'] = $rows;
    // echo $mysql -> getLastQuery();
    echo json_encode($data);
?>