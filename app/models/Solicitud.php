<?php

namespace App\Models;

use App\Connections\ConnectMysql;

/**
 * This is the model class for table "Grupo".
 *
 * @property int $id
 * @property int $id_usuario_solicitante
 * @property int $id_usuario_solicitado
 * @property string $tipo_empleo
 * @property bool $renovacion 
 * @property bool $capacitacion
 * @property int $id_capacitador
 * @property bool $municipalidad_nqn
 * @property int $nro_recibo
 * @property string $path_comprobante_pago
 * @property string $estado
 * @property string $retiro_en
 * @property string $fecha_alta
 *
 */
class Solicitud
{
    public $id_usuario_solicitante;
    public $id_usuario_solicitado;

    public function __construct()
    {
        $this->id_usuario_solicitante = "";
        $this->id_usuario_solicitado = "";
    }

    public function set($id_usuario_solicitante = null, $id_usuario_solicitado = null, $tipo_empleo = null, $renovacion = null, $capacitacion = null, $id_capacitador = null, $municipalidad_nqn = null, $nro_recibo = null, $path_comprobante_pago = null, $estado = null, $retiro_en = null, $fecha_alta = null)
    {
        $this->id_usuario_solicitante = $id_usuario_solicitante;
        $this->id_usuario_solicitado = $id_usuario_solicitado;        
    }

    public function save()
    {
        $array = json_decode(json_encode($this), true);
        $conn = new ConnectMysql();
        $conn->store('ls_solicitudes', $array, 'ss');
    }

    public static function list($param = [], $ops = [])
    {
        $conn = new ConnectMysql();
        $solicitud = $conn->search('ls_solicitudes', $param, $ops);
        return $solicitud;
    }

    public static function get($id)
    {
        $conn = new ConnectMysql();
        $params = ['id' => $id];
        $result = $conn->search('ls_solicitudes', $params);
        $solicitud = $conn->fetch_assoc($result);
        return $solicitud;
    }

    public static function update($res, $id)
    {
        $conn = new ConnectMysql();
        $result = $conn->update('ls_solicitudes', $res, $id);
        return $result;
    }

    /* CODIGO VIEJO */
    public function cargar()
    {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM ferias_solicitud WHERE id = ?";
        $params = array($this->getId());

        if ($base) {
            $query = $base->prepareQuery($sql);
            $res = $base->Query($query, $params);
            if ($res > -1) {
                if ($res > 0) {
                    $row = $base->Registro($query);
                    $this->setear($row['id'], $row['id_usuario'], $row['feria'], $row['nombre_emprendimiento'], $row['rubro_emprendimiento'], $row['producto'], $row['instagram'], $row['previa_participacion'], $row['estado'], $row['id_usuario']);
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
        $params = array($this->getId_usuario(), $this->getEstado(), $this->getObservacion(), $this->getFeria(),  $this->getNombre_emprendimiento(), $this->getRubro_emprendimiento(), $this->getProducto(), $this->getInstagram(), $this->getPrevia_participacion());
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
        $res = $base->executeQuery($query, false, $valor);
        if ($res) {
            while ($row = $base->Registro($query)) {
                $obj = new Solicitud();
                $obj->setear($row['id'], $row['id_usuario'], $row["feria"], $row['nombre_emprendimiento'], $row["rubro_emprendimiento"], $row['producto'], $row['instagram'], $row['previa_participacion'], $row['estado'], $row['observacion']);
                array_push($arreglo, $obj);
            }
        }
        return $arreglo;
    }
}
