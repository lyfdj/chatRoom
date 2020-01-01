<?php
    // 打印接口数据
    function exit_msg($msg,$code=1)
    {
        echo "sasd";
    }

    // 跳转
    function jsAlert($msg = "信息！",$url = ''){
        echo <<<EOF
        <script>
            alert('$msg');
            window.location.href="$url";
        </script>
EOF;
    }

    // 打印测试数据（不停止）
    function dump($var='')
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }

    // 打印测试数据（停止）
    function halt($var='')
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        exit();
    }

    // 加密
    /**
     * @param $data  要加密的字符串
     * @param $key   密钥
     * @return string
     */
    function encrypt($data, $key = 'chatRoom')
    {
        $key = md5($key);
        $x = 0;
        $len = strlen($data);
        $l = strlen($key);
        $char = '';
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) {
                $x = 0;
            }
            $char .= $key{$x};
            $x++;
        }
        $str = '';
        for ($i = 0; $i < $len; $i++) {
            $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
        }
        return base64_encode($str);
    }

    // 解密
    /**
     * @param $data    要解密的字符串
     * @param $key     密钥
     * @return string
     */
    function decrypt($data, $key = 'chatRoom')
    {
        $key = md5($key);
        $x = 0;
        $data = base64_decode($data);
        $len = strlen($data);
        $l = strlen($key);
        $char = '';
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l) {
                $x = 0;
            }
            $char .= substr($key, $x, 1);
            $x++;
        }
        $str = '';
        for ($i = 0; $i < $len; $i++) {
            if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            } else {
                $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }
        return $str;
    }
?>