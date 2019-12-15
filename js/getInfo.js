getInfo();
function getInfo() {
    $.get("http://192.168.1.102/getInfo.php",{},function(res){
        if (res.code == 0) {
            // console.log("成功");
            // console.log(res.data);
            // $('#').
            // for (var i = res.data.length - 1; i >= 0; i--) {
            for (var i = 0; i < res.data.length; i++) {

                // var txt2=$();
                // $("#infoBox").append(txt2);
                var str = '<div class="news"><span>' + res.data[i].user_id + '(XXX)</span> <div class="text"> <p>' + res.data[i].content + '</p> </div> </div>';
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