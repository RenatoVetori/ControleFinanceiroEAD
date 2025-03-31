select nome_usuario, data_cadastro
	from tb_usuario
	where nome_usuario like '%j%'
    ;
    
select nome_usuario, data_cadastro
	from tb_usuario
	where nome_usuario like 'a%'
    ;
    
select nome_usuario, data_cadastro
	from tb_usuario
	where data_cadastro between '2021-02-01' and '2024-02-02'
    ;
    
select banco_conta, agencia_conta, saldo_conta
	from tb_conta
    where id_usuario = 2;
    