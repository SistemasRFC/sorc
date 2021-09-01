<?php
include_once("../BaseController.php");
include_once("../../Model/TransferenciaContas/TransferenciaContasModel.php");
include_once("../../Model/ContasBancarias/ContasBancariasModel.php");
class TransferenciaContasController extends BaseController
{
    function TransferenciaContasController(){
        $method = $_REQUEST['method'];
        $string =$method.'()';
        $method = "\$this->".$string.";";
        //echo $method;
        eval($method);

    }

    Function ChamaView(){
        $listaMeses = $this->ListarMeses();
        $listaAnos = $this->ListarAnos();
        $contasBancariasModel = new ContasBancariasModel();
        $listaContasBancariasOrigem = $contasBancariasModel->ListarContasBancarias(false);
        $listaContasBancariasDestino = $contasBancariasModel->ListarContasBancarias(false);
        $params = array('ListaContasBancariasOrigem' => urlencode(serialize($listaContasBancariasOrigem[1])),
                        'ListaContasBancariasDestino' => urlencode(serialize($listaContasBancariasDestino[1])),
                        'ListaMeses' => urlencode(serialize($listaMeses)),
                        'ListaAnos' => urlencode(serialize($listaAnos)),
                        'nroMesReferencia' => urlencode(serialize(date("m"))),
                        'nroAnoReferencia' => urlencode(serialize(date("Y"))));
        $view = $this->getPath()."/View/TransferenciaContas/".str_replace("Controller", "View", get_class($this)).".php";
        echo ($this->gen_redirect_and_form($view, $params));
    }

    Function AddTransferenciaContas(){
        $model = new TransferenciaContasModel();
        echo $model->AddTransferenciaContas();
    }

    Function UpdateTransferenciaContas(){
        $model = new TransferenciaContasModel();
        echo $model->UpdateTransferenciaContas();
    }

    Function DeletarTransferencia(){
        $model = new TransferenciaContasModel();
        echo $model->DeletarTransferencia();
    }
    Function ListarTransferencias(){
        $model = new TransferenciaContasModel();
        echo $model->ListarTransferencias();
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
}
$TransferenciaContasController = new TransferenciaContasController();
?>