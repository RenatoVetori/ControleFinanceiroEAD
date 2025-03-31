<?php

require_once '../DAO/usuarioDAO.php';

if (isset($_POST['btngravar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $objdao = new UsuarioDAO($email, $senha);

    $ret = $objdao->ValidarLogin($email, $senha);
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>

    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <?php include_once '_msg.php' ?>
                <h2> Controle Financeiro : Acesso</h2>
                <h5>( Faca seu login )</h5>
                <br />
            </div>
        </div>
        <div class="row ">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Preencha todos os dados: </strong>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="login.php">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Digite seu E-mail aqui... " />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="senha" id="senha" class="form-control" placeholder="Digite sua senha aqui..." />
                            </div>

                            <button type="submit" name="btngravar" class="btn btn-primary" onclick="return ValidarLogin()">Acessar</button>
                            <hr />
                            <span> Nao possui uma conta? </span> <a href="cadastro.php">Clique aqui! </a>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
</body>

</html>