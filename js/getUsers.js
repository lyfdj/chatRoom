getUsers();
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

function formatTime (time) {
    // 将 Unix 时间戳转换为时间对象
    var unixTimestamp = new Date(time* 1000);
    // 获取格式化后的时间字符串
    commonTime = unixTimestamp.toLocaleString();
    return commonTime;
}