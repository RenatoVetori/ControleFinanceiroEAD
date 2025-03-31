<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/novacontaDAO.php';

$dao = new NovaContaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idConta = $_GET['cod'];
    $dados = $dao->DetalharConta($idConta);

    if (count($dados) == 0) {
        header('location: consultar_conta.php');
        exit;
    }
} else if (isset($_POST['btnsalvar'])) {
    $idConta = $_POST['cod'];
    $banco = $_POST['banco'];
    $numero = $_POST['numero'];
    $agencia = $_POST['agencia'];
    $saldo =  $_POST['saldo'];

    $ret = $dao->AlterarConta( $banco, $agencia, $numero, $saldo, $idConta);

    header('location: consultar_conta.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnexcluir'])) {

    $idConta = $_POST['cod'];
    $ret = $dao->ExcluirConta($idConta);

    header('location: consultar_conta.php?ret=' . $ret);
    exit;
} else {

    header('location: consultar_conta.php');
    exit;
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Alterar conta</h2>
                        <h5>Aqui Você podera alterar as suas contas. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form method="post" action="alterar_conta.php">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_conta'] ?>">
                    <div class="form-group">
                        <label>Nome do banco*</label>
                        <input class="form-control" id="banco" name="banco" value="<?= $dados[0]['banco_conta'] ?> "placeholder=" Digite o nome do banco." />
                    </div>
                    <div class="form-group">
                        <label>Agência*</label>
                        <input class="form-control" id="agencia" name="agencia" value="<?= $dados[0]['agencia_conta'] ?> "placeholder=" Digite o número da agência" />
                    </div>
                    <div class="form-group">
                        <label>Número da conta</label>
                        <input class="form-control" id="numero" name="numero" value="<?= $dados[0]['numero_conta'] ?> "placeholder=" Digite o número da conta" />
                    </div>
                    <div class="form-group">
                        <label>Saldo*</label>
                        <input class="form-control" id="saldo" name="saldo" value="<?= $dados[0]['saldo_conta'] ?> "placeholder=" Digite o saldo da conta" />
                    </div>
                    <button type="submit" class="btn btn-success" name="btnsalvar" onclick="return ValidarConta()">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Excluir</button>

                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmacão de exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a Conta: <b><?= $dados[0]['banco_conta'] ?> / Agencia: <?= $dados[0]['agencia_conta']?> - Numero: <?= $dados[0]['numero_conta']?> ?</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" name="btnexcluir">Sim</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

</body>

</html>