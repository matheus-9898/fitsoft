<?php 
    if(stripos($_SERVER['PHP_SELF'],'painel.php') != false){
        str_replace('/painel.php','',$_SERVER['PHP_SELF']);
        header('Location:'.str_replace('/painel.php','',$_SERVER['PHP_SELF']));
        die();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitsof pro</title>
    <link rel="shortcut icon" href="../imagens/favicon.png" type="image/png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header id="contCab">
        <div id="contLogo">
            <img src="../imagens/logo2.png" alt="Logo">
            <img src="../imagens/meiologo.png" alt="Logo">
        </div>
        <div id="contBtMenuMobile"><img class="ico" src="../imagens/ico-menu.png" alt="Menu"></div>
        <div id="contTituloPag">
            <img class="ico" src="../imagens/<?php     

            //alterar ícone do cabeçalho
                if(isset($_GET['meu-perfil']))
                    echo 'ico-perfil2.png';
                else if(isset($_GET['unidades']) || isset($_GET['exercicios']) || isset($_GET['despesas']))
                    echo 'ico-config2.png';
                else if(isset($_GET['alunos']))
                    echo 'ico-alunos-azul.png';
                else if(isset($_GET['avaliacao-fisica']))
                    echo 'ico-avafis-azul.png';
                else if(isset($_GET['lancamentos']))
                    echo 'ico-financeiro-azul.png';
                else if(isset($_GET['analise']))
                    echo 'ico-financeiro-azul.png';
                else
                    echo 'ico-dash2.png';
            
            ?>" alt="Icone">
            <h1>
                <?php 
                //alterar título do cabeçalho
                    if(isset($_GET['meu-perfil']))
                        echo 'Meu Perfil';
                    else if(isset($_GET['unidades']) || isset($_GET['exercicios']) || isset($_GET['despesas']))
                        echo 'Configurações';
                    else if(isset($_GET['alunos']))
                        echo 'Alunos';
                    else if(isset($_GET['avaliacao-fisica']))
                        echo 'Avaliação física';
                    else if(isset($_GET['lancamentos']) || isset($_GET['analise']))
                        echo 'Financeiro';
                    else
                        echo 'Dashboard';
                ?>
            </h1>
        </div>
    </header>
    <main id="contPainel">
        <div id="fundoMenuMobile"></div>
        <div id="contMenuLateral">
            <div id="contListaMenu">
                <div id="contBtMenu"><img class="ico" src="../imagens/ico-menu.png" alt="Menu"></div>
                <nav id="contLista">
                    <ul>
                        <li><a href="<?= PATH_PAINEL ?>" title="Dashboard">
                            <img class="icoMenu" src="../imagens/ico-dash.png" alt="Icone">
                            <h2>Dashboard</h2>
                        </a></li>
                        <li><a href="<?= PATH_PAINEL ?>?lancamentos" title="Financeiro">
                            <img class="icoMenu" src="../imagens/ico-financeiro.png" alt="Icone">
                            <h2>Financeiro</h2>
                        </a></li>
                        <li><a href="<?= PATH_PAINEL ?>?avaliacao-fisica" title="Avaliação física">
                            <img class="icoMenu" src="../imagens/ico-avafis.png" alt="Icone">
                            <h2>Avaliação Física</h2>
                        </a></li>
                        <li><a href="<?= PATH_PAINEL ?>?alunos" title="Alunos">
                            <img class="icoMenu" src="../imagens/ico-alunos.png" alt="Icone">
                            <h2>Alunos</h2>
                        </a></li>
                        <li><a href="<?= PATH_PAINEL ?>?unidades" title="Configurações">
                            <img class="icoMenu" src="../imagens/ico-config.png" alt="Icone">
                            <h2>Configurações</h2>
                        </a></li>
                    </ul>
                </nav>
            </div>
            <div id="contPerfil">
                <div id="contImgPerfil">
                    <img src="<?php
                    
                    if($_SESSION['foto'] == '')
                        echo '../imagens/ico-fotoperfil.png';
                    else
                        echo '../uploads/foto-perfil/'.$_SESSION['foto'];
                    
                    
                    ?>" alt="Perfil">
                </div>
                <div id="contTxtPerfil">
                    <span><?php echo $_SESSION['nome']; ?></span>
                    <span>Administrador</span>
                </div>
                <div id="submenuPerfil">
                    <a href="<?= PATH_PAINEL ?>?meu-perfil">Meu Perfil</a>
                    <hr>
                    <a href="<?= PATH_PAINEL ?>?logout">Sair</a>
                </div>
            </div>
        </div>
        <div id="contPaginas">
            <?php
                painel::carregarPaginas();
            ?>
        </div>
    </main>
    <script src="../js/jquery.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>