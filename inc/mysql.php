<?php
    /**
     * MySQL 数据库连接类库
     */
    class mysql
    {
        // 连接标识符
        private $link_id = null;
        // 数据库服务器主机地址
        private $host = "122.51.76.233";
        // 数据库服务器主机用户名
        private $user = "chatRoom";
        // 数据库服务器主机密码
        private $pw = "chatRoom123";
        // 数据库名称
        private $database = "chatRoom";
        // 最后一次错误信息
        public $errMsg = null;

        // 构造函数
        function __construct()
        {
            if ($this -> link_id) {
                return true;
            }
        }

        // 连接数据库服务器
        private function link()
        {
            $link_id = mysqli_connect($this -> host,$this -> user,$this -> pw,$this -> database);
            if (!$link_id) {
                $this -> errMsg = mysqli_connect_error();
                return false;
            }else{
                $this -> link_id = $link_id;
                return true;
            }
        }

        // 获取错误信息
        public function getErrorMsg()
        {
            return $this -> errMsg == null?'无错误':$this -> errMsg;
        }

        // 直接执行SQL语句
        public function execute($sql)
        {
            if (!$this -> link_id) {
                $this -> link();
            }
            $res = mysqli_query($this -> link_id,$sql);
            return $res;
        }
    }
?>