<nav>
    <ul>
        <a href="<?= PATH_PAINEL ?>?unidades">Unidades</a>
        <a href="<?= PATH_PAINEL ?>?exercicios">Exercícios</a>
        <a href="<?= PATH_PAINEL ?>?despesas" class="guiaActive">Despesas</a>
    </ul>
</nav>

<div class="contConteudoGeral" id="contDespesas">
    <div id="contAddDespesa">
        <input type="text" name="despesa">
        <input type="submit" value="Adicionar" name="acao">
    </div>
    <div id="listaDespesas">
        
    </div>
</div>