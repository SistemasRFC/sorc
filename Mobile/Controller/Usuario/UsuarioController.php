<?php
include_once("Controller/BaseController.php");
include_once("Model/Usuario/UsuarioModel.php");
class UsuarioController extends BaseController
{
  function ListarResponsavelFiltro() {
    $model = new UsuarioModel();
    echo $model->ListarResponsavelFiltro();
  }
}
$UsuarioController = new UsuarioController();
?>