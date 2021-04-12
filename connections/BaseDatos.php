<?php
class BaseDatos{

    private $connection_string;
    private $user;
    private $pass;
    public $db;
    public $msj_error;

    public function __construct()
    {
        $this->connection_string = 'DRIVER={SQL Server};SERVER=;DATABASE=;charset=utf8';
        $this->user = 'root';
        $this->pass = '';
        $conexion = odbc_connect($this->connection_string, $this->user, $this->pass);
        if ($conexion == false) {
            $e = odbc_error();
            trigger_error(htmlentities(odbc_errormsg(), ENT_QUOTES), E_USER_ERROR);
        }
        $this->db = $conexion;
    }

    /**
     * Ejecuta una instruccion SQL.
     * 
     * Ejecuta SQL plano sin verificacion de parametros.
     * Si se busca ejecutar una instruccion SQL preparada, se debe utilizar executeQuery($stmt, $alta, $parameters).
     *  @param  string $query query SQL lista para ejecutar.
     *  @return resource|bool resource|false segun el exito en la ejecucion.
     */
    function query($query)
    {
        return odbc_exec($this->db,$query);
    }

    function Registro($query_result)
    {
        return odbc_fetch_array($query_result);
    }

    function numRows($query_result)
    {
        return odbc_num_rows($query_result);
    }

    function fetch_all($query_result, $res = null)
    {
        return false;
    }

    function select_db($database_db)
    {
        return false;
    }

    function prepareQuery($query)
    {
        return odbc_prepare($this->db, $query);
    }

    /**
     * Ejecuta una sentencia preparada con los parametros provistos.
     * 
     * Dado un resource de una sentencia SQL preparada, unifica los valores parametrizados.
     * Si se busca ejecutar una instruccion SQL no preparada, se debe utilizar Query($sql).
     *  @param  resource $stmt query preparada anteriormente con prepareQuery
     *  @param  boolean $alta true si la query es una alta para retornar el ID, false en otro caso
     *  @param  array $parameters array de parametros con los cuales instanciar la query preparada
     *  @return int|bool ID si $alta es true, true|false en otro caso
     */
    function executeQuery($stmt, $alta, $parameters, $from = '')
    {
        $temp = odbc_exec($this->db, "SET NOCOUNT ON");	
        $ret = odbc_execute($stmt, $parameters);
        if($alta){
            $r = odbc_exec($this->db, "SELECT @@IDENTITY AS ID");
            $rc = odbc_fetch_into($r, $row);
            $ret = $row[0];    
        }

        if (!$temp or !$ret){
            $this->msj_error = $stmt;
            $myfile = fopen("log.txt", "a") or die("Unable to open file!");
            $msg = "\nTemp:$temp\nRet: $ret\nStatement: $stmt \n From: $from \n";
            $error = odbc_errormsg($this->db);
            $msg .= $error;
            fwrite($myfile, $msg);
            fclose($myfile);
        }

        return $ret;
    }

    function commit()
    {
        odbc_commit($this->db);
    }

    function parse($query)
    {
        return odbc_prepare($this->db, $query);
    }

    function getError(){
        return odbc_error($this->db) +" - "+ odbc_errormsg($this->db) +" - "+ $this->msj_error;
    }

}