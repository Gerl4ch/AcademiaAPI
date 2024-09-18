create database bdAppPersonal;

use bdAppPersonal;

create table tbPersonal(
codPer int not null auto_increment,
nome varchar(50) not null,
cpf char(14) not null unique,
sexo char(1) default "M" check(sexo in('F','M')),
ftPer blob,
senha varchar(50) not null,
cell char(12) not null unique,
cref varchar(15) not null unique,
email varchar(50) not null,
dataNasc date,
primary key(codPer));

create table tbAlunos(
codAlun int not null auto_increment,
nome varchar(50) not null,
senha varchar(50) not null,
sexo char(1) default "M" check(sexo in('F','M')),
dataNasc date,
cell char(10),
email varchar(50) not null,
ftAlun blob,
cep varchar(8) not null,
estado varchar(50) not null,
cidade varchar(50) not null,
rua varchar(100) not null,
bairo varchar(50) not null,
num varchar(5) not null,
codPer int not null,
primary key (codAlun),
foreign key(codPer)references tbPersonal(codPer));

create table tbUsuarios(
codUsu int not null auto_increment,
nome varchar(50) not null,
cpf char(14) not null unique,
email varchar(50) not null,
primary key(codUsu));

create table tbPersonal_Alunos(
codPer int not null,
codAlun int not null,
primary key(codPer,codAlun),
foreign key(codPer)references tbPersonal(codPer),
foreign key(codAlun)references tbAlunos(codAlun));

create table tbCategoria(
codCat int not null auto_increment,
nome varchar(50) not null,
descricao varchar(50),
foto varchar(100),
primary key(codCat));

create table tbExercicios(
codExe int not null auto_increment,
nomeExe varchar(50) not null,
descricao varchar(100) not null,
video varchar(200),
ftExe varchar(200),
codCat int not null,
primary key(codExe),
foreign key(codCat)references tbCategoria(codCat));

create table tbPersonalizarExe(
codPexe int not null auto_increment,
numSer varchar(3) not null default "4",
tempDesc time not null,
numReps varchar(3),
numKg varchar(3),
codExe int not null,
primary key(codPexe),
foreign key(codExe)references tbExercicios(codExe));

create table tbListaTreinos(
codLista int not null auto_increment,
codPer int not null,
nomeLista varchar(50) not null,
observacao varchar(100),
objetivo ENUM('hipertrofia', 'perda de peso', 'fortalecimento'),
primary key(codLista),
foreign key(codPer)references tbPersonal(codPer));

create table tbTreinos(
codTreino int not null auto_increment,
codLista int not null,
nomeTreino varchar(100),
diaTreino ENUM('segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo'),
primary key(codTreino),
foreign key(codLista)references tbListaTreinos(codLista));

create table tbTreino_Exercicio(
codId int not null auto_increment,
codTreino int not null,
codExe int not null,
primary key(codId),
foreign key(codTreino)references tbTreinos(codTreino),
foreign key(codExe)references tbExercicios(codExe));


INSERT INTO tbPersonal (codPer, nome, cpf, sexo, ftPer, senha, cell, cref, email, dataNasc)
VALUES (1, 'Leonardo', '000.000.000-01', 'M', '', 'leonardo123', '1190000-0000', '000000-S', 'leonardohg2005@gmail.com', '10/12/2000');
