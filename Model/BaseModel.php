<?php
include_once PATH . "Dao/BaseDao.php";
class BaseModel {

    Protected $objRequest;
    

    public static function PermissaoMetodoUsuario($controller, $method)
    {
        if (!isset($_SESSION)) {
            header("location: index.php");
        }
        $result = BaseDao::PermissaoMetodoUsuario($_SESSION['cod_usuario'], $controller, $method);
        if ($result[0]) {
            if ($result[1][0]['QTD'] > 0) {
                return true;
            }
        }
        return false;
    }

    public static function VerificaPermissao($controller, $method)
    {
        $result = BaseDao::VerificaPermissao($controller, $method);
        if ($result[0]) {
            if ($result[1][0]['QTD'] > 0) {
                return true;
            }
        }
        return false;
    }

    public function PopulaObjetoComRequest($columns)
    {
        $this->objRequest = new stdClass();
        foreach ($columns as $key => $value) {
            if (isset($_POST[$key])){
                $campo = BaseDao::Populate($key, $value['typeColumn']);
                $this->objRequest->$key = $campo;
            }
        }
    }
    
    public function ListarAnosCombo() {
        $nroAno = date("Y")+1;
        $result = [true, []];
        for($i=2012; $i<=$nroAno; $i++) {
            $ref = (object) array('ID' => $i, 'DSC' => $i);
            array_push($result[1], $ref);
        }
        return json_encode($result);
    }

    public function ListarMesesCombo() {
        $result = [true, []];
        $meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
        "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
        for($i= 0; $i < count($meses); $i++) {
            $ref = (object) array('ID' => $i+1, 'DSC' => $meses[$i]);
            array_push($result[1], $ref);
        }
        return json_encode($result);
    }
}
?>
