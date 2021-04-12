<?php
/**
 * This is the model class for table "Grupo".
 *
 * @property int $id
 * @property int $id_usuario
 * @property int $id_solicitud
 * @property int $error
 * @property string $timestamp
 *
 */
class Log {
    public $id;
    public $id_usuario;
    public $id_solicitud;
    public $error;
    public $date;
    public $setmensajeoperacion;

    public function __construct()
    {
        $this->id = "";
        $this->id_usuario = "";
        $this->id_solicitud = "";
        $this->error = "";
        $this->setmensajeoperacion = "";
    }

    
    public function setear($id, $id_usuario, $id_solicitud, $error)
    {
        $this->setId($id);
        $this->setId_usuario($id_usuario);
        $this->setId_solicitud($id_solicitud);
        $this->setError($error);
    }
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id_usuario
     */ 
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     *
     * @return  self
     */ 
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    /**
     * Get the value of id_solicitud
     */
    public function getId_solicitud()
    {
        return $this->id_solicitud;
    }

    /**
     * Set the value of id_solicitud
     *
     * @return  self
     */
    public function setId_solicitud($id_solicitud)
    {
        $this->id_solicitud = $id_solicitud;

        return $this;
    }

    /**
     * Get the value of error
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Set the value of error
     *
     * @return  self
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }
    
    /**
     * Get the value of date
     */
    public function getdate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setdate($date)
    {
        $this->date = $date;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    /**
     * @param string $mensajeoperacion
     */
    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM ferias_Log WHERE id = ?";
        $params = Array($this->getId());
        
        if ($base) {
            $query = $base->prepareQuery($sql);
            $res = $base->executeQuery($query, false, $params);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro($query);
                    $this->setear($row['id'], $row['id_usuario'], $row['id_solicitud'], $row['error'], $row['date']);
                }
            }
        } else {
            $this->setmensajeoperacion(get_class($this) . "->cargar: " . $base->getError());
        }
        return $resp;
    }

    public function insertar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO ferias_Log( id_usuario , id_solicitud, error)  ";
        $sql .= "VALUES(?, ?, ?)";
        $params = array($this->getId_usuario(), $this->getId_solicitud(), $this->getError());
        if ($base) {
            $query = $base->prepareQuery($sql);
            if ($elid = $base->executeQuery($query, true, $params, get_class($this))) {
                $this->setId($elid);
                $resp = $this;
            } else {
                $this->setmensajeoperacion(get_class($this) . "->insertar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion(get_class($this) . "->insertar: " . $base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE ferias_Log SET id_usuario=? ,id_solicitud=?, error=?";
        $sql .= " WHERE id = ?";
        $params = array($this->getId_usuario(), $this->getId_solicitud(), $this->getError(), $this->getId());
        if ($base) {
            $query = $base->prepareQuery($sql);
            if ($base->executeQuery($query, false, $params)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion(get_class($this) . "->modificar 1: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion(get_class($this) . "->modificar 2: " . $base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM ferias_Log WHERE id =?";
        $params = array($this->getId());
        if ($base) {
            $query = $base->prepareQuery($sql);
            if ($base->Query($query, $params)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion(get_class($this) . "->eliminar: " . $base->getError());
            }
        } else {
            $this->setmensajeoperacion(get_class($this) . "->eliminar: " . $base->getError());
        }
        return $resp;
    }

    public static function listar($parametro = "1=1", $valor = [])
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM ferias_Log ";
        if ($parametro != "") {
            $sql .= 'WHERE ' . $parametro;
        }
        $query = $base->prepareQuery($sql);
        $res = $base->executeQuery($query,false, $valor);
        if ($res) {
            while ($row = $base->Registro($query)) {
                $obj = new Log();
                $obj->setear($row['id'], $row['id_usuario'], $row['id_solicitud'], $row["error"], $row["date"]);
                array_push($arreglo, $obj);
            }
        }
        return $arreglo;
    }
}