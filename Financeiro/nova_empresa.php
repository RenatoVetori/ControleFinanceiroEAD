<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/novaempresaDAO.php';

if (isset($_POST['btngravar'])) {
    $name = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $objdao = new NovaEmpresaDAO();

    $ret = $objdao->NovaEmpresa($name, $telefone, $endereco);
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
                        <h2>Nova empresa</h2>
                        <h5>Aqui Você podera cadastrar todas as suas empresas. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_empresa.php" method="post">
                    <div class="form-group">
                        <label>Nome da empresa*</label>
                        <input class="form-control" name="nome" id="nomeempresa" placeholder="Digite o nome da empresa." />
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input class="form-control" name="telefone" placeholder="Digite o telefone da empresa. (opcional)" />
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <input class="form-control" name="endereco" placeholder="Digite o Endereço da empresa. (opcional)" />
                    </div>
                    <button type="submit" name="btngravar" onclick="return ValidarEmpresa()" class="btn btn-success">Gravar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

</body>

</html>