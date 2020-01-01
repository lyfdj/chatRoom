<?php
    // 用户登录接口
    @session_start();
    require_once "../inc/function.php";
    require_once "../inc/mysql.php";

    $userName = trim($_POST['userName']);
    $userPw = $_POST['userPw'];
    $isAutoLogin = (int)$_POST['isAutoLogin'];

    if ($userName == '' or $userPw == '') {
        jsAlert("用户名和密码不能为空！","../login.html");
        exit;
    }

    $mysql = new mysql();
    $row = $mysql -> find("user","name='{$userName}'");
    if (!$row) {
        jsAlert("此用户不存在","../login.html");
        exit;
    }

    $rowPw = decrypt($row['pw']);
    if ($rowPw != $userPw) {
        jsAlert("密码错误！","../login.html");
    }

    $_SESSION['user'] = $row;

    jsAlert("登录成功！","../chatting.html");
?>