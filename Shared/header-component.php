<?php
if (!isset($_SESSION)) {
    ob_start();
    session_start();
}
if(!$_SESSION['cod_usuario']) {
    header('location: ../../index.php');
}
?>

<script>
    class Header extends HTMLElement {
        connectedCallback() {
            this.innerHTML = `
        <nav class="navbar bg-primary navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <a class="sidebar-brand d-flex align-items-center justify-content-center"
             href="../MenuPrincipal/MenuPrincipalView.php"
             style="color: #858796;font-weight: 700;width: 10rem;">

                <div class="sidebar-brand-icon">
                <!-- <img src="../../Resources/images/logoStudius/android-chrome-192x192.png" width='50' /> -->
                </div>
                
                <div class="sidebar-brand-text mx-1 text-white">SORC</div>
            </a>

            <div class="topbar-divider d-none d-sm-block"></div>

            <h5 class="text-white pt-2">SISTEMA DE FINANÇAS</h5>

            <div id="listaSumario" class="ml-3 p-1" style="width: 760px; border: 1px solid white;"></div>

            <ul class="navbar-nav ml-auto">
                <label class="pt-2 text-white"><?php echo $_SESSION['dadosUsuario']['NME_USUARIO_COMPLETO'] ?></label>
                <div class="topbar-divider d-none d-sm-block"></div>
    
                <li>
                    <a href="../../index.php" title="Sair">
                        <i class="fas fa-person-running text-white fa-2x"></i>
                    </a>
                </li>
            </ul>
        </nav>`;
        }
    }

    customElements.define('header-component', Header);
</script>