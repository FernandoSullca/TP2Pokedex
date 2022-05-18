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
        $array_ini = $this->readConfiguration();
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

    //consulta aca iria para la tabla pokemón u otro
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

    private function readConfiguration(){
        return parse_ini_file("./configuracion/database.ini");
    }

}








?>