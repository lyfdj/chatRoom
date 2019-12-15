getInfo();
function getInfo() {
    $.get("http://192.168.1.102/getInfo.php",{},function(res){
        if (res.code == 0) {
            // console.log("成功");
            // console.log(res.data);
            // $('#').
            // for (var i = res.data.length - 1; i >= 0; i--) {
                for (var i = 0; i < res.data.length; i++) {

                    var time = formatTime(res.data[i].created_at);
                    var str = '<div class="news"><span>' + res.data[i].nickname + '(' + time + ')</span> <div class="text"> <p>' + res.data[i].content + '</p> </div> </div>';
                // console.log(str);
                var obj = $(str);
                $("#infoBox").append(obj);
            }

            return true;
        }else{
            // console.log("失败");
            layer.msg("聊天记录获取失败",{icon: 2});
            return false;
        }
    },"json");
    // 第一个参数： 接口的URL
    // 第二个参数： 需要发送到接口的数据
    // 第三个参数： 回调函数 -> 获取接口返回的数据
    // 第四个参数： 期待返回数据类型
}

function formatTime (time) {
    // let unixtime = time;
    // let unixTimestamp = new Date(unixtime * 1000);
    // let Y = unixTimestamp.getFullYear();
    // let M = ((unixTimestamp.getMonth() + 1) > 10 ? (unixTimestamp.getMonth() + 1) : '0' + (unixTimestamp.getMonth() + 1));
    // let D = (unixTimestamp.getDate() > 10 ? unixTimestamp.getDate() : '0' + unixTimestamp.getDate());
    // let toDay = Y + '-' + M + '-' + D;
    // return toDay;
    var unixTimestamp = new Date(time* 1000);
    commonTime = unixTimestamp.toLocaleString();
    return commonTime;
}