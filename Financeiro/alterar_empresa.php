<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/novaempresaDAO.php';

$dao = new NovaEmpresaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idEmpresa = $_GET['cod'];
    $dados = $dao->DetalharEmpresa($idEmpresa);

    if (count($dados) == 0) {
        header('location: consultar_empresa.php');
        exit;
    }
} else if (isset($_POST['btngravar'])) {
    $idEmpresa = $_POST['cod'];
    $nomeempresa = $_POST['nomeempresa'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $ret = $dao->AlterarEmpresa($idEmpresa, $nomeempresa, $telefone, $endereco);

    header('location: consultar_empresa.php?ret=' . $ret);
} else if (isset($_POST['btnexcluir'])) {
    $idEmpresa = $_POST['cod'];

    $ret = $dao->ExcluirEmpresa($idEmpresa);

    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_empresa.php');
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
                        <?php include_once '_msg.php'; ?>
                        <h2>Alterar empresa</h2>
                        <h5>Aqui Você podera alterar todas as suas empresas. </h5>

                    </div>
                </div>
                <hr />
                <form method="post" action="alterar_empresa.php">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_empresa'] ?>">
                    <div class="form-group">
                        <label>Nome da empresa*</label>
                        <input class="form-control" placeholder="Digite o nome da empresa." name="nomeempresa" id="nomeempresa" value="<?= $dados[0]['nome_empresa'] ?> " />
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input class="form-control" placeholder="Digite o telefone da empresa. (opcional)" name="telefone" value="<?= $dados[0]['telefone_empresa'] ?> " />
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <input class="form-control" placeholder="Digite o Endereço da empresa. (opcional)" name="endereco" value="<?= $dados[0]['endereco_empresa'] ?>" />
                    </div>
                    <button type="submit" class="btn btn-success" name="btngravar" onclick="return ValidarEmpresa()">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Excluir</button>

                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmacão de exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a Empresa: <b><?= $dados[0]['nome_empresa'] ?> ?</b>
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