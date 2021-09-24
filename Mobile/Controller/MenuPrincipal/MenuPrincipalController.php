<?php
include_once("Controller/BaseController.php");
class MenuPrincipalController extends BaseController

{
    Public Function ChamaView(){
        $params = array();        
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));        
    }
}
?>