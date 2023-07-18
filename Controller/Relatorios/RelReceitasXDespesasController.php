<?php
include_once("Controller/BaseController.php");
include_once("Model/Relatorios/RelReceitasXDespesasModel.php");
class RelReceitasXDespesasController extends BaseController
{
    Public Function RelReceitasXDespesasController(){
        eval("\$this->".BaseController::getMethod()."();");

    }
    
    Public Function ChamaView(){
        $params = array();        
        $view = $this->getPath()."/View/Relatorios/".str_replace("Controller", "View", get_class($this)).".php";
        echo ($this->gen_redirect_and_form($view, $params));
    }
    
    Public Function CarregaRegistros(){
        $model = new RelReceitasXDespesasModel();
        echo $model->CarregaRegistros();
    }
    
    Function ListarMeses(){
        $meses = array(array('NRO_MES_REFERENCIA' => '01',
                             'DSC_MES_REFERENCIA' => 'Janeiro'),
                       array('NRO_MES_REFERENCIA' => '02',
                             'DSC_MES_REFERENCIA' => 'Fevereiro'),
                       array('NRO_MES_REFERENCIA' => '03',
                             'DSC_MES_REFERENCIA' => 'Março'),
                       array('NRO_MES_REFERENCIA' => '04',
                             'DSC_MES_REFERENCIA' => 'Abril'),
                       array('NRO_MES_REFERENCIA' => '05',
                             'DSC_MES_REFERENCIA' => 'Maio'),
                       array('NRO_MES_REFERENCIA' => '06',
                             'DSC_MES_REFERENCIA' => 'Junho'),
                       array('NRO_MES_REFERENCIA' => '07',
                             'DSC_MES_REFERENCIA' => 'Julho'),
                       array('NRO_MES_REFERENCIA' => '08',
                             'DSC_MES_REFERENCIA' => 'Agosto'),
                       array('NRO_MES_REFERENCIA' => '09',
                             'DSC_MES_REFERENCIA' => 'Setembro'),
                       array('NRO_MES_REFERENCIA' => '10',
                             'DSC_MES_REFERENCIA' => 'Outubro'),
                       array('NRO_MES_REFERENCIA' => '11',
                             'DSC_MES_REFERENCIA' => 'Novembro'),
                       array('NRO_MES_REFERENCIA' => '12',
                             'DSC_MES_REFERENCIA' => 'Dezembro'));
        return $meses;
    }
    
    Function ListarAnos(){
        $model = new RelReceitasXDespesasModel();
        echo $model->ListarAnos();
    }
}
$RelReceitasXDespesasController = new RelReceitasXDespesasController();
?>