<?php
/**
 * This is the model class for table "Grupo".
 *
 * @property int $id
 * @property int $id_usuario
 * @property int $feria
 * @property int $nombre_emprendimiento
 * @property int $rubro_emprendimiento
 * @property int $producto
 * @property int $instagram
 * @property int $previa_participacion
 * @property int $estado
 * @property string $timestamp
 *
 */
class Solicitud {
    public $id;
    public $id_usuario;
    public $feria;
    public $nombre_emprendimiento;
    public $rubro_emprendimiento;
    public $producto;
    public $instagram;
    public $previa_participacion;
    public $estado;
    public $fechaAlta;
    public $mensajeoperacion;

    public function __construct()
    {
        $this->id = "";
        $this->id_usuario = "";
        $this->feria = "";
        $this->nombre_emprendimiento = "";
        $this->rubro_emprendimiento = "";
        $this->producto = "";
        $this->instagram = "";
        $this->previa_participacion = "";
        $this->estado = "";
        $this->mensajeoperacion = "";
    }

    
    public function setear($id, $id_usuario, $feria, $nombre_emprendimiento, $rubro_emprendimiento, $producto, $instagram, $previa_participacion, $estado, $observacion)
    {
        $this->setId($id);
        $this->setId_usuario($id_usuario);
        $this->setFeria($feria);
        $this->setNombre_emprendimiento($nombre_emprendimiento);
        $this->setRubro_emprendimiento($rubro_emprendimiento);
        $this->setProducto($producto);
        $this->setInstagram($instagram);
        $this->setPrevia_participacion($previa_participacion);
        $this->setEstado($estado);
        $this->setObservacion($observacion);
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
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set the value of observacion
     *
     * @return  self
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

        /**
     * Get the value of feria
     */
    public function getFeria()
    {
        return $this->feria;
    }

    /**
     * Set the value of feria
     *
     * @return  self
     */
    public function setFeria($feria)
    {
        $this->feria = $feria;

        return $this;
    }

    /**
     * Get the value of nombre_emprendimiento
     */
    public function getNombre_emprendimiento()
    {
        return $this->nombre_emprendimiento;
    }

    /**
     * Set the value of nombre_emprendimiento
     *
     * @return  self
     */
    public function setNombre_emprendimiento($nombre_emprendimiento)
    {
        $this->nombre_emprendimiento = $nombre_emprendimiento;

        return $this;
    }
    
    /**
     * Get the value of nombre_emprendimientoLocal
     */
    public function getNombre_emprendimientoLocal()
    {
        return $this->nombre_emprendimientoLocal;
    }

    /**
     * Set the value of nombre_emprendimientoLocal
     *
     * @return  self
     */
    public function setNombre_emprendimientoLocal($nombre_emprendimientoLocal)
    {
        $this->nombre_emprendimientoLocal = $nombre_emprendimientoLocal;

        return $this;
    }

    /**
     * Get the value of rubro_emprendimiento
     */
    public function getRubro_emprendimiento()
    {
        return $this->rubro_emprendimiento;
    }

    /**
     * Set the value of rubro_emprendimiento
     *
     * @return  self
     */
    public function setRubro_emprendimiento($rubro_emprendimiento)
    {
        $this->rubro_emprendimiento = $rubro_emprendimiento;

        return $this;
    }

    /**
     * Get the value of producto
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set the value of producto
     *
     * @return  self
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get the value of instagram
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * Set the value of instagram
     *
     * @return  self
     */
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;

        return $this;
    }

    /**
     * Get the value of previa_participacion
     */
    public function getPrevia_participacion()
    {
        return $this->previa_participacion;
    }

    /**
     * Set the value of previa_participacion
     *
     * @return  self
     */
    public function setPrevia_participacion($previa_participacion)
    {
        $this->previa_participacion = $previa_participacion;

        return $this;
    }
    
    /**
     * Get the value of fechaAlta
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }

    /**
     * Set the value of fechaAlta
     *
     * @return  self
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

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
        $sql = "SELECT * FROM ferias_solicitud WHERE id = ?";
        $params = Array($this->getId());
        
        if ($base) {
            $query = $base->prepareQuery($sql);
            $res = $base->Query($query, $params);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro($query);
                    $this->setear($row['id'], $row['id_usuario'], $row['feria'], $row['nombre_emprendimiento'], $row['rubro_emprendimiento'], $row['producto'],$row['instagram'], $row['previa_participacion'], $row['estado'], $row['id_usuario']);
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
        $sql = "INSERT INTO ferias_solicitud( id_usuario, estado, observacion, feria, nombre_emprendimiento, rubro_emprendimiento, producto, instagram, previa_participacion)  ";
        $sql .= "VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = array($this->getId_usuario(), $this->getEstado(), $this->getObservacion(),$this->getFeria(),  $this->getNombre_emprendimiento(), $this->getRubro_emprendimiento(), $this->getProducto(), $this->getInstagram(), $this->getPrevia_participacion());
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
        $resp = $this;
        $base = new BaseDatos();
        $sql = "UPDATE ferias_solicitud SET id_usuario=?, feria=?, nombre_emprendimiento=?, rubro_emprendimiento=?, producto=?, instagram=?, previa_participacion=?,estado=?,observacion=?";
        $sql .= " WHERE id = ?";
        $params = array($this->getId_usuario(), $this->getFeria(), $this->getNombre_emprendimiento(), $this->getRubro_emprendimiento(), $this->getProducto(), $this->getInstagram(), $this->getPrevia_participacion(), $this->getEstado(), $this->getObservacion(), $this->getId());
        if ($base) {
            $query = $base->prepareQuery($sql);
            if ($base->executeQuery($query, false, $params, get_class($this))) {
                $resp = $this;
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
        $sql = "DELETE FROM ferias_solicitud WHERE id =?";
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

    public static function listar($parametRo = "1=1", $valor = [])
    {
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM ferias_solicitud ";
        if ($parametRo != "") {
            $sql .= 'WHERE ' . $parametRo;
        }
        $query = $base->prepareQuery($sql);
        $res = $base->executeQuery($query,false, $valor);
        if ($res) {
            while ($row = $base->Registro($query)) {
                $obj = new Solicitud();
                $obj->setear($row['id'], $row['id_usuario'], $row["feria"], $row['nombre_emprendimiento'], $row["rubro_emprendimiento"], $row['producto'],$row['instagram'], $row['previa_participacion'], $row['estado'], $row['observacion']);
                array_push($arreglo, $obj);
            }
        }
        return $arreglo;
    }
}