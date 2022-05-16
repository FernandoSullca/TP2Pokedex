<?php
class MySqlDatabase
{
    private $host; 
    private $user;
    private $pass;
    private $database;
    private $conn;

    public function __construct()
    {
        $array_ini = $this->getConfiguration();

        $this->host = $array_ini["servername"];
        $this->user = $array_ini["username"];
        $this->pass = $array_ini["password"];
        $this->database = $array_ini["dbname"];

        $this->connect();
    }
    
    public function __destruct()
    {
        $this->disconnect();
    }

    private function getConfiguration(){
        return parse_ini_file("./configuracion/database.ini");
    }

    public function callProcedure($pv_proc, $pt_args )
    {
        if (empty($pv_proc) || empty($pt_args))
        {
            return false;
        }
        $lv_call   = "CALL $pv_proc (";
        foreach($pt_args as $lv_key=>$lv_value)
        {
            $lv_call   .= (is_null ($lv_value)?"null":"'".$lv_value."'").",";
        }
        $lv_call   = substr($lv_call, 0, -1).");";

        return $this->query($lv_call);
    }

    public function query($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    private function connect()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->database);
        if(!$conn)
        {
            die('Conection falied: ' . mysqli_connect_error());
        }
        $this->conn = $conn;
        #echo 'Estas conectado';
    }

    private function disconnect()
    {
        mysqli_close($this->conn);
    }
}