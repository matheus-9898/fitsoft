<?php

    if(isset($_GET['remover-foto'])){
        painel::removerFotoPerfil();
        header('Location:'.PATH_PAINEL.'?meu-perfil');
    }

    if(isset($_POST['acao'])){
        painel::alterarDadosPerfil();
        header('Location:'.PATH_PAINEL.'?meu-perfil');
    }

    $info = painel::pegarDadosPerfil();
?>

<div class="contConteudoGeral" id="contConteudoMeuPerfil">
    <form action="" method="post" enctype="multipart/form-data">
        <div id="linha1">
            <div id="contEditFoto">
                <div id="contImg">
                    <img src="<?php
                    
                    if($_SESSION['foto'] == '')
                        echo '../imagens/ico-fotoperfil.png';
                    else
                        echo '../uploads/foto-perfil/'.$_SESSION['foto'];
                    
                    
                    ?>" alt="Perfil">
                </div>
                <div id="contBtsFotoPerfil">
                    <label for="imagem" id="InpImg"><img class="icoMenu" src="../imagens/ico-editimagem-azul.png" alt="Editar imagem"></label>
                    <input type="file" name="imagem" id="imagem" style="display: none;">
                    <a href="<?= PATH_PAINEL ?>?meu-perfil&remover-foto"><img src="../imagens/ico-removerimagem.png" alt="Remover foto" class="ico"></a>
                </div>
            </div>
            <div id="contEditInfo">
                <div>
                    <img class="ico edit-trigger" src="../imagens/ico-edit-azul.png" alt="Editar">
                    <input type="text" name="nome" required value="<?= $info[0]['nome'] ?>" class="editable-input" readonly>
                </div>
                <div>
                    <img class="ico edit-trigger" src="../imagens/ico-edit-azul.png" alt="Editar">
                    <input type="email" name="email" required value="<?= $info[0]['email'] ?>" class="editable-input" readonly>
                </div>
                <div>
                    <img class="ico edit-trigger" src="../imagens/ico-edit-azul.png" alt="Editar">
                    <input type="tel" name="telefone" required value="<?= $info[0]['telefone'] ?>" class="editable-input" readonly>
                </div>
                <div>
                    <img class="ico edit-trigger" src="../imagens/ico-edit-azul.png" alt="Editar">
                    <input type="password" name="senha" required value="<?= $info[0]['senha'] ?>" class="editable-input" readonly>
                </div>
            </div>
        </div>
        <div id="linha2">
            <input type="submit" name="acao" value="Salvar">
            <a href="<?= PATH_PAINEL ?>?meu-perfil">Cancelar</a>
        </div>
    </form>
</div>