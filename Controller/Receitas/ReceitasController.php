<?php
include_once("../BaseController.php");
include_once("../../Model/Receitas/ReceitasModel.php");
include_once("../../Model/ContasBancarias/ContasBancariasModel.php");
class ReceitasController extends BaseController
{
    function ReceitasController(){
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
        $listaContasBancarias = $contasBancariasModel->ListarContasBancariasAtivas(false);
        $params = array('ListaContasBancarias' => urlencode(serialize($listaContasBancarias)),
                        'ListaMeses' => urlencode(serialize($listaMeses)),
                        'ListaAnos' => urlencode(serialize($listaAnos)),
                        'codTipoReceitas' => urlencode(serialize(0)),
                        'nroMesReferencia' => urlencode(serialize(date("m"))),
                        'nroAnoReferencia' => urlencode(serialize(date("Y"))));
        $view = $this->getPath()."/View/Receitas/".str_replace("Controller", "View", get_class($this)).".php";
        echo ($this->gen_redirect_and_form($view, $params));
    }
    
    Function ImportarReceita(){
        $model = new ReceitasModel();
        echo $model->ImportarReceita();
    }

    Function AddReceita(){
        $model = new ReceitasModel();
        echo $model->AddReceitas();
    }

    Function UpdateReceita(){
        $model = new ReceitasModel();
        echo $model->UpdateReceitas();
    }

    Function DeletarReceita(){
        $model = new ReceitasModel();
        echo $model->DeletarReceita();
    }

    Function ListarReceitas(){
        $model = new ReceitasModel();
        echo $model->ListarReceitas();
        flush();
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
$ReceitasController = new ReceitasController();
?>