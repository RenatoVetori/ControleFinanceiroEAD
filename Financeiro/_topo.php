<?php
require_once '../DAO/UtilDAO.php';
?>

<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="inicial.php">Financeiro</a>
    </div>
    <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">Ola, <?= UtilDAO::NomeLogado() ?>. Duvidas ligue para: (43) 99112-6166</div>
</nav>