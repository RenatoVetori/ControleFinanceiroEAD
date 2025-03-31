<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/realizar_movimentoDAO.php';
require_once '../DAO/categoriaDAO.php';
require_once '../DAO/novaempresaDAO.php';
require_once '../DAO/novacontaDAO.php';

$dao_cat = new CategoriaDAO;
$dao_emp = new NovaEmpresaDAO;
$dao_con = new NovaContaDAO;

if (isset($_POST['btngravar'])) {
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $valor = $_POST['valor'];
    $obs = $_POST['obs'];
    $categoria = $_POST['categoria'];
    $empresa = $_POST['empresa'];
    $conta = $_POST['conta'];


    $objdao = new RealizarmovimentoDAO();

    $ret = $objdao->RealizarMovimento($tipo, $data, $valor, $obs, $categoria, $empresa, $conta);
}

$categorias = $dao_cat->ConsultarCategoria();
$empresas = $dao_emp->ConsultarEmpresa();
$contas = $dao_con->ConsultarConta();

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
                        <h2>Realizar Movimentos</h2>
                        <h5>Aqui Você podera realizar seus movimentos de entrada ou saida. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="realizar_movimento.php" method="post">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Tipo de movimento*</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="">Selecione</option>
                                <option value="1">Entrada</option>
                                <option value="2">Saida</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Data*</label>
                            <input name="data" id="data" type="date" class="form-control" placeholder="Digite a data do movimento." />
                        </div>
                        <div class="form-group">
                            <label>Valor*</label>
                            <input name="valor" id="valor" class="form-control" placeholder="Digite o valor do movimento." />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categoria*</label>
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($categorias as $item) { ?>
                                    <option value="<?= $item['id_categoria'] ?>">
                                        <?= $item['nome_categoria'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Empresa*</label>
                            <select name="empresa" id="empresa" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($empresas as $item) { ?>
                                    <option value="<?= $item['id_empresa'] ?>">
                                        <?= $item['nome_empresa'] ?>
                                    </option>

                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Conta*</label>
                            <select name="conta" id="conta" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($contas as $item) { ?>
                                    <option value="<?= $item['id_conta'] ?>">
                                        <?= 'Banco: ' . $item['banco_conta'] . ', Agencia / Número: ' . $item['agencia_conta'] . ' / ' . $item['numero_conta'] . ' - Saldo: R$ ' . $item['saldo_conta'] ?>
                                    </option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observação (opcional)</label>
                            <textarea id="obs" name="obs" class="form-control" rows="3" placeholder="Digite sua Observacao aqui..."></textarea>
                        </div>
                        <button type="submit" name="btngravar" onclick="return ValidarMovimento()" class="btn btn-success">Finalizar lançamento</button>
                    </div>

            </div>
            </form>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

</body>

</html>