<?php
    function exit_msg($msg,$code=1)
    {
        echo "sasd";
    }
    function error($msg = "错误！",$url = ''){
        echo <<<EOF
        <script>
            alert('$msg');
            window.location.href="$url";
        </script>
EOF;
    }
    function dump($var='')
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
    function halt($var='')
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        exit();
    }
?>