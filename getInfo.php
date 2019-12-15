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
    // $sql = "SELECT * FROM `info`";
    // $res = $mysql -> execute($sql);
    // $info = mysqli_fetch_all($res,MYSQLI_ASSOC);
    // SELECT a.id,b.nickname,b.name,a.content,a.created_at FROM `info` as a,user as b where a.user_id=b.id;
    $rows = $mysql -> field('a.id,b.nickname,b.name,a.content,a.created_at')
        -> table('`info` as a,`user` as b')
        -> where('a.user_id=b.id')
        -> order('a.created_at')
        -> select();
        // halt($mysql -> getLastQuery());
    $data['count'] = count($rows);
    $data['data'] = $rows;
    $data['code'] = 0;
    echo json_encode($data);
?>