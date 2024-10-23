create database bdAppPersonal;

use bdAppPersonal;

create table tbPersonal(
codPer int not null auto_increment,
nome varchar(50) not null,
cpf char(14) not null unique,
sexo char(1) default "M" check(sexo in('F','M')),
ftPer varchar(200),
cell char(12) not null unique,
cref varchar(15) not null unique,
email varchar(50) not null,
dataNasc date,
primary key(codPer));

create table tbAlunos(
codAlun int not null auto_increment,
nome varchar(50) not null,
sexo char(1) default "M" check(sexo in('F','M')),
dataNasc date,
cell char(10),
email varchar(50) not null,
ftAlun varchar(200),
codPer int not null,
primary key (codAlun),
foreign key(codPer)references tbPersonal(codPer));

create table tbPersonal_Alunos(
codPeAl int not null auto_increment,
codPer int not null,
codAlun int not null,
primary key(codPeAL),
foreign key(codPer)references tbPersonal(codPer),
foreign key(codAlun)references tbAlunos(codAlun));

create table tbCategoria(
codCat int not null auto_increment,
nome varchar(50) not null,
descricao varchar(50),
foto varchar(200),
primary key(codCat));

create table tbExercicios(
codExe int not null auto_increment,
nomeExe varchar(50) not null,
descricao varchar(100) not null,
video varchar(200),
ftExe blob, 
codCat int not null,
primary key(codExe),
foreign key(codCat)references tbCategoria(codCat));

create table tbExercicios_Personal(
codExePer int not null auto_increment,
nomeExePer varchar(50) not null,
descricao varchar(100) not null,
video varchar(200),
ftExe varchar(200),
codPer int not null,
codCat int not null,
primary key(codExePer),
foreign key(codPer)references tbPersonal(codPer),
foreign key(codCat)references tbCategoria(codCat));

create table tbPersonalizarExe(
codPexe int not null auto_increment,
numSer varchar(3) not null,
tempDesc time not null,
numReps varchar(3),
numKg varchar(3),
codExePer int null,
codExe int null,
primary key(codPexe),
foreign key(codExePer)references tbExercicios_Personal(codExePer),
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
codExePer int null,
codExe int null,
primary key(codId),
foreign key(codTreino)references tbTreinos(codTreino),
foreign key(codExePer)references tbExercicios_Personal(codExePer),
foreign key(codExe)references tbExercicios(codExe));


INSERT INTO tbPersonal (codPer, nome, cpf, sexo, ftPer, cell, cref, email, dataNasc)
VALUES (1, 'Leonardo', '000.000.000-01', 'M', '', '1190000-0000', '000000-S', 'leonardohg2005@gmail.com', '2000/12/10');

INSERT INTO tbAlunos (codAlun, nome, sexo, dataNasc, cell, email, ftAlun, codPer)
VALUES(1, 'Matheus', 'M', '1998/10/06', '1194034-3290', 'matheus1998@gmail.com', '', 1);

INSERT INTO tbCategoria (codCat, nome, descricao, foto)
VALUES(1, "Biceps", "Categoria de treino para biceps", "");

INSERT INTO tbExercicios (codExe, nomeExe, descricao, video, ftExe, codCat)
VALUES (1, 'Rosca direta', 'Treino de biceps (rosca direta)', 'https://www.youtube.com/watch?v=FHyZEuRpSg4', '', 1);

INSERT INTO tbListaTreinos (codLista, codPer, nomeLista, observacao, objetivo)
VALUES (1, 1, 'Treino ABC', 'Treino iniciante', 'Hipertrofia');

INSERT INTO tbTreinos (codTreino, codLista, nomeTreino, diaTreino)
VALUES (1, 1, 'Peito e biceps', 'segunda');

INSERT INTO tbTreino_Exercicio (codId, codTreino, codExePer, codExe)
VALUES (1, 1, null, 1);

INSERT INTO tbExercicios_Personal (codExePer, nomeExePer, descricao, video, ftExe, codCat, codPer)
VALUES (1, 'Rosca direta', 'Treino de biceps (rosca direta)', 'https://www.youtube.com/watch?v=FHyZEuRpSg4', '', 1, 1);

INSERT INTO tbPersonalizarExe (codPexe, numSer, tempDesc, numReps, numKg, codExePer, codExe)
VALUES (1, 1, '00:01:30', 10, 12, null, 1);