<?php
include_once("BaseDao.php");
class ControleContasDao extends BaseDao
{
  function ControleContasDao(){
  }
    /**
   *Classe de persistência ao banco de dados que faz a consulta das contas de bancos 
   */  
  function CarregaContas(){    
    $sql_localiza = "
    SELECT COD_CONTA,
            NME_BANCO,
            NRO_CONTA
        FROM EN_CONTA";
    $result = $this->selectDB($sql_localiza);
    $menu = "<form name='ControleContasForm' method='post'>
            <table>
            <tr>
                <td>
                <a href=\"#\" id=\"dialog-link\" class=\"ui-state-default ui-corner-all\"><span class=\"ui-icon ui-icon-newwin\"></span>Novo</a>
                </td>
            </tr>
            </table>
            <table>
            <tr>
                <td>C&oacute;digo</td>
                <td>Banco</td>
                <td>Conta</td>
            </tr>";    
    if (!empty($result)){
        $dscMenu=$result[0]['DSC_MENU_W'];

        $result = $this->selectDB($sql_localiza);
        foreach ($result as $item) {        
            $menu .= "<tr><td>".$item['COD_CONTA']."</td>";         
            $menu .= "<td>".$item['NME_BANCO']."</td>";
            $menu .= "<td>".$item['NRO_CONTA']."</td></tr>";
        } 
    }    

    return $menu."</table>
                  </form>";
  }
}
?>