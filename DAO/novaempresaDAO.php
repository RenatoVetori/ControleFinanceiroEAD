<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class NovaEmpresaDAO extends Conexao
{

    public function NovaEmpresa($nome, $telefone, $endereco)
    {

        //if(trim($nome)== '' || trim($telefone)== '' || trim($endereco)== '')
        if (trim($nome) == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'insert into tb_empresa
                        (nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
                        values
                        (?,?,?,?);';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $telefone);
        $sql->bindValue(3, $endereco);
        $sql->bindValue(4, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ConsultarEmpresa()
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_empresa,
                        nome_empresa,
                        telefone_empresa,
                        endereco_empresa
                        from tb_empresa
                        where id_usuario = ? order by nome_empresa ASC';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharEmpresa($idEmpresa)
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_empresa,
                        nome_empresa,
                        telefone_empresa,
                        endereco_empresa
                        from tb_empresa
                        where id_empresa = ?
                        and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idEmpresa);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarEmpresa($idEmpresa, $nomeempresa, $telefone, $endereco)
    {

        if (trim($nomeempresa) == '' || $idEmpresa == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'update tb_empresa
                        set nome_empresa = ?,
                        telefone_empresa = ?,
                        endereco_empresa = ?
                        where id_empresa = ?
                        and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nomeempresa);
        $sql->bindValue(2, $telefone);
        $sql->bindValue(3, $endereco);
        $sql->bindValue(4, $idEmpresa);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ExcluirEmpresa($idEmpresa)
    {

        if ($idEmpresa == '') {
            return 0;
        } else {

            $conexao = parent::retornaConexao();

            $comando_sql = 'delete
                        from tb_empresa
                        where id_empresa = ?
                        and id_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $idEmpresa);
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
