<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class RealizarmovimentoDAO extends Conexao
{

    public function RealizarMovimento($tipo, $data, $valor, $obs, $categoria, $empresa, $conta)
    {

        if (trim($tipo) == '' || trim($data) == '' || trim($valor) == '' || trim($categoria) == '' || trim($empresa) == '' || trim($conta) == '') {
            return 0;
        } else {


            $conexao = parent::retornaConexao();
            $comando_sql = 'insert into tb_movimento
                    (tipo_movimento, data_movimento, valor_movimento,
                    obs_movimento,id_categoria, id_empresa, id_conta, id_usuario)
                    values(?,?,?,?,?,?,?,?);';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $tipo);
            $sql->bindValue(2, $data);
            $sql->bindValue(3, $valor);
            $sql->bindValue(4, $obs);
            $sql->bindValue(5, $categoria);
            $sql->bindValue(6, $empresa);
            $sql->bindValue(7, $conta);
            $sql->bindValue(8, UtilDAO::CodigoLogado());

            $conexao->beginTransaction();


            try {

                $sql->execute();

                if ($tipo == 1) {

                    $comando_sql = 'update tb_conta set saldo_conta = saldo_conta + ? 
                                where id_conta = ?; ';
                } else if ($tipo == 2) {
                    $comando_sql = 'update tb_conta set saldo_conta = saldo_conta - ? 
                                where id_conta = ?; ';
                }

                $sql = $conexao->prepare($comando_sql);
                $sql->bindValue(1, $valor);
                $sql->bindValue(2, $conta);

                //atualiza saldo da conta
                $sql->execute();

                $conexao->commit();

                return 1;
            } catch (Exception $ex) {

                echo $ex->getMessage();
                $conexao->rollBack();

                return -1;
            }
        }
    }

    public function ExcluirMovimento($idMov, $idConta, $valor, $tipo)
    {
        if ($idMov == '' || $idConta == '' || $valor == '' || $tipo == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();

        $comando_sql = 'delete from tb_movimento where id_movimento = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idMov);

        $conexao->beginTransaction();

        try {
            $sql->execute();

            if ($tipo == 1) {
                $comando_sql = 'update tb_conta
                                set saldo_conta = saldo_conta - :saldo
                                where id_conta = :idConta';
            } else if ($tipo == 2) {

                $comando_sql = 'update tb_conta
                                set saldo_conta = saldo_conta + :saldo
                                where id_conta = :idConta';

            }

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(':saldo', $valor);
            $sql->bindValue(':idConta', $idConta);

            $sql->execute();

            $conexao->commit();

            return 1;
        } catch (Exception $ex) {
            $conexao->rollBack();
            echo $ex->getMessage();
            return -1;
        }
    }


    public function FiltrarMovimento($tipo, $dt_inicial, $dt_final)
    {
        if (trim($dt_inicial == '' || trim($dt_final) == '')) {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_movimento,
                            tb_movimento.id_conta,
                            tipo_movimento,
                            date_format(data_movimento, "%d/%m/%Y") as data_movimento,
                            valor_movimento,
                            nome_categoria,
                            nome_empresa,
                            banco_conta,
                            numero_conta,
                            agencia_conta,
                            obs_movimento
                            from tb_movimento
                        inner join db_categoria
                            on db_categoria.id_categoria = tb_movimento.id_categoria
                        inner join tb_empresa
                            on tb_empresa.id_empresa = tb_movimento.id_empresa
                        inner join tb_conta
                            on tb_conta.id_conta = tb_movimento.id_conta
                        where tb_movimento.id_usuario = ?
                            and tb_movimento.data_movimento between ? and ?';

        if ($tipo != 0) {
            $comando_sql = $comando_sql . 'and tipo_movimento = ? ';
        }

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->bindValue(2, $dt_inicial);
        $sql->bindValue(3, $dt_final);

        if ($tipo != 0) {
            $sql->bindValue(4, $tipo);
        }

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function MostrarUltimosLancamentos()
    {

        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_movimento,
                            tb_movimento.id_conta,
                            tipo_movimento,
                            date_format(data_movimento, "%d/%m/%Y") as data_movimento,
                            valor_movimento,
                            nome_categoria,
                            nome_empresa,
                            banco_conta,
                            numero_conta,
                            agencia_conta,
                            obs_movimento
                            from tb_movimento
                        inner join db_categoria
                            on db_categoria.id_categoria = tb_movimento.id_categoria
                        inner join tb_empresa
                            on tb_empresa.id_empresa = tb_movimento.id_empresa
                        inner join tb_conta
                            on tb_conta.id_conta = tb_movimento.id_conta
                        where tb_movimento.id_usuario = ?
                        order by tb_movimento.id_movimento DESC limit 10';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }


    public function TotalEntrada()
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'select sum(valor_movimento) as total
                        from tb_movimento
                        where tipo_movimento = 1
                        and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function TotalSaida()
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'select sum(valor_movimento) as total
                        from tb_movimento
                        where tipo_movimento = 2
                        and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }
}
