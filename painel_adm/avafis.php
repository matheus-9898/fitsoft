<?php
    //excluindo aluno
    if(isset($_GET['excluirAluno'])){

        $sql = mysql::conexaoBD()->prepare('DELETE FROM alunos WHERE id=?');
    
        $sql->execute(array($_GET['excluirAluno']));

        header('Location:'.PATH_PAINEL.'?alunos');
    }

    //listando todos alunos
    $sql = mysql::conexaoBD()->prepare('SELECT * FROM alunos');

    $sql->execute();

    $info = $sql->fetchAll(PDO::FETCH_ASSOC);

    //pegando dados do aluno para editar
    if(isset($_GET['editarAluno'])){
        $sql = mysql::conexaoBD()->prepare('SELECT * FROM alunos WHERE id=?');

        $sql->execute(array($_GET['editarAluno']));
    
        $infoEdit = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    if(isset($_POST['acao'])){
        
        if(isset($_GET['editarAluno'])){
            
            //editando aluno
            $sql = mysql::conexaoBD()->prepare('UPDATE alunos SET nome=?,email=?,telefone=?,nascimento=? WHERE id=?');
    
            $sql->execute(array($_POST['nome'],$_POST['email'],$_POST['telefone'],$_POST['nascimento'],$_GET['editarAluno']));
        }else{
    
            //cadastrando alunos
            $sql = mysql::conexaoBD()->prepare('INSERT INTO alunos VALUES (null,?,?,?,?,?)');
    
            $sql->execute(array($_POST['nome'],$_POST['email'],$_POST['telefone'],$_POST['nascimento'],date('Y-m-d')));
        }

        header('Location:'.PATH_PAINEL.'?alunos');
    }

?>

<div class="contConteudoGeral" id="contAvaFis">

    <div id="contFormAvafis">
        <form action="" method="post" autocomplete="off">
            <h3>Avaliação Física: <span>Matheus Machado</span></h3>
            <div id="contAnamnese">
                <h4>Anamnese</h4>
                <div id="contPerguntas">
                    <div class="itemPergunta">
                        <p>Pratica atividade física quantas vezes na semana?</p>
                        <div>
                            <select name="resp1" class="respostaAnamnese" id="nivelAF">
                                <option value="1.2">Não pratica (sedentário)</option>
                                <option value="1.375">De 1 a 3 vezes (leve)</option>
                                <option value="1.55">De 4 a 5 vezes (moderado)</option>
                                <option value="1.725">De 6 a 7 vezes (ativo)</option>
                                <option value="1.9">Mais de 7 vezes (muito ativo)</option>
                            </select>
                            <input type="text" name="resp2" placeholder="Informação livre (opcional)">
                        </div>
                    </div>
                    <?php
                        $perg[]='Possui dores ou lesões em alguma parte do corpo?';
                        $perg[]='Já fez alguma cirurgia?';
                        $perg[]='Possui algum problema cardíaco?';
                        $perg[]='É fumante?';
                        $perg[]='Possui algum problema respiratório ou pulmonar?';
                        $perg[]='Possui diabetes?';
                        $perg[]='Possui problema de pressão?';
                        $perg[]='Possui colesterol alto?';
                        $perg[]='Possui algum problema muscular?';
                        $perg[]='Considera ter uma alimentação saudável?';
                        $perg[]='Possui algum problema ósseo?';
                        $perg[]='Possui algum problema ortopédico?';
                        $perg[]='Possui algum problema articular?';
                        $perg[]='Já sentiu algum desconforto ao fazer força?';
                        $perg[]='Sofre com tonturas, enjoos ou desmaios?';
                        $perg[]='Faz uso de algum medicamento?';
                        $perg[]='Possui alguma doença da tireóide, dos rins ou fígado?';
                        $perg[]='Está gravida?';
                        for ($i=0; $i < count($perg); $i++) {
                    ?>
                        <div class="itemPergunta">
                            <p><?= $perg[$i] ?></p>
                            <div>
                                <select name="resp1" class="respostaAnamnese">
                                    <option value="não">Não</option>
                                    <option value="sim">Sim</option>
                                </select>
                                <input type="text" name="resp2" placeholder="Informação livre (opcional)">
                            </div>
                        </div>
                    <?php } ?>
                    <div class="itemPergunta">
                        <p>Objetivo:</p>
                        <div>
                            <select name="resp1" class="respostaAnamnese">
                                <option value="emagrecer">Emagrecer</option>
                                <option value="hipertrofia">Hipertrofia</option>
                                <option value="lazer">Lazer</option>
                                <option value="definição muscular">Definição muscular</option>
                                <option value="competição">Competição</option>
                                <option value="terapia">Terapia</option>
                                <option value="saúde">Saúde</option>
                                <option value="condicionamento">Condicionamento</option>
                            </select>
                        </div>
                    </div>
                    <div class="itemPergunta">
                        <p>Pressão arterial:</p>
                        <div style="align-items: end;">
                            <input type="text" name="resp1" style="display: inline-block; min-width:100px; font-size: 14px !important; flex: 0;">
                            <span style="font-size: 14px;">mmHg</span>
                        </div>
                    </div>
                </div>
                <p>Anotações:</p>
                <textarea name="anotacoes" placeholder="Insira as informações que achar relevante. (opcional)"></textarea>
            </div><!-- contAnamnese -->
            
            <div id="contCCPer">
                <h4 style="margin-bottom: 0px;">Composição corporal e perimetria</h4>
                <div id="btLegendaAvaFis">
                Legenda
                <img src="../imagens/ico-info.png" alt="Informação" class="icoInfo">
                <div id="contLegendaAvaFis">
                    <div>
                        <hr style="border: 2px solid var(--corAbaixo);">
                        Abaixo do nível saudável
                    </div>
                    <div>
                        <hr style="border: 2px solid var(--corSaudavel);">
                        Saudável
                    </div>
                    <div>
                        <hr style="border: 2px solid var(--corAcima);">
                        Acima do nível saudável
                    </div>
                    <div>
                        <hr style="border: 2px solid var(--corMtAcima);">
                        Muito acima do nível saudável
                    </div>
                    <div>
                        <hr style="border: 2px solid var(--corExtAcima);">
                        Extremamente acima do nível saudável
                    </div>
                </div>
            </div>
                <div id="div1">
                    <div id="div1a">
                        <div id="contIdadeSexo">
                            <div>
                                <label for="idade">Idade:</label>
                                <input type="text" name="idade" id="idade" readonly class="inputPreencAuto" value="24 anos">
                            </div>
                            <div>
                                <label for="sexo">Sexo:</label>
                                <input type="text" name="sexo" id="sexo" readonly class="inputPreencAuto" value="Feminino">
                            </div>
                        </div>
                        <div id="contImcIac">
                            <h5>Informações gerais</h5>
                            <div>
                                <div>
                                    <div>
                                        <label for="massa">Massa:</label>
                                        <div>
                                            <input type="number" name="massa" id="massa" min="0">
                                            <span>kg</span>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="altura">Altura:</label>
                                        <div>
                                            <input type="number" name="altura" id="altura" min="0" >
                                            <span>cm</span>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="quadril1">Quadril:</label>
                                        <div>
                                            <input type="number" id="quadril1" min="0" >
                                            <span>cm</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <label for="imc">IMC<img src="../imagens/ico-info.png" alt="Informação" class="icoInfo" id="infoImc"></label>
                                        <div>
                                            <input type="number" name="imc" id="imc" readonly class="inputPreencAuto">
                                            <span>kg/m²</span>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="iac">IAC<img src="../imagens/ico-info.png" alt="Informação" class="icoInfo" id="infoIac"></label>
                                        <div>
                                            <input type="number" name="iac" id="iac" readonly class="inputPreencAuto">
                                            <span>%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="contDobras">
                            <h5>Dobras cutâneas</h5>
                            <div id="contProtocolo">
                                <label for="protocolo">Protocolo:</label>
                                <select name="protocolo" id="protocolo">
                                    <option value="1">1- Jackson, Pollock e Ward (1978 e 1980) - 7 dobras</option>
                                    <option value="2">2- Jackson, Pollock e Ward (1978 e 1980) - 3 dobras</option>
                                    <option value="3">3- Petroski (1995) - 4 dobras</option>
                                    <option value="4">4- Guedes (1985) - 3 dobras</option>
                                    <option value="5">5- Guedes (1994) - 3 dobras</option>
                                    <option value="6">6- Faulkner (1968) - 4 dobras</option>
                                    <option value="7">7- Durnin e Womersley (1974) - 4 dobras</option>
                                    <option value="8">8- Lean et al. (1996) - 4 dobras</option>
                                    <option value="9">9- Thorland (1984) - 7 dobras</option>
                                    <option value="10">10- Thorland (1984) - 3 dobras</option>
                                    <option value="11">11- Wetman et al. (1988) - Pessoas Obesas</option>
                                </select>
                            </div>
                            <table>
                                <tr>
                                    <th></th>
                                    <th>1ª amostra</th>
                                    <th>2ª amostra</th>
                                    <th>3ª amostra</th>
                                    <th>Média</th>
                                </tr>
                                <tr id="linhaTriceps">
                                    <td>Tríceps</td>
                                    <td><input type="number" min="0" class="amostraTriceps"></td>
                                    <td><input type="number" min="0" class="amostraTriceps" ></td>
                                    <td><input type="number" min="0" class="amostraTriceps" ></td>
                                    <td>
                                        <div>
                                            <input type="number" name="mediaTriceps" readonly class="inputPreencAuto" id="mediaTriceps">
                                            <span>mm</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="linhaBiceps">
                                    <td>Bíceps</td>
                                    <td><input type="number" min="0" class="amostraBiceps"></td>
                                    <td><input type="number" min="0" class="amostraBiceps"></td>
                                    <td><input type="number" min="0" class="amostraBiceps"></td>
                                    <td>
                                        <div>
                                            <input type="number" name="mediaBiceps" readonly class="inputPreencAuto" id="mediaBiceps">
                                            <span>mm</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="linhaSubescapular">
                                    <td>Subescapular</td>
                                    <td><input type="number" min="0" class="amostraSubescapular"></td>
                                    <td><input type="number" min="0" class="amostraSubescapular"></td>
                                    <td><input type="number" min="0" class="amostraSubescapular"></td>
                                    <td>
                                        <div>
                                            <input type="number" name="mediaSubescapular" readonly class="inputPreencAuto" id="mediaSubescapular">
                                            <span>mm</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="linhaPeitoral">
                                    <td>Peitoral</td>
                                    <td><input type="number" min="0" class="amostraPeitoral"></td>
                                    <td><input type="number" min="0" class="amostraPeitoral"></td>
                                    <td><input type="number" min="0" class="amostraPeitoral"></td>
                                    <td>
                                        <div>
                                            <input type="number" name="mediaPeitoral" readonly class="inputPreencAuto" id="mediaPeitoral">
                                            <span>mm</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="linhaAxiliarMedia">
                                    <td>Axiliar média</td>
                                    <td><input type="number" min="0" class="amostraAxiliarMedia"></td>
                                    <td><input type="number" min="0" class="amostraAxiliarMedia"></td>
                                    <td><input type="number" min="0" class="amostraAxiliarMedia"></td>
                                    <td>
                                        <div>
                                            <input type="number" name="mediaAxiliarMedia" readonly class="inputPreencAuto" id="mediaAxiliarMedia">
                                            <span>mm</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="linhaSuprailiaca">
                                    <td>Supra-ilíaca</td>
                                    <td><input type="number" min="0" class="amostraSuprailiaca"></td>
                                    <td><input type="number" min="0" class="amostraSuprailiaca"></td>
                                    <td><input type="number" min="0" class="amostraSuprailiaca"></td>
                                    <td>
                                        <div>
                                            <input type="number" name="mediaSuprailiaca" readonly class="inputPreencAuto" id="mediaSuprailiaca">
                                            <span>mm</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="linhaAbdomen">
                                    <td>Abdômen</td>
                                    <td><input type="number" min="0" class="amostraAbdomen"></td>
                                    <td><input type="number" min="0" class="amostraAbdomen"></td>
                                    <td><input type="number" min="0" class="amostraAbdomen"></td>
                                    <td>
                                        <div>
                                            <input type="number" name="mediaAbdomen" readonly class="inputPreencAuto" id="mediaAbdomen">
                                            <span>mm</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="linhaCoxa">
                                    <td>Coxa</td>
                                    <td><input type="number" min="0" class="amostraCoxa"></td>
                                    <td><input type="number" min="0" class="amostraCoxa"></td>
                                    <td><input type="number" min="0" class="amostraCoxa"></td>
                                    <td>
                                        <div>
                                            <input type="number" name="mediaCoxa" readonly class="inputPreencAuto" id="mediaCoxa">
                                            <span>mm</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="linhaPanturrilha">
                                    <td>Panturrilha</td>
                                    <td><input type="number" min="0" class="amostraPanturrilha"></td>
                                    <td><input type="number" min="0" class="amostraPanturrilha"></td>
                                    <td><input type="number" min="0" class="amostraPanturrilha"></td>
                                    <td>
                                        <div>
                                            <input type="number" name="mediaPanturrilha" readonly class="inputPreencAuto" id="mediaPanturrilha">
                                            <span>mm</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div id="div1b">
                        <h5>Perimetria</h5>
                        <div>
                            <div>
                                <label for="pescoco">Pescoço:</label>
                                <div>
                                    <input type="number" name="pescoco" id="pescoco" min="0" >
                                    <span>cm</span>
                                </div>
                            </div>
                            <div>
                                <label for="ombro">Ombro:</label>
                                <div>
                                    <input type="number" name="ombro" id="ombro" min="0" >
                                    <span>cm</span>
                                </div>
                            </div>
                            <div>
                                <label for="torax">Tórax:</label>
                                <div>
                                    <input type="number" name="torax" id="torax" min="0" >
                                    <span>cm</span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 20px; width: 100%;">
                                <div style="display: block; flex:1;">
                                    <label for="braEsqRel">Braço esquerdo (relaxado):</label>
                                    <div style="display: flex;">
                                        <input type="number" name="braEsqRel" id="braEsqRel" min="0" >
                                        <span>cm</span>
                                    </div>
                                </div>
                                <div style="display: block; flex:1;">
                                    <label for="braDirRel">Braço direito (relaxado):</label>
                                    <div style="display: flex;">
                                        <input type="number" name="braDirRel" id="braDirRel" min="0" >
                                        <span>cm</span>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex; gap: 20px; width: 100%;">
                                <div style="display: block; flex:1;">
                                    <label for="braEsqCont">Braço esquerdo (contraído):</label>
                                    <div style="display: flex;">
                                        <input type="number" name="braEsqCont" id="braEsqCont" min="0" >
                                        <span>cm</span>
                                    </div>
                                </div>
                                <div style="display: block; flex:1;">
                                    <label for="braDirCont">Braço direito (contraído):</label>
                                    <div style="display: flex;">
                                        <input type="number" name="braDirCont" id="braDirCont" min="0" >
                                        <span>cm</span>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex; gap: 20px; width: 100%;">
                                <div style="display: block; flex:1;">
                                    <label for="antebraEsq">Antebraço esquerdo:</label>
                                    <div style="display: flex;">
                                        <input type="number" name="antebraEsq" id="antebraEsq" min="0" >
                                        <span>cm</span>
                                    </div>
                                </div>
                                <div style="display: block; flex:1;">
                                    <label for="antebraDir">Antebraço direito:</label>
                                    <div style="display: flex;">
                                        <input type="number" name="antebraDir" id="antebraDir" min="0" >
                                        <span>cm</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="abdomen">Abdômen:</label>
                                <div>
                                    <input type="number" name="abdomen" id="abdomen" min="0" >
                                    <span>cm</span>
                                </div>
                            </div>
                            <div>
                                <label for="cintura">Cintura:</label>
                                <div>
                                    <input type="number" name="cintura" id="cintura" min="0" >
                                    <span>cm</span>
                                </div>
                            </div>
                            <div>
                                <label for="quadril2">Quadril:</label>
                                <div>
                                    <input type="number" name="quadril" id="quadril2" min="0" >
                                    <span>cm</span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 20px; width: 100%;">
                                <div style="display: block; flex:1;">
                                    <label for="coxaesq">Coxa esquerda:</label>
                                    <div style="display: flex;">
                                        <input type="number" name="coxaesq" id="coxaesq" min="0" >
                                        <span>cm</span>
                                    </div>
                                </div>
                                <div style="display: block; flex:1;">
                                    <label for="coxadir">Coxa direita:</label>
                                    <div style="display: flex;">
                                        <input type="number" name="coxadir" id="coxadir" min="0" >
                                        <span>cm</span>
                                    </div>
                                </div>
                            </div>
                            <div style="display: flex; gap: 20px; width: 100%;">
                                <div style="display: block; flex:1;">
                                    <label for="pantEsq">Panturrilha esquerda:</label>
                                    <div style="display: flex;">
                                        <input type="number" name="pantEsq" id="pantEsq" min="0" >
                                        <span>cm</span>
                                    </div>
                                </div>
                                <div style="display: block; flex:1;">
                                    <label for="pantdir">Panturrilha direita:</label>
                                    <div style="display: flex;">
                                        <input type="number" name="pantdir" id="pantdir" min="0" >
                                        <span>cm</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- div1 -->
                <div id="contCompCorp">
                    <h5>Composição corporal</h5>
                    <div>
                        <div>
                            <table>
                                <tr>
                                    <th></th>
                                    <th>Atual</th>
                                    <th>Alvo</th>
                                    <th>Ideal</th>
                                </tr>
                                <tr>
                                    <td>Massa total</td>
                                    <td>
                                        <div>
                                            <input type="number" name="massaAtual" id="massa2" readonly class="inputPreencAuto">
                                            <span>kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input type="number" name="massaAlvo" id="massaAlvo" readonly class="inputPreencAuto">
                                            <span>kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input type="text" name="massaIdeal" id="massaIdeal" readonly class="inputPreencAuto">
                                            <span>kg</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Percentual de gordura</td>
                                    <td>
                                        <div>
                                            <input type="number" name="percGorduraAtual" id="percGorduraAtual" readonly class="inputPreencAuto">
                                            <span>%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input type="number" name="percGorduraAlvo" id="percGorduraAlvo" style="background-color: white; border-color: var(--azul);">
                                            <span style="color: white; background-color: var(--azul);">%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input type="number" name="percGorduraIdeal" id="percGorduraIdeal" readonly class="inputPreencAuto">
                                            <span>%</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 100%;">
                                <tr>
                                    <th></th>
                                    <th>Atual</th>
                                    <th>Ideal</th>
                                </tr>
                                <tr>
                                    <td>Massa muscular</td>
                                    <td>
                                        <div>
                                            <input type="number" name="massaMuscAtual" id="massaMuscAtual" readonly class="inputPreencAuto" style="max-width: 67px;">
                                            <span>kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input type="number" name="massaMuscIdeal" id="massaMuscIdeal" readonly class="inputPreencAuto" style="max-width: 67px;">
                                            <span>kg</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div>
                            <table style="width: 100%;">
                                <tr>
                                    <th></th>
                                    <th>Atual</th>
                                    <th>Alvo</th>
                                </tr>
                                <tr>
                                    <td>Massa de gordura</td>
                                    <td>
                                        <div>
                                            <input type="number" name="massaGorduraAtual" id="massaGorduraAtual" readonly class="inputPreencAuto" style="max-width: 67px;">
                                            <span>kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <input type="number" name="massaGorduraAlvo" id="massaGorduraAlvo" readonly class="inputPreencAuto" style="max-width: 67px;">
                                            <span>%</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div>
                                <label for="taxaMetabBasal">Taxa metabólica basal (Harris Benedict, 1919)</label>
                                <input type="number" name="taxaMetabBasal" id="taxaMetabBasal" readonly class="inputPreencAuto">
                                <span>kcal</span>
                            </div>
                            <div>
                                <label for="gastoEnergTotal">Gasto energético total (OMS, 1985)</label>
                                <input type="number" name="gastoEnergTotal" id="gastoEnergTotal" readonly class="inputPreencAuto">
                                <span>kcal</span>
                            </div>
                        </div>
                    </div>
                </div><!-- contCompCorp -->
            </div><!-- contCCPer -->
            <div id="contCapFis">
                <h4>Capacidade Física</h4>
                <div id="contConteudoCapFis">
                    <div>
                        <div id="contForResMusc">
                            <h5>Força e resistência muscular</h5>
                            <div>
                                <div>
                                    <label for="repFlexao">Flexão (60s):</label>
                                    <div>
                                        <input type="number" name="repFlexao" id="repFlexao" min="0">
                                        <span>repetições</span>
                                    </div>
                                </div>
                                <div>
                                    <label for="repAbdominal">Abdominal (60s):</label>
                                    <div>
                                        <input type="number" name="repAbdominal" id="repAbdominal" min="0">
                                        <span>repetições</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div id="contFlexibilidade">
                            <h5>Flexibilidade</h5>
                            <label for="sentarAlcancar">Sentar e alcançar:</label>
                            <div>
                                <input type="number" name="sentarAlcancar" id="sentarAlcancar" min="0">
                                <span>repetições</span>
                            </div>
                        </div>
                        <div id="contCapAerob">
                            <h5>Capacidade aeróbica(Vo2)</h5>
                            <label for="distPerc">Distância percorrida:</label>
                            <div>
                                <input type="number" name="distPerc" id="distPerc" min="0">
                                <span>metros</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- contCapFis -->
            <div class="areaBt">
                <input type="submit" name="acao" value="Salvar">
                <a href="<?= PATH_PAINEL ?>?avaliacao-fisica">Cancelar</a>
            </div>
        </form>
    </div><!-- contFormAvafis -->

    <div id="cadastrarAvaFis">
        <img class="ico" src="../imagens/ico-mais-bold-azul.png" alt="Cadastrar">
        Nova avaliação física
    </div>
    <div id="contTodasAvafis">
        <div class="tableWrapper">

            <?php 
                if(count($info) == 0){
            ?>
                <div id="avisoAvaFis">Nenhuma avaliação física cadastrada.</div>
            <?php
                }else{
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>Aluno</th>
                            <th>Data</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ArrayReverse = array_reverse($info);
                        foreach ($ArrayReverse as $key => $value) { ?>
                            <tr>
                                <td><?= $value['nome'] ?></td>
                                <td><?php
                                $dataObj = DateTime::createFromFormat('Y-m-d', $value['momento_cadastro']);
                                $date = $dataObj->format('d/m/Y');
                                echo $date;
                                ?></td>
                                <td>
                                    <a href="<?= PATH_PAINEL ?>?alunos&editarAluno=<?= $value['id']; ?>"><img class="ico" src="../imagens/ico-edit-azul.png" alt="Editar"></a>

                                    <a href="<?= PATH_PAINEL ?>?alunos&excluirAluno=<?= $value['id']; ?>"><img src="../imagens/ico-remove-vermelho.png" alt="Excluir" class="ico"></a>
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