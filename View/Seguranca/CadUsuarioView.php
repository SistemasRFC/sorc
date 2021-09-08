<form name="CadastroForm" method="post" action="Controller/Seguranca/UsuarioController.php">
    <input type="hidden" id="method" name="method">
    <input type="hidden" id="codUsuario" name="codUsuario">
    <table>
        <tr>
            <td>
                Login
            </td>
            <td><input type="text" id="nmeLogin" name="nmeLogin" size="60"></td>
        </tr>
        <tr>
            <td>
                Nome
            </td>
            <td><input type="text" id="nmeUsuario" name="nmeUsuario" size="60"></td>
        </tr>
        <tr>
            <td>
                Email
            </td>
            <td><input type="text" id="txtEmail" name="txtEmail" size="60"></td>
        </tr>
        <?php if ($rs_usuario[1][0]["COD_PERFIL"]==1){?>
            <tr>
                <td>Perfil</td>
                <td class="styleTD1" style="text-align:left;">
                    <div id="codPerfil"></div>
                </td>
            </tr>      
        <?php }?>
        <tr>
            <td>Cliente</td>
            <td class="styleTD1" style="text-align:left;">
                <div id="codCliente"></div>
            </td>
        </tr>
        <tr>
            <td><div id="indAtivo"> Ativo</div></td>
        </tr> 
    </table>
    <table>
        <tr>
            <td>
                <input type="button" id="btnSalvar" value="Salvar">
            </td>
            <td>
                <input type="button" id="btnReiniciarSenha" value="Reiniciar Senha">
            </td>            
        </tr>
    </table>
</form>