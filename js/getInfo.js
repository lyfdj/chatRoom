getInfo();
function getInfo() {
    $.get(config.interface.basePath + "getInfo.php",{},function(res){
        if (res.code == 0) {
            $("#infoBox").text('');
            for (var i = 0; i < res.data.length; i++) {
                // 基础信息
                var user_id = res.data[i].user_id;
                var time = formatTime(res.data[i].created_at);
                var name = res.data[i].nickname?res.data[i].nickname:res.data[i].name;
                if (res.data[i].temp_tag == 1) {
                     name = name + " " + user_id;
                }
                // 组合插入的 DOM 元素
                var str = '<div class="news"><span>' + name + '(' + time + ')</span> <div class="text"> <p>' + res.data[i].content + '</p> </div> </div>';
                var obj = $(str);
                // DOM 元素放入 DOM 树当中
                $("#infoBox").append(obj);
                // 滚动条到最下面
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