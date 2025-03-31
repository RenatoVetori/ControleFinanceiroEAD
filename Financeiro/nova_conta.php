<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/novacontaDAO.php';

if (isset($_POST['btngravar'])) {
    $nome = $_POST['nome'];
    $agencia = $_POST['agencia'];
    $numero = $_POST['numero'];
    $saldo = $_POST['saldo'];

    $objdao = new NovacontaDAO();

    $ret = $objdao->NovaConta($nome, $agencia, $numero, $saldo);
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
                        <?php include_once '_msg.php'; ?>
                        <h2>Nova conta</h2>
                        <h5>Aqui Você podera cadastrar todas as suas contas. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form method="post" action="nova_conta.php">
                    <div class="form-group">
                        <label>Nome do banco*</label>
                        <input class="form-control" name="nome" id="banco" placeholder="Digite o nome do banco." />
                    </div>
                    <div class="form-group">
                        <label>Agência*</label>
                        <input class="form-control" name="agencia" id="agencia" placeholder="Digite o número da agência" />
                    </div>
                    <div class="form-group">
                        <label>Número da conta*</label>
                        <input class="form-control" name="numero" id="numero" placeholder="Digite o número da conta" />
                    </div>
                    <div class="form-group">
                        <label>Saldo*</label>
                        <input class="form-control" name="saldo" id="saldo" placeholder="Digite o saldo da conta" />
                    </div>
                    <button type="submit" name="btngravar" onclick="return ValidarConta()" class="btn btn-success">Gravar</button>

                </form>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

</body>

</html>