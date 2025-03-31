<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class CategoriaDAO extends Conexao
{

    public function CadastrarCategoria($nome)
    {

        if (trim($nome) == '') {
            return 0;
        }
        // 1 passo criar variavel que recvebera o obj de conexao
        $conexao = parent::retornaConexao();

        // criar variavel que recebera o texto do sql que devera ser executado no BD\
        $comando_sql = 'insert db_categoria
        (nome_categoria, id_usuario)
        values (?, ?);';

        // 3 passo: criar um objeto que sera configurado para executar o comando_sql
        $sql = new PDOStatement();

        // 4 passo: Colocar dentro do objetro $SQL a conexao preparada para executar o comando_sql
        $sql = $conexao->prepare($comando_sql);

        //5 passo: Verificar se no comando_sql eu tenho ? para ser configurado. se tiver configurar bindValues
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            // Executar no0 banco de dados
            $sql->execute();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function AlterarCategoria($nome, $idCategoria)
    {
        if (trim($nome) == '' || $idCategoria == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'update db_categoria
                        set nome_categoria = ?
                        where id_categoria = ?
                        and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $idCategoria);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ExcluirCategoria($idCategoria){

        if($idCategoria == ''){
            return 0;
        }

        $conexao = parent::retornaConexao();

        $comando_sql = 'delete
                        from db_categoria where id_categoria = ? and id_usuario = ?';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $idCategoria);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try{
            $sql->execute();

            return 1;

        }catch(Exception $ex){

            return -4;
        }
    }

    public function ConsultarCategoria()
    {
        $conexao = parent::retornaConexao();

        // db_categoria tem que trocar o DB por TB

        $comando_sql = 'select id_categoria, nome_categoria from db_categoria where id_usuario = ?
                        order by nome_categoria ASC';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharCategoria($idCategoria)
    {
        $conexao = parent::retornaConexao();

        $comando_sql = 'select id_categoria,
                        nome_categoria
                        from db_categoria
                        where id_categoria = ?
                        and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idCategoria);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }
}
