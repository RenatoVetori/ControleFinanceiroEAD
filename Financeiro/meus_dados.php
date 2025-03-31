<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();

require_once '../DAO/usuarioDAO.php';

$objdao = new UsuarioDAO();

if (isset($_POST['btngravar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];


    $ret = $objdao->GravarMeusDados($nome, $email);
}

$dados = $objdao->CarregarMeusDados();
//echo '<pre>';
//print_r($dados);
//echo '</pre>';

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once '_head.php'
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

                        <?php include_once '_msg.php';    ?>

                        <h2>Meus dados</h2>
                        <h5>Nesta pagina voce podera alterar seus dados. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form method="post" action="meus_dados.php">
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Digite seu nome..." name="nome" id="nome" value="<?= $dados[0]['nome_usuario'] ?> " />
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" placeholder="Digite seu E-mail..." name="email" id="email" value="<?= $dados[0]['email_usuario'] ?>" />
                    </div>
                    <button type="submit" onclick="return ValidarMeusDados()" class="btn btn-success" name="btngravar">Gravar</button>

                </form>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

</body>

</html>