// 发送聊天信息
function setInfo() {
    var content = $('textarea[name="content"]').val();
    var identity = $('input[name="identity"]').val();

    if (!content) {
        layer.msg("空信息不能发送",{icon: 2});
        return false;
    }
    $.post(config.interface.basePath + "setInfo.php",{'content': content,'identity': identity},function(ret){
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