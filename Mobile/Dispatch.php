<?php
ob_start();
ini_set('display_errors', true);
error_reporting(E_ALL & ~E_WARNING & ~ E_DEPRECATED);
include_once 'constantes.php';

class Dispatch{
    
    Public Function __construct() {
        if (!isset($_SESSION)){
            ob_start();
            session_start();
//            var_dump($_SESSION); die;
        }
        $this->RedirecionaController();
    }

    Public Function RedirecionaController(){
        $controller = static::getController();
        $method = static::getMethod();
        include_once $this->getPathController($controller);
        if (method_exists($controller.'Controller',$method)){
            if (static::VerificaPermissao()){
                if (BaseModel::PermissaoMetodoUsuario($controller,$method)){
                    $controller = $controller.'Controller';
                    $controllerInstance = new $controller();
                    $controllerInstance->$method();
                }else{
                    echo json_encode(array(false, "Você não tem permissão para acessar esta área!"));
                }
            }else{
                $controller = $controller.'Controller';
                $controllerInstance = new $controller();
                $controllerInstance->$method();               
            }
        }else{
            echo json_encode(array(false, "O método '".static::getMethod()."', não pertence a classe '".static::getController()."'")); 
        }         
    }
    
    /**
     * Retorna o method passado por par�metro via get ou post
     * @return String
     */
    Public Static Function getMethod() {
        if (!filter_input(INPUT_POST, 'method')) {
            return filter_input(INPUT_GET, 'method');
        } else {
            return filter_input(INPUT_POST, 'method');
        }
    }

    /**
     * Retorna o method passado por par�metro via get ou post
     * @return String
     */
    Public Static Function getController() {
        if (!filter_input(INPUT_POST, 'controller')) {
            return filter_input(INPUT_GET, 'controller');
        } else {
            return filter_input(INPUT_POST, 'controller');
        }
    }
    
    Public Static Function getPathController($controller){
        return 'Controller/'.$controller.'/'.$controller.'Controller.php';
    }
    
    Public Static Function VerificaPermissao(){
        if (filter_input(INPUT_POST, 'verificaPermissao')=='N') {
            return false;
        } else if (filter_input(INPUT_GET, 'verificaPermissao')=='N') {
            return false;
        }else{
            return true;
        }
        
    }
}

$Dispatch = new Dispatch();