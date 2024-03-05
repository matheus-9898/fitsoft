<nav>
    <ul>
        <a href="<?= PATH_PAINEL ?>?lancamentos" class="guiaActive">Lançamentos</a>
        <a href="<?= PATH_PAINEL ?>?analise">Análise</a>
    </ul>
</nav>

<div class="contConteudoGeral" id="contLancamentosFinanc">

    <div id="contFormLancamentoFinanc">
        <form action="" method="post" autocomplete="off">


            <div class="areaBt">
                <input type="submit" value="Registrar" name="acao">
                <a href="<?= PATH_PAINEL ?>?lancamentos">Cancelar</a>
            </div>
        </form>
    </div>

    <div id="registrarLancamento">
        <img class="ico" src="../imagens/ico-mais-bold-azul.png" alt="Cadastrar">
        Registrar lançamento
    </div>
</div>