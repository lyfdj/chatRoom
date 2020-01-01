<?php
    /**
     * MySQL 数据库连接类库
     */
    class mysql
    {
        // 连接标识符
        private $link_id = null;
        // 数据库服务器主机地址
        private $host = "192.168.13.6";
        // 数据库服务器主机用户名
        private $user = "chatRoom";
        // 数据库服务器主机密码
        private $pw = "chatRoom123";
        // 数据库名称
        private $database = "chatRoom";
        // 最后一次错误信息
        public $errMsg = null;
        // 最后一次执行的语句
        public $lastQuery = null;
        // 最后一次查询条件
        public $where = null;
        // 最后一次查询表名
        public $table = null;
        // 最后一次查询字段
        public $field = '*';

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
            $this -> lastQuery = $sql;
            $res = mysqli_query($this -> link_id,$sql);
            if (!$res) {
                $this -> errMsg = "SQL语句：{$sql}，执行失败";
                return false;
            }
            return $res;
        }

        // 传入查询条件，返回对象
        public function where($where)
        {
            $this -> where = $where;
            return $this;
        }

        // 传入表名，返回对象
        public function table($table)
        {
            $this -> table = $table;
            return $this;
        }

        // 传入字段，返回对象
        public function field($field = '*')
        {
            $this -> field = $field;
            return $this;
        }

        // 传入排序条件，返回对象
        public function order($order)
        {
            $this -> order = "ORDER BY ".$order;
            return $this;
        }

        // 执行查询，多条
        public function select()
        {
            if ($this -> table == null || $this -> where == null || $this -> field == null || $this -> field == '') {
                $this -> errMsg = "查询条件不完整";
                return false;
            }
            $sql = "SELECT {$this -> field} FROM {$this -> table} WHERE {$this -> where} {$this -> order}";
            $res = $this -> execute($sql);
            $rows = mysqli_fetch_all($res,MYSQLI_ASSOC);
            return $rows;
        }

        // 获取最后一次执行的SQL语句
        public function getLastQuery()
        {
            $sql = $this -> lastQuery == null ? '未执行过SQL语句' : $this -> lastQuery;
            return $sql;
        }

        // 插入数据
        public function insert($table,$data)
        {
            if (!$table) {
                $this -> errMsg = "需要插入的数据表不能为空！";
                return false;
            }
            // 处理字段和数据
            $fields = array_keys($data);
            $values = array_values($data);
            $field = implode(",", $fields);
            // 处理数组值加上引号
            foreach ($values as $k => $v) {
                $values[$k] = "'".$v."'";
            }
            $value = implode(",", $values);
            $sql = "INSERT INTO {$table}({$field}) VALUES({$value})";
            $res = $this -> execute($sql);
            if ($res) {
                return $this -> getLastInsId();
            }else{
                return false;
            }
        }

        // 获取最后一次插入操作数据的id
        public function getLastInsId()
        {
            if (!$this -> link_id) {
                $this -> link();
            }
            $lastInsId = mysqli_insert_id($this -> link_id);
            return $lastInsId;
        }

        // 查找指定记录
        public function find($table,$where,$field = '*')
        {
            if (gettype($where) == 'array') {
                $whereStr = '';
                foreach ($where as $k => $v) {
                    $whereArr[] = "{$k} = '{$v}'";
                }
                $whereStr = implode(' AND ', $whereArr);
            } else if (gettype($where) == 'string') {
                $whereStr = $where;
            }
            $sql = "SELECT {$field} FROM {$table} WHERE {$whereStr} LIMIT 1";
            $res = $this -> execute($sql);
            if ($res == null) {
                return null;
            }
            $row = mysqli_fetch_array($res);
            return $row;
        }

        // 查找指定记录集
        public function findAll($table,$where,$field = '*')
        {
            if (gettype($where) == 'array') {
                $whereStr = '';
                foreach ($where as $k => $v) {
                    $whereArr[] = "{$k} = '{$v}'";
                }
                $whereStr = implode(' AND ', $whereArr);
            } else if (gettype($where) == 'string') {
                $whereStr = $where;
            }
            $sql = "SELECT {$field} FROM {$table} WHERE {$whereStr}";
            $res = $this -> execute($sql);
            if ($res == null) {
                return null;
            }
            while ($info = mysqli_fetch_array($res)) {
                $rows[] = $info;
            }
            return $rows;
        }
    }
?>