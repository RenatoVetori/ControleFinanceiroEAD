<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/categoriaDAO.php';

$dao = new CategoriaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idCategoria = $_GET['cod'];

    $dados = $dao->DetalharCategoria($idCategoria);

    if (count($dados) == 0) {
        header('location: consultar_categoria.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {
    $idCategoria = $_POST['cod'];
    $nomecategoria = $_POST['nomecategoria'];

    $ret = $dao->AlterarCategoria($nomecategoria, $idCategoria);

    header('location: consultar_categoria.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {
    $idCategoria = $_POST['cod'];
    $ret = $dao->ExcluirCategoria($idCategoria);

    header('location: consultar_categoria.php?ret=' . $ret);
} else {
    header('location: consultar_categoria.php');
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
                        <h2>Alterar categorias</h2>
                        <h5>Aqui você podera alterar ou excluir suas categorias. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form method="post" action="alterar_categoria.php">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria']    ?>">
                    <div class="form-group">
                        <label>Nome da categoria</label>
                        <input class="form-control" placeholder="Digite o nome da categoria. Exemplo: conta de luz" id="nomecategoria" value="<?= $dados[0]['nome_categoria'] ?>" name="nomecategoria" maxlenght="35" />
                    </div>

                    <button type="submit" class="btn btn-success" onclick="return ValidarCategoria()" name="btnSalvar">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Excluir</button>
                    
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmacão de exclusão</h4>
                                </div>
                                <div class="modal-body">
                                  Deseja excluir a categoria: <b><?= $dados[0]['nome_categoria'] ?> ?</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" name="btnExcluir">Sim</button>
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