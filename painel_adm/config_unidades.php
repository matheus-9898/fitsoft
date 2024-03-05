<?php

$modoEdicao = false;

if(isset($_GET['editar'])){
    //pegando dados da unidade para editar
    $modoEdicao = true;

    $idUnidadeEdit = $_GET['editar'];

    $sql = mysql::conexaoBD()->prepare('SELECT * FROM  unidades WHERE id=?');

    $sql->execute(array($idUnidadeEdit));

    $infoEditUnidade = $sql->fetchAll(PDO::FETCH_ASSOC);
}else{
    $modoEdicao = false;

    if(isset($_GET['remover'])){
        $sql = mysql::conexaoBD()->prepare('DELETE FROM servicos WHERE id_unidade=?');

        $sql->execute(array($_GET['remover']));

        $sql = mysql::conexaoBD()->prepare('DELETE FROM unidades WHERE id=?');

        $sql->execute(array($_GET['remover']));

        header('Location:'.PATH_PAINEL.'?unidades');
    }
}


if (isset($_POST['acao'])) {

    if($modoEdicao == true){
        //efetuando a edição
        $sql = mysql::conexaoBD()->prepare('UPDATE unidades SET nome=?,telefone=?,email=?,endereco=?,responsavel=?,senha=? WHERE id=?');
    
        $sql->execute(array($_POST['nomeUnidade'], $_POST['telUnidade'], $_POST['emailUnidade'], $_POST['endUnidade'], $_POST['responsavelContaUnidade'], $_POST['senhaContaUnidade'], $idUnidadeEdit));

        //editando também os serviços
        //deletando todos
        $sql = mysql::conexaoBD()->prepare('DELETE FROM servicos WHERE id_unidade = ?');
    
        $sql->execute(array($idUnidadeEdit));

        //readicionando todos
        $nomeServico = $_POST['nomeServico'];
        $valorServico = $_POST['valorServico'];
        $pagamento = $_POST['pagamento'];
        $recorrenciaPag = $_POST['recorrenciaPag'];
    
        $cont = count($nomeServico);
    
        for ($i = 0; $i < $cont; $i++) {
            $sql = mysql::conexaoBD()->prepare('INSERT INTO servicos VALUES (null,?,?,?,?,?)');

            if($pagamento[$i] == 'pagamento único'){
                $recorrenciaPag[$i] = 0;
            }
    
            $sql->execute(array($nomeServico[$i], $valorServico[$i], $pagamento[$i], $recorrenciaPag[$i], $idUnidadeEdit));
        }

        header('Location:'.PATH_PAINEL.'?unidades');

    }else{
        //adicionando unidade
        $sql = mysql::conexaoBD()->prepare('INSERT INTO unidades VALUES (null,?,?,?,?,?,?,?)');
    
        $sql->execute(array($_POST['nomeUnidade'], $_POST['telUnidade'], $_POST['emailUnidade'], $_POST['endUnidade'], $_POST['responsavelContaUnidade'], $_POST['senhaContaUnidade'], $_SESSION['id']));
    

        //adicionando serviços
        $idUnidade = mysql::conexaoBD()->lastInsertId();
    
        $nomeServico = $_POST['nomeServico'];
        $valorServico = $_POST['valorServico'];
        $pagamento = $_POST['pagamento'];
        $recorrenciaPag = $_POST['recorrenciaPag'];
    
        $cont = count($nomeServico);
    
        for ($i = 0; $i < $cont; $i++) {
            $sql = mysql::conexaoBD()->prepare('INSERT INTO servicos VALUES (null,?,?,?,?,?)');

            if($pagamento[$i] == 'pagamento único'){
                $recorrenciaPag[$i] = 0;
            }
    
            $sql->execute(array($nomeServico[$i], $valorServico[$i], $pagamento[$i], $recorrenciaPag[$i], $idUnidade));
        }
    }
}

?>

<nav>
    <ul>
        <a href="<?= PATH_PAINEL ?>?unidades" class="guiaActive">Unidades</a>
        <a href="<?= PATH_PAINEL ?>?exercicios">Exercícios</a>
        <a href="<?= PATH_PAINEL ?>?despesas">Despesas</a>
    </ul>
</nav>

<div class="contConteudoGeral" id="contUnidades">

    <div id="contFormUnidades">

        <form action="" method="post" autocomplete="off">
            <div>
                <div>
                    <label for="nomeUnidade">Nome da unidade:</label>
                    <input type="text" name="nomeUnidade" id="nomeUnidade" required value="<?php
                        if($modoEdicao == true){
                            echo $infoEditUnidade[0]['nome'];
                        }
                    ?>">
                </div>
                <div>
                    <label for="telUnidade">Telefone:</label>
                    <input type="tel" name="telUnidade" id="telUnidade" required value="<?php
                        if($modoEdicao == true){
                            echo $infoEditUnidade[0]['telefone'];
                        }
                    ?>">
                </div>
            </div>
            <div>
                <div>
                    <label for="endUnidade">Endereço:</label>
                    <input type="text" name="endUnidade" id="endUnidade" required value="<?php
                        if($modoEdicao == true){
                            echo $infoEditUnidade[0]['endereco'];
                        }
                    ?>">
                </div>
                <div>
                    <label for="emailUnidade">Email:</label>
                    <input type="email" name="emailUnidade" id="emailUnidade" required value="<?php
                        if($modoEdicao == true){
                            echo $infoEditUnidade[0]['email'];
                        }
                    ?>">
                </div>
            </div>

            <div id="areaServicos">
                <span id="infoServicosUnidade" title="Aqui será cadastrado todos os serviços prestados por essa unidade.">Serviços:<img src="../imagens/ico-info.png" alt="Informação" class="icoInfo"></span>
                <img class="ico" src="../imagens/ico-mais-bold-azul.png" alt="Adicionar">
                <div id="listaServicos">
                    <?php
                        if($modoEdicao == true){

                            //buscando todos os serviços relativo a unidade de id $idUnidadeEdit

                            $sqlEditServicos = mysql::conexaoBD()->prepare('SELECT * FROM servicos WHERE id_unidade=?');

                            $sqlEditServicos->execute(array($idUnidadeEdit));

                            $infoEditServicos = $sqlEditServicos->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($infoEditServicos as $key => $value) {
                    ?>

                        <div class="itemServico">
                                <div class="contInputsServicos">
                                    <input type="text" name="nomeServico[]" placeholder="Serviço (Ex: Musculação, Av. física, Boxe, etc)" required value="<?= $value['nome']; ?>">
                                    <input type="number" name="valorServico[]" placeholder="Valor" required value="<?= $value['preco']; ?>">
                                </div>
                            <select name="pagamento[]" class="pagamento">
                                <option value="pagamento único" <?php if($value['pagamento'] == 'pagamento único'){echo 'selected';} ?>>Pagamento único</option>
                                <option value="recorrente" <?php if($value['pagamento'] == 'recorrente'){echo 'selected';} ?>>Recorrente</option>
                            </select>
                            <select name="recorrenciaPag[]" class="recorrenciaPag">
                                <option value="1" <?php if($value['recorrencia_pagamento'] == '1'){echo 'selected';} ?>>A cada 1 mês</option>
                                <option value="2" <?php if($value['recorrencia_pagamento'] == '2'){echo 'selected';} ?>>A cada 2 meses</option>
                                <option value="3" <?php if($value['recorrencia_pagamento'] == '3'){echo 'selected';} ?>>A cada 3 meses</option>
                                <option value="4" <?php if($value['recorrencia_pagamento'] == '4'){echo 'selected';} ?>>A cada 4 meses</option>
                                <option value="5" <?php if($value['recorrencia_pagamento'] == '5'){echo 'selected';} ?>>A cada 5 meses</option>
                                <option value="6" <?php if($value['recorrencia_pagamento'] == '6'){echo 'selected';} ?>>A cada 6 meses</option>
                                <option value="7" <?php if($value['recorrencia_pagamento'] == '7'){echo 'selected';} ?>>A cada 7 meses</option>
                                <option value="8" <?php if($value['recorrencia_pagamento'] == '8'){echo 'selected';} ?>>A cada 8 meses</option>
                                <option value="9" <?php if($value['recorrencia_pagamento'] == '9'){echo 'selected';} ?>>A cada 9 meses</option>
                                <option value="10" <?php if($value['recorrencia_pagamento'] == '10'){echo 'selected';} ?>>A cada 10 meses</option>
                                <option value="11" <?php if($value['recorrencia_pagamento'] == '11'){echo 'selected';} ?>>A cada 11 meses</option>
                                <option value="12" <?php if($value['recorrencia_pagamento'] == '12'){echo 'selected';} ?>>A cada 12 meses</option>
                            </select>
                                <div class="contRemoverServico"><img src="../imagens/ico-remove-vermelho.png" alt="Remover" class="ico"></div>
                        </div>
                    <?php
                            }

                        }else{//se não estiver no modo edição
                    ?>

                        <div class="itemServico">
                            <div class="contInputsServicos">
                                <input type="text" name="nomeServico[]" placeholder="Serviço (Ex: Musculação, Av. física, Boxe, etc)" required>
                                <input type="number" name="valorServico[]" placeholder="Valor" required>
                            </div>
                            <select name="pagamento[]" class="pagamento">
                                <option value="pagamento único">Pagamento único</option>
                                <option value="recorrente">Recorrente</option>
                            </select>
                            <select name="recorrenciaPag[]" class="recorrenciaPag">
                                <option value="1">A cada 1 mês</option>
                                <option value="2">A cada 2 meses</option>
                                <option value="3">A cada 3 meses</option>
                                <option value="4">A cada 4 meses</option>
                                <option value="5">A cada 5 meses</option>
                                <option value="6">A cada 6 meses</option>
                                <option value="7">A cada 7 meses</option>
                                <option value="8">A cada 8 meses</option>
                                <option value="9">A cada 9 meses</option>
                                <option value="10">A cada 10 meses</option>
                                <option value="11">A cada 11 meses</option>
                                <option value="12">A cada 12 meses</option>
                            </select>
                            <div class="contRemoverServico"><img src="../imagens/ico-remove-vermelho.png" alt="Remover" class="ico"></div>
                        </div>
                    <?php
                        }
                    ?>

                </div>
            </div>

            <div id="areaConta">
                <span id="infoContaUnidade" title="Cada unidade terá uma conta individual. Os dados de todas as unidades só poderão ser acessados através da conta do administrador.">Dados da conta:<img src="../imagens/ico-info.png" alt="Informação" class="icoInfo"></span>
                <div>
                    <div>
                        <label for="senhaContaUnidade">Senha:</label>
                        <input type="password" name="senhaContaUnidade" id="senhaContaUnidade" required value="<?php
                        if($modoEdicao == true){
                            echo $infoEditUnidade[0]['senha'];
                        }
                    ?>">
                    </div>
                    <div>
                        <label for="responsavelContaUnidade">Responsável:</label>
                        <input type="text" name="responsavelContaUnidade" id="responsavelContaUnidade" required value="<?php
                        if($modoEdicao == true){
                            echo $infoEditUnidade[0]['responsavel'];
                        }
                    ?>">
                    </div>
                </div>
            </div>

            <div class="areaBt">
                <input type="submit" name="acao" value="Salvar">
                <a href="<?= PATH_PAINEL ?>?unidades">Cancelar</a>
            </div>
            <?php 
                if($modoEdicao == true){
            ?>
                    <a href="<?= PATH_PAINEL ?>?unidades&remover=<?= $idUnidadeEdit ?>">Remover unidade.</a>
            <?php 
                }
            ?>
        </form>
    </div>

    <?php 
    
        $sql = mysql::conexaoBD()->prepare('SELECT * FROM unidades WHERE id_usuario_adm=?');

        $sql->execute(array($_SESSION['id']));

        $info = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($info as $key => $value) {
    ?>

        <div class="itemUnidades">
            <div><?= $value['nome']; ?></div>
            <div>
                <a href="<?= PATH_PAINEL ?>?unidades&editar=<?= $value['id'] ?>">
                    <img src="../imagens/ico-edit.png" alt="Editar" class="ico">
                    <span>Editar</span>
                </a>
            </div>
        </div>

    <?php
        }
    ?>

    <div id="contAddUnidades">
        <img src="../imagens/ico-mais-bold-azul.png" alt="Adicionar" class="ico">
        <span>Adicionar</span>
    </div>
</div>