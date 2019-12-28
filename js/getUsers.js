getUsers();
isIdentity();
function getUsers() {
    $.get(config.interface.basePath + "getUsers.php",{},function(res){
        if (res.code == 0) {
            $("#usersBox").text('');
            for (var i = 0; i < res.data.length; i++) {
                var user_id = res.data[i].id;
                var name = res.data[i].nickname?res.data[i].nickname:res.data[i].name + " " + user_id;
                var str = '<p>' + res.data[i].id + ':' + name + '</p>';
                var obj = $(str);
                $("#usersBox").append(obj);
                // $('#usersBox').scrollTop(scrollHeight,800);
            }
            return true;
        }else{
            layer.msg("聊天成员信息获取失败",{icon: 2});
            return false;
        }
    },"json");
}

// 为聊天成员注册身份
function isIdentity () {
    // 已有身份成员
    // $.cookie('identity',null);
    // console.log("5841:" + $.cookie('identity'));return;
    if (!isNaN($.cookie('identity'))) {
        $('input[name=identity]').val($.cookie('identity'));
        return true;
    }
    $.get(config.interface.basePath + "regStatus.php",function(res){
        if(res.code > 0){
            // 操作失败
            layer.msg(res.msg,{icon: 2});
            return false;
        }else{
            // console.log(res.id);
            $.cookie('identity',res.id)
            $('input[name=identity]').val(res.id);
            return true;
        }
    },"json");
}