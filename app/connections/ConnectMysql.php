<?php
namespace App\Connections;

class ConnectMysql
{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $port;
    private $conn;

    public function __construct()
    {
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->pass = DB_PASS;
        $this->db = DB_NAME;
        $this->port = DB_PORT;
    }

    public function connect()
    {
        $this->conn = mysqli_connect(
            $this->host,
            $this->user,
            $this->pass,
            $this->db,
            $this->port
        );
    }

    public function search($table, $param, $ops = [])
    {
        $this->connect();
        $where = " 1=1 ";
        $values = array();
        foreach ($param as $key => $value) {
            $op = "=";
            if (isset($value)) {
                if (isset($ops[$key])) {
                    $op = $ops[$key];
                }
                $where .= " AND " . $key . $op . " ?";
                $values[] = $value;
            }
        }

        $sql = "SELECT * FROM " . $table . " WHERE " . $where;
        $query = mysqli_query($this->conn, $sql);
        if ($query) {
            return $query;
        } else {
            return false;
        };
    }

    public function store($table, $params, $types)
    {
        $this->connect();
        $count = count($params);
        $strKeys = "(" . implode(" ,", array_keys($params)) . ")";
        $strVals = "(?" . str_repeat(",?", $count - 1) . ")";
        $sql = "INSERT INTO $table$strKeys VALUES " . $strVals;

        /* Ejecutamos la consulta */
        return $this->exec_query($sql, $params, $types);
    }

    public function exec_query($sql, $params = [], $types = '')
    {
        if ($stmt = mysqli_prepare($this->conn, $sql)) {
            /* ligar parámetros para marcadores */
            if ($types !== '' && $params !== []) {
                $stmt->bind_param($types, ...array_values($params));
            }

            /* ejecuta sentencias prepradas */
            $stmt->execute();

            /* cierra sentencia y conexión */
            $stmt->close();

            return true;
        }
        return false;
    }
}
