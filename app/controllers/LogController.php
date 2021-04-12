<?php
class LogController {
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Log
     */
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('id',$param) 
                and array_key_exists('id_usuario',$param)
                and array_key_exists('id_solicitud', $param)
                and array_key_exists('error', $param)){

            $obj = new Log();

            $obj->setear($param['id'], $param['id_usuario'], $param['id_solicitud'], $param["error"]);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Log
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['id']) ){
            $obj = new Log();
            $obj->setId($param['id']);
        }
        return $obj;
    }
    
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['id']))
            $resp = true;
        return $resp;
    }
    
    /**
     * 
     * @param array $param
     * @return array Objetos Sube, Posicion y Log cargados
     */
    public function alta($param){
        $resp = false;
        $param['id'] =null;
        
        $log = $this->cargarObjeto($param);
        if ($log!=null and $log->insertar()){
                $resp = $log;
            }
        return $resp;
        
    }
    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
      
        if ($this->seteadosCamposClaves($param)){
            $log = $this->cargarObjetoConClave($param);
            if ($log!=null and $log->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
       
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $log = $this->cargarObjeto($param);
            if($log!=null and $log->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Permite realizar la busqueda de un objeto por multiples campos y si se especifica, con operadores
     * específicos.
     * @param array $param arreglo del tipo 'campo' => 'valor buscado' o vacio si se necesitan listar todos
     * @param array $ops arreglo opcional del tipo 'campo' => 'operador', por defecto el operador es '='
     * @return Log[]
     */
    public function buscar($param = [], $ops = [])
    {
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
        $arreglo = Log::listar($where, $values);  
        return $arreglo;
    }
   
}