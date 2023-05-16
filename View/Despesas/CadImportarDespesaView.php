<script language="JavaScript" src="js/CadImportarDespesaView.js?<?php echo time(); ?>"></script>
<form name="CadastroForm" method="post">
    <input type="hidden" id="hdDtaDespesa">
    <table>
        <tr>
            <td>
                Descrição
            </td>
            <td><label id="lblDespesa" name="lblDespesa"></label></td>
        </tr>
        <tr>
            <td>
                Ano para importar
            </td>
            <td>            
                <div id="comboNroAnoReferenciaImportacao"></div>
                <select name="nroAnoReferenciaImportacao" id="nroAnoReferenciaImportacao" style="display:none">
                <?$result_receitas = unserialize(urldecode($_POST['ListaAnos']));
                $nroAnoReferencia = unserialize(urldecode($_POST['nroAnoReferencia']));
                for($i=0;$i<count($result_receitas);$i++){
                    if ($nroAnoReferencia==$result_receitas[$i]['NRO_ANO_REFERENCIA']){
                        echo "<option value=\"".$result_receitas[$i]['NRO_ANO_REFERENCIA']."\" selected=\"selected\">".$result_receitas[$i]['NRO_ANO_REFERENCIA']."</option>";
                    }else{
                        echo "<option value=\"".$result_receitas[$i]['NRO_ANO_REFERENCIA']."\">".$result_receitas[$i]['NRO_ANO_REFERENCIA']."</option>";
                    }
                }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                Ano para importar
            </td>
            <td>
                <div id="comboNroMesReferenciaImportacao"></div>
                <select name="nroMesReferenciaImportacao" id="nroMesReferenciaImportacao" style="display:none">
                <?$result_receitas = unserialize(urldecode($_POST['ListaMeses']));
                $nroMesReferencia = unserialize(urldecode($_POST['nroMesReferencia']));
                for($i=0;$i<count($result_receitas);$i++){
                    if ($nroMesReferencia==$result_receitas[$i]['NRO_MES_REFERENCIA']){
                        echo "<option value=\"".$result_receitas[$i]['NRO_MES_REFERENCIA']."\" selected=\"selected\">".$result_receitas[$i]['DSC_MES_REFERENCIA']."</option>";
                    }else{
                        echo "<option value=\"".$result_receitas[$i]['NRO_MES_REFERENCIA']."\">".$result_receitas[$i]['DSC_MES_REFERENCIA']."</option>";
                    }
                }
                ?>
                </select>
            </td>
        </tr>        
        <tr>
            <td>
                <input type="button" id="btnImportar" value="Importar">
            </td>
        </tr>
    </table>
</form>