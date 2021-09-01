<?
include_once("../BaseController.php");
include_once("../../Model/Seguranca/PerfilModel.php");
include_once("../../Model/Seguranca/UsuarioModel.php");
class UsuarioController extends BaseController
{
    function UsuarioController(){
        eval("\$this->".BaseController::getMethod()."();");
    }

  function ChamaView(){
    $perfilModel = new PerfilModel();
    $listaPerfilRestrito = $perfilModel->ListarPerfilRestrito(1,7);
    $params = array('ListaPerfilRestrito' => urlencode(serialize($listaPerfilRestrito)),
                    'codPerfil' => urlencode(serialize(0)));
    $view = $this->getPath()."/View/Seguranca/".str_replace("Controller", "View", get_class($this)).".php";
    echo ($this->gen_redirect_and_form($view, $params));    
    
  }

  function ListarUsuario(){
    $model = new UsuarioModel();
    echo $model->ListarUsuario();
  }

  function AddUsuario(){
    $UsuarioModel = new UsuarioModel();
    echo $UsuarioModel->AddUsuario();
    
  }
  function UpdateUsuario(){
    $UsuarioModel = new UsuarioModel();
    echo $UsuarioModel->UpdateUsuario();

  }

  function DeleteUsuario(){
      
    $UsuarioModel = new UsuarioModel();
    echo $UsuarioModel->UpdateUsuario();

  }
  
  function AddLogin(){
      
    $UsuarioModel = new UsuarioModel();
    echo $UsuarioModel->AddLogin();

  }

  Public Function ReiniciarSenha(){
      $UsuarioModel = new UsuarioModel();
      echo $UsuarioModel->ReiniciarSenha();
  }

    Public Function ResetaSenha(){
        $UsuarioModel = new UsuarioModel();
        echo $UsuarioModel->ResetaSenha();
    }  
}
$UsuarioController = new UsuarioController();
?>