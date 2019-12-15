// 发送聊天信息
function setInfo() {
    var url = 'http://192.168.1.102/';
    var content = $('textarea[name="content"]').val();
    if (!content) {
        layer.msg("空信息不能发送",{icon: 2});
        return false;
    }
    $.post(url + "setInfo.php",{'content': content},function(ret){
        if (ret.code == 0) {
            $('textarea[name="content"]').val('');
            getInfo();
            return true;
        }else{
            layer.msg("错误！发送信息失败!",{icon: 2});
            return false;
        }
    },'json');
}