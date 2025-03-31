<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class NovaContaDAO extends Conexao
{

    public function NovaConta($nome, $agencia, $numero, $saldo)
    {

        if (trim($nome) == '' || trim($agencia) == '' || trim($numero) == '' || trim($saldo) == '') {
            return 0;
        }
        $conexao = $this->retornaConexao();

        $comando_sql = 'insert into tb_conta
                        (banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
                        values
                        (?,?,?,?, ?);';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numero);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public  function ConsultarConta()
    {
        $conexao = parent::retornaConexao();

        $comando_sql = 'select id_conta,
                        banco_conta,
                        agencia_conta,
                        saldo_conta,
                        numero_conta
                        from tb_conta
                        where id_usuario = ? order by banco_conta';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharConta($idConta)
    {
        if ($idConta == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();

        $comando_sql = ' select id_conta,
                            banco_conta,
                            agencia_conta,
                            saldo_conta,
                            numero_conta
                            from tb_conta
                            where id_conta = ?
                            and id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idConta);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarConta($banco, $agencia, $numero, $saldo, $idconta)
    {
        // Verifica se os campos estão vazios
        // Se algum campo estiver vazio, retorna 0
        if (trim($banco) == '' || trim($agencia) == '' || trim($numero) == '' || trim($saldo) == '' || $idconta == '') {
            return 0;
        }else{

        $conexao = parent::retornaConexao();
        $comando_sql = 'update tb_conta
                        set banco_conta = ?,
                        agencia_conta = ?,
                        numero_conta = ?,
                        saldo_conta = ? 
                        where id_conta = ?
                        and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numero);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, $idconta);
        $sql->bindValue(6, UtilDAO::CodigoLogado());
            
        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }
    }

    }

    public function ExcluirConta($idconta)
    {
        if ($idconta == '') {
            return 0;
        } else {

            $conexao = parent::retornaConexao();

            $comando_sql = 'delete
                        from tb_conta
                        where id_conta = ?
                        and id_usuario = ?';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $idconta);
            $sql->bindValue(2, UtilDAO::CodigoLogado());

            try {

                $sql->execute();

                return 1;
            } catch (Exception $ex) {
                return -4;
            }
        }
    }
}
