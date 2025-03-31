<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/categoriaDAO.php';

    if(isset($_POST['btngravar'])){
        $nome = $_POST['nome'];

        $objdao = new CategoriaDAO();

        $ret = $objdao->CadastrarCategoria($nome);
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
                        <?php  include_once '_msg.php';?>

                        <h2>Nova categoria</h2>
                        <h5>Aqui Você podera cadastrar todas as suas novas categorias. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_categoria.php" method="post">
                <div class="form-group">
                    <label>Nome da Categoria</label>
                    <input class="form-control"  name="nome" id="nomecategoria" placeholder="Digite o nome da categoria. Exemplo: conta de luz." />
                </div>
                <button type="submit" name="btngravar" onclick="return ValidarCategoria()" class="btn btn-success" maxlenght="35">Gravar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

</body>

</html>