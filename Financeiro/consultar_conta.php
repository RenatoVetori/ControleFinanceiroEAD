<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/novacontaDAO.php';

$dao = new NovaContaDAO();

$contas = $dao->ConsultarConta();

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
                        <h2>Consultar contas</h2>
                        <h5>Consulte todas suas contas aqui. </h5>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Contas cadastradas. Caso deseja alterar, clique no botao.
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Banco</th>
                                                <th>Agência</th>
                                                <th>Número da conta</th>
                                                <th>Saldo</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php foreach ($contas as $item) { ?>    

                                            <tr class="odd gradeX">
                                                <td><?= $item['banco_conta'] ?> </td>
                                                <td><?= $item['agencia_conta'] ?></td>
                                                <td><?= $item['numero_conta'] ?></td>
                                                <td>R$ <?= $item['saldo_conta'] ?></td>
                                                <td>
                                                   <td><a href="alterar_conta.php?cod=<?= $item['id_conta']?> " class="btn btn-warning btn-sm">Alterar</a></td>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->
                    </div>
                </div>

            </div>

        </div>
    </div>
</body>

</html>