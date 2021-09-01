<?
include_once("../BaseController.php");
include_once("../../Model/Seguranca/CadastroMenuModel.php");
class CadastroMenuController extends BaseController
{
  function CadastroMenuController(){
    $method = $_REQUEST['method'];
    $string =$method.'()';
    $method = "\$this->".$string.";";    
    eval($method);

  }
  /**
   * Redireciona para a view indicada
   */
  function ChamaView(){
    $model = new CadastroMenuModel();
    $lista = $model->ListaMenus();
    $view = $this->getPath()."/View/Seguranca/".str_replace("Controller", "View", get_class($this)).".php?ListaMenus=".urlencode(serialize($lista));
    header("Location: ".$view);
  }
  /**
   * Adiciona um menu na tabela SE_MENU
   */
  function AddMenu(){
    $model = new CadastroMenuModel();
    echo $model->AddMenu();
  }

  function UpdateMenu(){
    $model = new CadastroMenuModel();
    echo $model->UpdateMenu();
  }

  function DeleteMenu(){
    $model = new CadastroMenuModel();
    echo $model->DeleteMenu();
  }
  
  function ListarMenusGrid(){
    if ( !isset($_REQUEST['term']) )
        exit;
    $model = new CadastroMenuModel();
    $lista = $model->ListarMenusGrid($_REQUEST['term']);
    echo $lista;
    flush();
  }
}
$cadastroMenuController = new CadastroMenuController();
?>