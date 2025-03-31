-- comando para inserir\
-- insert into nome_da_tabela (colunas) values (valores)
insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Ana Maria','ana_gmail.com','senha123','2021-02-21');

insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Kratos Grecia','godofwar@hotmail.com','olympomanda','2025-02-14');

insert db_categoria
(nome_categoria, id_usuario)
values
('BardoZe', 9);

insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('Maringa colchoes','44991126122','rua mandaguari',2);

insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('Municoes Almeida','30252277','av guns for life', 2);

insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario, id_empresa)
values
('acougue unidos','4420237999','rua miguel vetori', 3,11);

ALTER TABLE tb_empresa MODIFY id_empresa INT AUTO_INCREMENT;

SET foreign_key_checks = 0;
SET foreign_key_checks = 1;

ALTER TABLE tb_movimento DROP FOREIGN KEY fk_tb_movimento_tb_empresa1;
ALTER TABLE tb_empresa MODIFY id_empresa INT AUTO_INCREMENT;
ALTER TABLE tb_movimento ADD CONSTRAINT fk_tb_movimento_tb_empresa1 FOREIGN KEY (id_empresa) REFERENCES tb_empresa(id_empresa);
ALTER TABLE tb_movimento ADD CONSTRAINT fk_tb_movimento_tb_empresa1 FOREIGN KEY (id_empresa) REFERENCES tb_empresa(id_empresa);


insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('itau','0118','983284','220', 1);

insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values
('Nu Bank','2024','20241547','849', 5);

insert into tb_movimento
(tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria, id_usuario)
value
(1 ,'2023-07-12', 120, null, 2,2,6,8);


