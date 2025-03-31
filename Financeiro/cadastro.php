<?php

require_once '../DAO/usuarioDAO.php';

if(isset($_POST['btngravar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confsenha = $_POST['confsenha'];

    $objdao = new UsuarioDAO ();

    $ret = $objdao->ValidarCadastro($nome, $email, $senha, $confsenha);
}

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <?php include_once '_msg.php'; ?>
                <h2> Controle Financeiro : Cadastro</h2>

                <h5>( Faça seu cadastro )</h5>
                <br />
            </div>
        </div>
        <div class="row">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Preencher todos os campos: </strong>
                    </div>
                    <div class="panel-body">
                        <br />
                        <form action="cadastro.php" method="post">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"></i></span>
                                <input name="nome" id="nome" type="text" class="form-control" placeholder="Digite seu nome aqui..." />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input name="email" id="email" type="text" class="form-control" placeholder="Digite seu E-mail aqui..." />
                            </div>
                            <span style="font-size: 10 px; font-style: italic;">"A senha deve ter entre 6 e 8 caracteres!"</span>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input name="senha" id="senha" type="password" class="form-control" placeholder="Digite sua senha" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input name="confsenha" id="confsenha" type="password" class="form-control" placeholder="Digite novamente sua senha" />
                            </div>

                            <button name="btngravar" class="btn btn-success " onclick="return ValidarCadastro()">Cadastrar</button>
                            <hr />
                            <span>Ja possui uma conta?</span><a href="login.php"> Clique aqui!</a>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
</body>

</html>