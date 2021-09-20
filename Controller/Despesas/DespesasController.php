<?php
include_once("../BaseController.php");
include_once("../../Model/TipoDespesa/TipoDespesaModel.php");
include_once("../../Model/Despesas/DespesasModel.php");
include_once("../../Model/ContasBancarias/ContasBancariasModel.php");
include_once("../../Model/ClienteFinal/ClienteFinalModel.php");

class DespesasController extends BaseController
{
    function DespesasController(){
        $method = $_REQUEST['method'];
        $string =$method.'()';
        $method = "\$this->".$string.";";
        eval($method);

    }
    
    Function ChamaView(){
        $listaMeses = $this->ListarMeses();
        $listaAnos = $this->ListarAnos();
        $contasBancariasModel = new ContasBancariasModel();
        $listaContasBancarias = $contasBancariasModel->ListarContasBancariasAtivas(false);        
        $tipoDespesaModel = new TipoDespesaModel();
        $clienteFinal = new ClienteFinalModel();
        $listaClientes = $clienteFinal->ListarClienteFinalAtivo(false);
        $listaTipoDespesa = $tipoDespesaModel->ListarTiposDespesasAtivos(false);
        $params = array('ListaTipoDespesa' => urlencode(serialize($listaTipoDespesa)),
                        'ListaContasBancarias' => urlencode(serialize($listaContasBancarias)),
                        'ListaMeses' => urlencode(serialize($listaMeses)),
                        'ListaClientes' => urlencode(serialize($listaClientes)),
                        'ListaAnos' => urlencode(serialize($listaAnos)),
                        'codTipoDespesa' => urlencode(serialize(0)),
                        'nroMesReferencia' => urlencode(serialize(date("m"))),
                        'nroAnoReferencia' => urlencode(serialize(date("Y"))));
        $view = $this->getPath()."/View/Despesas/".str_replace("Controller", "View", get_class($this)).".php";
        echo ($this->gen_redirect_and_form($view, $params));
    }

    Public Function ChamaRelatorioTipoDespesa(){
        $listaMeses = $this->ListarMeses();
        $listaAnos = $this->ListarAnos();
        $params = array('ListaMeses' => urlencode(serialize($listaMeses)),
                        'ListaAnos' => urlencode(serialize($listaAnos)),
                        'nroMesReferencia' => urlencode(serialize(date("m"))),
                        'nroAnoReferencia' => urlencode(serialize(date("Y"))));
        $view = $this->getPath()."/View/Despesas/RelatorioTipoDespesaView.php";
        echo ($this->gen_redirect_and_form($view, $params));  
    }
    
    Function ImportarDespesa(){
        $model = new DespesaModel();
        echo $model->ImportarDespesa();
    }
    Function AddDespesa(){
        $model = new DespesaModel();
        echo $model->AddDespesa();
    }

    Function UpdateDespesa(){
        $model = new DespesaModel();
        echo $model->UpdateDespesa();
    }
    
    Function DeletarDespesa(){
        $model = new DespesaModel();
        echo $model->DeletarDespesa();
    }

    Function ListarDespesas(){
        $model = new DespesaModel();
        echo $model->ListarDespesas();
    }

    Function ListarDespesasGrid(){
        $model = new DespesaModel();
        echo $model->ListarDespesasGrid();
    }

    Function ListarSomaTipoDespesas(){
        $model = new DespesaModel();
        echo $model->ListarSomaTipoDespesas();
        flush();
    }

    Function PegaLimiteTipoDespesa(){
        $model = new DespesaModel();
        echo $model->PegaLimiteTipoDespesa();
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
        $nroAno = date("Y")+1;
        $anos = array();
        $j=0;
        for($i=2012;$i<=$nroAno;$i++){            
            $anos[$j] = array('NRO_ANO_REFERENCIA' => $i);
            $j++;
        }
        return $anos;
    }
    
    Public Function QuitarParcelas(){
        $model = new DespesaModel();
        echo $model->QuitarParcelas();
    }
    
    Public Function PagarPorConta(){
        $model = new DespesaModel();
        echo $model->PagarPorConta();
    }
}
$DespesasController = new DespesasController();
?>