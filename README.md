# Oficina2.0

Informações gerais:
A Oficina2.0 é um sistema simples de organização de orçamentos de oficinas mecânicas. Por meio dele, é possível cadastrar, editar, remover, visualizar e filtrar os orçamentos. Foi utilizada a linguagem PHP para a construção dessa aplicação web. Também foi aplicado o framework Bootstrap para facilitar o desenvolvimento de uma interface visualmente agradável.

Código:
O ambiente de desenvolvimento foi o Visual Studio Code. Além disso, foi utilizado o padrão Model-View-Controller (MVC) para a organização do código.

Configurações:
O projeto foi configurado para rodar com a ajuda do pacote xampp, que disponibiliza, dentre vários recursos, o servidor Apache. Dessa forma, alguns arquivos foram inseridos apenas para garantir um ambiente de desenvolvimento adequado.

Banco de dados:
Foi utilizado o MySQL como Sistema de Gerenciamento de Banco de Dados. A seguir, tem-se o código criado.

<code>
create database oficina;

use oficina;

create table orcamentos(

	id int auto_increment primary key,
	
	cliente varchar(255) not null,
	
	data_orc date not null,
	
	hora_orc time not null,
	
	vendedor varchar(255) not null,
	
	descricao text not null,
	
	valor float not null
	
);
</code>
