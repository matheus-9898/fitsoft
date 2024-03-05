<?php 
    //excluindo aluno
    if(isset($_GET['excluirAluno'])){
        alunos::excluirAluno();
    }

    //pegando todos alunos
    $info = alunos::pegandoAlunos();

    //pegando dados do aluno para editar
    if(isset($_GET['editarAluno'])){
        $infoEdit = alunos::pegandoDadosAlunoEditar();
    }

    if(isset($_POST['acao'])){
        
        if(isset($_GET['editarAluno'])){
            
            //editando aluno
            alunos::editandoAluno();
        }else{
    
            //cadastrando alunos
            alunos::cadastrandoAluno();
        }

        header('Location:'.PATH_PAINEL.'?alunos');
    }

    //pegando todas unidades
    $infoUnidades = alunos::pegandoUnidades();

?>

<div class="contConteudoGeral" id="contAlunos">

    <div id="contFormAlunos">
        <form action="" method="post" autocomplete="off">
            <div>
                <label for="nomeAluno">Nome:</label>
                <input autocomplete="off" type="text" name="nome" id="nomeAluno" required value="<?php 
                    if(isset($_GET['editarAluno'])){
                        echo $infoEdit[0]['nome'];
                    }
                ?>">
            </div>
            <div>
                <label for="emailAluno">Email:</label>
                <input type="email" name="email" id="emailAluno" required value="<?php 
                    if(isset($_GET['editarAluno'])){
                        echo $infoEdit[0]['email'];
                    }
                ?>">
            </div>
            <div>
                <label for="telAluno">Telefone:</label>
                <input type="tel" name="telefone" id="telAluno" required value="<?php 
                    if(isset($_GET['editarAluno'])){
                        echo $infoEdit[0]['telefone'];
                    }
                ?>">
            </div>
            <div>
                <label for="nascAluno">Data de nascimento:</label>
                <input type="date" name="nascimento" id="nascAluno" required value="<?php 
                    if(isset($_GET['editarAluno'])){
                        echo $infoEdit[0]['nascimento'];
                    }
                ?>">
            </div>
            <div>
                <label for="sexo">Sexo:</label>
                <select name="sexo" id="sexo">
                    <option value="Masculino" <?php if(isset($_GET['editarAluno']) && $infoEdit[0]['sexo'] == 'Masculino'){echo 'selected';} ?> >Masculino</option>
                    <option value="Feminino" <?php if(isset($_GET['editarAluno']) && $infoEdit[0]['sexo'] == 'Feminino'){echo 'selected';} ?> >Feminino</option>
                </select>
            </div>
            <div>
                <label for="unidade">Unidade:</label>
                <select name="unidade" id="unidade">

                    <?php foreach ($infoUnidades as $key => $value) { ?>
                        <!-- lista todas as unidades verificando se o id da unidade corresponde a coluna id_unidade da tabela alunos -->
                        <option value="<?= $value['id'] ?>" <?php if(isset($_GET['editarAluno'])){ echo ($infoEdit[0]['id_unidade'] == $value['id']) ? 'selected' : ''; } ?>>
                            <?= $value['nome'] ?>
                        </option>

                    <?php } ?>

                </select>
            </div>
            <div class="areaBt">
                <input type="submit" value="Cadastrar" name="acao">
                <a href="<?= PATH_PAINEL ?>?alunos">Cancelar</a>
            </div>
        </form>
    </div>

    <div id="cadastrarAluno">
        <img class="ico" src="../imagens/ico-mais-bold-azul.png" alt="Cadastrar">
        Cadastrar aluno
    </div>
    <div id="contTodosAlunos">
        <div class="tableWrapper">

            <?php 
                if(count($info) == 0){
            ?>
                <div id="avisoAlunos">Nenhum aluno cadastrado.</div>
            <?php
                }else{
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Unidade</th>
                            <th>Cadastrado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ArrayReverse = array_reverse($info);
                        foreach ($ArrayReverse as $key => $value) { ?>
                            <tr>
                                <td><?= $value['nome'] ?></td>
                                <td>
                                    <?php foreach ($infoUnidades as $key => $valueUnd) {
                                        
                                        if($value['id_unidade'] == $valueUnd['id']){
                                            echo $valueUnd['nome'];
                                        }
                                    } ?>
                                </td>
                                <td><?php
                                $dataObj = DateTime::createFromFormat('Y-m-d', $value['momento_cadastro']);
                                $date = $dataObj->format('d/m/Y');
                                echo $date;
                                ?></td>
                                <td>
                                    <a href="<?= PATH_PAINEL ?>?alunos&editarAluno=<?= $value['id']; ?>" title="Editar"><img class="ico" src="../imagens/ico-edit-azul.png" alt="Editar"></a>

                                    <a href="<?= PATH_PAINEL ?>?alunos&excluirAluno=<?= $value['id']; ?>" title="Excluir"><img src="../imagens/ico-remove-vermelho.png" alt="Excluir" class="ico"></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php
                }
            ?>
        </div>
    </div>
</div>