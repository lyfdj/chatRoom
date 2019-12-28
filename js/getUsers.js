getUsers();
isIdentity();
function getUsers() {
    $.get(config.interface.basePath + "getUsers.php",{},function(res){
        if (res.code == 0) {
            $("#usersBox").text('');
            for (var i = 0; i < res.data.length; i++) {
                var str = '<p>' + res.data[i].id + ':' + res.data[i].name + '</p>';
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
    if ($.cookie('identity')) {
        $('input[name=identity]').val($.cookie('identity'));
        return true;
    }
    $.get(config.interface.basePath + "regStatus.php",function(res){
        if(res.code > 0){
            // 操作失败
            layer.msg(res.msg,{icon: 2});
            return false;
        }else{
            $.cookie('identity',res.id,{
                expires:2,
                path:'/',
                secure:false
            })
            return true;
        }
    },"json");
}