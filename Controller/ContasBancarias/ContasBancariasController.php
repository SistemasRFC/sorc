<?php
include_once("Controller/BaseController.php");
include_once("Model/ContasBancarias/ContasBancariasModel.php");
class ContasBancariasController extends BaseController
{

    Public Function ChamaView() {
       $params = array();
       echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    Function AddContaBancaria(){
        $model = new ContasBancariasModel();
        echo $model->AddContaBancaria();
    }
    
    Function UpdateContaBancaria(){
        $model = new ContasBancariasModel();
        echo $model->UpdateContaBancaria();
    }

    Function ListarContasBancarias(){
        $model = new ContasBancariasModel();
        echo $model->ListarContasBancarias();
    }

    function ListarSaldoContasBancarias(){
        $model = new ContasBancariasModel();
        echo $model->ListarSaldoContasBancarias();
    }

    Function ChamaRelatorioSaldoContasBancarias(){
        $listaMeses = $this->ListarMeses();
        $listaAnos = $this->ListarAnos();
        $params = array('ListaMeses' => urlencode(serialize($listaMeses)),
                        'ListaAnos' => urlencode(serialize($listaAnos)),
                        'nroMesReferencia' => urlencode(serialize(date("m"))),
                        'nroAnoReferencia' => urlencode(serialize(date("Y"))));
        $view = $this->getPath()."/View/ContasBancarias/ListarSaldoContasBancariasView.php";
        echo ($this->gen_redirect_and_form($view, $params));
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
        $nroAno = date("Y");
        $anos = array();
        $j=0;
        for($i=2012;$i<=$nroAno;$i++){
            $anos[$j] = array('NRO_ANO_REFERENCIA' => $i);
            $j++;
        }
        return $anos;
    }

    Function ChamaImportaSaldoView(){
        $listaMeses = $this->ListarMeses();
        $listaAnos = $this->ListarAnos();
        $params = array('ListaMeses' => urlencode(serialize($listaMeses)),
                        'ListaAnos' => urlencode(serialize($listaAnos)),
                        'nroMesReferencia' => urlencode(serialize(date("m"))),
                        'nroAnoReferencia' => urlencode(serialize(date("Y"))));
        $view = $this->getPath()."/View/ContasBancarias/ImportaSaldoView.php";
        echo ($this->gen_redirect_and_form($view, $params));        
    }

    Function ImportarSaldo(){
        $model = new ContasBancariasModel();
        echo $model->ImportarSaldo();
    }
}
$ContasBancariasController = new ContasBancariasController();
?>