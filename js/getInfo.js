getInfo();
function getInfo() {
    $.get(config.interface.basePath + "getInfo.php",{},function(res){
        if (res.code == 0) {
            $("#infoBox").text('');
            for (var i = 0; i < res.data.length; i++) {
                var time = formatTime(res.data[i].created_at);
                var name = res.data[i].nickname?res.data[i].nickname:res.data[i].name;
                var str = '<div class="news"><span>' + name + '(' + time + ')</span> <div class="text"> <p>' + res.data[i].content + '</p> </div> </div>';
                var obj = $(str);
                $("#infoBox").append(obj);
                var scrollHeight = $('#infoBox').prop("scrollHeight");
                $('#infoBox').scrollTop(scrollHeight,800);
            }
            return true;
        }else{
            layer.msg("聊天记录获取失败",{icon: 2});
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