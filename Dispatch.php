<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
// ob_start();
// ini_set('display_errors', true);
// error_reporting(E_ALL & ~E_WARNING & ~E_DEPRECATED & ~E_NOTICE);

class Dispatch
{

    public function __construct()
    {
        if (!isset($_SESSION)) {
            ob_start();
            session_start();
        }
        $this->RedirecionaController();
    }

    public function RedirecionaController()
    {
        $controller = static::getController();
        // var_dump( explode('/', $raizController)); die;
        // $arquivoController = explode('/', $raizController)[1];
        // $controller = explode('.', $arquivoController)[0];
        $method = static::getMethod();
        include_once $this->getPathController($controller);
        if (method_exists($controller . 'Controller', $method)) {
            if (BaseModel::VerificaPermissao($controller, $method)) {
                if (BaseModel::PermissaoMetodoUsuario($controller, $method)) {
                    $controller = $controller . 'Controller';
                    $controllerInstance = new $controller();
                    $controllerInstance->$method();
                } else {
                    $result[0] = false;
                    $result[1]['mensagem'] = "Você não tem permissão para acessar esta área!";
                    echo json_encode($result);
                }
            } else {
                $controller = $controller . 'Controller';
                $controllerInstance = new $controller();
                $controllerInstance->$method();
            }
        } else {
            echo json_encode(array(false, "O método '" . static::getMethod() . "', não pertence a classe '" . static::getController() . "'"));
        }
    }

    /**
     * Retorna o method passado por parâmetro via get ou post
     * @return String
     */
    public static function getMethod()
    {
        if (!filter_input(INPUT_POST, 'method')) {
            return filter_input(INPUT_GET, 'method');
        } else {
            return filter_input(INPUT_POST, 'method');
        }
    }

    /**
     * Retorna o method passado por parâmetro via get ou post
     * @return String
     */
    public static function getController()
    {
        if (!filter_input(INPUT_POST, 'controller')) {
            return filter_input(INPUT_GET, 'controller');
        } else {
            return filter_input(INPUT_POST, 'controller');
        }
    }

    public static function getPathController($controller)
    {
        // return 'Controller/' . $controller;
        return 'Controller/' . $controller . '/' . $controller . 'Controller.php';
    }
}

$Dispatch = new Dispatch();
