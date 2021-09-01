<?
if (!isset($_SESSION)){
    session_start();
} 
if (!isset($_SESSION['cod_usuario'])){
    header("Location:../index.php");
}
?>
<html>
<HEAD>
<TITLE>P&aacute;gina Principal</TITLE>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script language="JavaScript" type="text/JavaScript"></script>
    <script src="../Resources/js/mlddmenu2.25.js"></script>
    <script src="../Resources/js/mlddm.js"></script>
    <link href="../Resources/css/mlddmenu.css" rel="stylesheet" type="text/css">
    <link href="../../Resources/css/jquery-ui-1.10.0.custom.css" rel="stylesheet">
    <script src="../../Resources/js/jquery-1.9.0.js"></script>
    <script src="../../Resources/js/jquery-ui-1.10.0.custom.js"></script>
    <script src="../../Resources/js/jquery.maskedinput.js" type="text/javascript"></script>    
<script>
    $(function() {
             
        function ChamaView(Controller, method){
            $.post("'"+Controller+"'",
                {method:"'"+method+"'"}, function(data){
                    $("#view").html(data);
                        if(data==1){
                            $( "#dialogInformacao" ).html('Produto removido com sucesso!');
                            $( "#dialogInformacao" ).dialog( "open" );
                        }
                }
            );
    }
</script>    
</HEAD>
<BODY>
<form name="menuPrincipal" id="menuPrincipal" method="post">
<input type="hidden" name="horaInicial">

  <input type="hidden" name="data">
  <input type="hidden" name="habilita">
<table width="100%">
<!--tr>
  <td colspan="2"
      style="height:100px;">
    <img src="LogoMarca.jpg" width="800" height="200" border="0">
  </td>
</tr-->
<tr>
  <td>
  <table width="100%" align="left">
   <tr><td>
    <?echo "<pre>";
    //var_dump($_SESSION['menuPai']);
        $rs_localiza = $_SESSION['menuPai'];
        $total = count($rs_localiza);
        echo "<ul class=\"mlddm\">";
        for($i=0; $i<$total; $i++){
              
              echo "<li style=\"padding:0px;\"><a href=\"".$rs_localiza[$i]['NME_CONTROLLER']."?method=".$rs_localiza[$i]['NME_METHOD']."\">".$rs_localiza[$i]['DSC_MENU_W']."</a>";
              
              $rs_localiza_sub = $_SESSION['menuFilho'];
              $totalSub = count($rs_localiza_sub);
              /*echo "<pre>";
              var_dump($rs_localiza_sub);
              exit;*/
              If (empty($rs_localiza_sub)){
                  echo "</li>";
              }else{                  
                    
                    echo "<ul>";                        

                    for($j=0; $j<$totalSub; $j++){ 
                        $novoTotal = count($rs_localiza_sub[$j]);
                        for ($h=0; $h<$novoTotal; $h++){ 
                            if ($rs_localiza[$i]["COD_MENU_W"]==$rs_localiza_sub[$j][$h]["COD_MENU_PAI_W"]){
                                echo "<li><a href=\"".$rs_localiza_sub[$j][$h]['NME_CONTROLLER']."?method=".$rs_localiza_sub[$j][$h]['NME_METHOD']."\">".$rs_localiza_sub[$j][$h]['DSC_MENU_W']."</a></li>";
                            }
                        }
                    }
                    echo "</ul>";
                    echo "</li>";
                    
              }
          
        }
        echo "</ul>";
      ?>
    </td>
  </tr>
  </table>
  </td>
</tr>
</table>
  <div id="view">
  </div>
</form>
</BODY>
</HTML>