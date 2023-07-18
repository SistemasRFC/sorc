<?php
include_once("Controller/BaseController.php");
include_once("Model/Menu/MenuModel.php");
class MenuController extends BaseController
{

     Public Function ChamaView() {
        $params = array();
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    function AddMenu() {
        $model = new MenuModel();
        echo $model->AddMenu();
    }

    function UpdateMenu() {
        $model = new MenuModel();
        echo $model->UpdateMenu();
    }

    function DeleteMenu() {
        $model = new MenuModel();
        echo $model->DeleteMenu();
    }

    function ListarMenusAutoComplete() {
        if ( !isset($_REQUEST['term']) )
            exit;
        $model = new MenuModel();
        $lista = $model->ListarMenusAutoComplete($_REQUEST['term']);
        echo $lista;
        flush();
    }

    Public Function ListarMenusGrid() {
        $model = new MenuModel();
        echo $model->ListarMenusGrid();
    }

    Public Function ListarComboMenus() {
        $model = new MenuModel();
        echo $model->ListaMenus();
    }

    Public Function uploadArquivo() {      
        $arquivo = $_FILES['arquivo'];
        $tipos = array('jpg', 'png', 'gif', 'psd', 'bmp');
        $enviar = $this->uploadFile($arquivo, '../../Resources/images/', $tipos);
        $data[0] = false;
        if(isset($enviar['erro'])){
            $data[1]['mensagem'] = $enviar['erro'];
        }else{
            $data[0] = true;
            $data['msg'] = $enviar['caminho'];
        }
        echo json_encode($data);
    }

    function uploadFile($arquivo, $pasta, $tipos, $nome = null) {
        $nomeOriginal='';
        if(isset($arquivo)){
            $infos = explode(".", $arquivo["name"]);

            if(!$nome){
                for($i = 0; $i < count($infos) - 1; $i++){
                    $nomeOriginal = $nomeOriginal . $infos[$i] . ".";
                }
            }
            else{
                $nomeOriginal = $nome . ".";
            }
            $tipoArquivo = $infos[count($infos) - 1];

            $tipoPermitido = false;
            foreach($tipos as $tipo){
                if(strtolower($tipoArquivo) == strtolower($tipo)){
                    $tipoPermitido = true;
                }
            }
            if(!$tipoPermitido){
                $retorno["erro"] = "Tipo nÃ£o permitido";
            }
            else{
                if(move_uploaded_file($arquivo['tmp_name'], $pasta . $nomeOriginal . $tipoArquivo)){
                    $retorno["caminho"] = $pasta . $nomeOriginal . $tipoArquivo;
                }
                else{
                    $retorno["erro"] = "Erro ao fazer upload";
                }
            }
        }
        else{
            $retorno["erro"] = "Arquivo nao setado";
        }
        return $retorno;
    }

    Public Function ListarControllers () {
        $pasta = PATH.'\\Controller\\';       
        $novo = explode('\\', $pasta);
        $pasta = '';
        for ($i = 0; $i < count($novo) - 1; $i++) {
            $pasta .= $novo[$i] . '\\';
        }
        if (filter_input(INPUT_POST, 'pasta') != '') {
            if (filter_input(INPUT_POST, 'pasta') != 'undefined') {
                $pasta = $pasta . filter_input(INPUT_POST, 'pasta') . '\\';
            } else {
                echo 'Diretório ' . filter_input(INPUT_POST, 'pasta') . ' não encontrado';
            }
        }
        $pasta = $this->PegarArquivosPasta($pasta);
        echo json_encode(array(true, $pasta));
    }

    public function PegarArquivosPasta($pasta) {
        $diretorio = $pasta;
        $ponteiro  = opendir($diretorio);
        while ($nome_itens = readdir($ponteiro)) {
            $itens[] = $nome_itens;
        }
        sort($itens);
        $i = 0;
        foreach ($itens as $listar) {
            $arquivosPasta[$i]['nmeArquivo'] = $listar;
            $arquivosPasta[$i]['dscTipo'] = filetype($pasta . $listar);
            if (filetype($pasta . $listar) == "dir") {
                $arquivosPasta[$i]['dscTamanho'] = "0";
            } else {
                $arquivosPasta[$i]['dscTamanho'] = filesize($pasta . $listar);
            }
            $arquivosPasta[$i]['dtaAlteracao'] = date("d/m/Y H:i:s", filemtime($pasta . $listar));
            $i++;
        }
        return $arquivosPasta;
    }

    public function ListarMetodos() {
        $classe = filter_input(INPUT_POST, 'classe');
        include_once PATH . 'Controller\\' . $classe . '\\' . $classe . 'Controller.php';
        $metodosBase = get_class_methods('BaseController');
        $metodosController = get_class_methods($classe . 'Controller');
        $metodos = array_diff($metodosController, $metodosBase);
        foreach ($metodos as $value) {
            $methods[] = $value;
        }
        echo json_encode(array(true, $methods));
    }
}
$menuController = new MenuController();
?>