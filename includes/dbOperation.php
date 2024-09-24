<?php
 
class DbOperation
{
    
    private $con;
 
 
    function __construct()
    {
  
        require_once dirname(__FILE__) . '/dbConnect.php';
 
     
        $db = new DbConnect();
 

        $this->con = $db->connect();
    }
	
	// Criar novos dados
	

	function createPersonal($nome, $cpf, $sexo, $ftPer, $senha, $cell, $cref, $email, $dataNasc){
		$stmt = $this->con->prepare("INSERT INTO tbPersonal (nome, cpf, sexo, ftPer, senha, cell, cref, email, dataNasc) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssssss", $nome, $cpf, $sexo, $ftPer, $senha, $cell, $cref, $email, $dataNasc);
		if($stmt->execute())
			return true; 			
		return false;
	}

	function createAluno($nome, $senha, $sexo, $dataNasc, $cell, $email, $ftAlun, $codPer){
		$stmt = $this->con->prepare("INSERT INTO tbAlunos (nome, senha, sexo, dataNasc, cell, email, ftAlun, codPer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssssi", $nome, $senha, $sexo, $dataNasc, $cell, $email, $ftAlun, $codPer);
		if($stmt->execute())
			return true; 			
		return false;
	}

	function createLista($codPer, $nomeLista, $observacao, $objetivo){
		$stmt = $this->con->prepare("INSERT INTO tbListaTreinos (codPer, nomeLista, observacao, objetivo) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("isss", $codPer, $nomeLista, $observacao, $objetivo);
		if($stmt->execute())
			return true; 			
		return false;
	}

	function createTreino($codLista, $nomeTreino, $diaTreino){
		$stmt = $this->con->prepare("INSERT INTO tbTreinos (codLista, nomeTreino, diaTreino) VALUES (?, ?, ?)");
		$stmt->bind_param("iss", $codLista, $nomeTreino, $diaTreino);
		if($stmt->execute())
			return true; 			
		return false;
	}

	function createExercicio($nomeExe, $descricao, $video, $ftExe, $codCat){
		$stmt = $this->con->prepare("INSERT INTO tbExercicios (nomeExe, descricao, video, ftExe, codCat) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssi", $nomeExe, $descricao, $video, $ftExe, $codCat);
		if($stmt->execute())
			return true; 			
		return false;
	}


	// Busca e Lista 

	function getPersonal(){
		$stmt = $this->con->prepare("SELECT codPer, nome, cpf, sexo, ftPer, senha, cell, cref, email, dataNasc FROM tbPersonal");
		$stmt->execute();
		$stmt->bind_result($codPer, $nome, $cpf, $sexo, $ftPer, $senha, $cell, $cref, $email, $dataNasc);
		
		$pers = array(); 
		
		while($stmt->fetch()){
			$per = array();
			$per['codPer'] = $codPer; 
			$per['nome'] = $nome; 
			$per['cpf'] = $cpf; 
			$per['sexo'] = $sexo; 
			$per['ftPer'] = $ftPer; 
			$per['senha'] = $senha; 
			$per['cell'] = $cell; 
			$per['cref'] = $cref; 
			$per['email'] = $email; 
			$per['dataNasc'] = $dataNasc;
			
			array_push($pers, $per); 
		}
		return $pers;
	}
	function getAluno(){
		$stmt = $this->con->prepare("SELECT codAlun, nome, senha, sexo, dataNasc, cell, email, ftAlun, codPer FROM tbAlunos");
		$stmt->execute();
		$stmt->bind_result($codAlun, $nome, $senha, $sexo, $dataNasc, $cell, $email, $ftAlun, $codPer);
		
		$alunos = array(); 
		
		while($stmt->fetch()){
			$aluno = array();
			$aluno['codAlun'] = $codAlun; 
			$aluno['nome'] = $nome; 
			$aluno['senha'] = $senha; 
			$aluno['dataNasc'] = $dataNasc; 
			$aluno['cell'] = $cell; 
			$aluno['email'] = $email; 
			$aluno['ftAlun'] = $ftAlun; 
			$aluno['codPer'] = $codPer; 
			
			array_push($alunos, $aluno); 
		}
		return $alunos;
	}
		function getLista(){
		$stmt = $this->con->prepare("SELECT codLista, codPer, nomeLista, observacao, objetivo FROM tbListaTreinos");
		$stmt->execute();
		$stmt->bind_result($codLista, $codPer, $nomeLista, $observacao, $objetivo);
		
		$listas = array(); 
		
		while($stmt->fetch()){
			$lista = array();
			$lista['codLista'] = $codLista; 
			$lista['codPer'] = $codPer; 
			$lista['nomeLista'] = $nomeLista; 
			$lista['observacao'] = $observacao; 
			$lista['objetivo'] = $objetivo;
			
			array_push($listas, $lista); 
		}
		return $listas;
	}
		function getTreino(){
		$stmt = $this->con->prepare("SELECT codTreino, codLista, nomeTreino, diaTreino FROM tbTreinos");
		$stmt->execute();
		$stmt->bind_result($codTreino, $codLista, $nomeTreino, $diaTreino);
		
		$treinos = array(); 
		
		while($stmt->fetch()){
			$treino = array();
			$treino['codTreino'] = $codTreino; 
			$treino['codLista'] = $codLista; 
			$treino['nomeTreino'] = $nomeTreino; 
			$treino['diaTreino'] = $diaTreino; 
			
			array_push($treinos, $treino); 
		}
		return $treinos;
	}
		function getExercicio(){
		$stmt = $this->con->prepare("SELECT codExe, nomeExe, descricao, video, ftExe, codCat FROM tbExercicios");
		$stmt->execute();
		$stmt->bind_result($codExe, $nomeExe, $descricao, $video, $ftExe, $codCat);
		
		$exes = array(); 
		
		while($stmt->fetch()){
			$exe  = array();
			$exe['codExe'] = $codExe; 
			$exe['nomeExe'] = $nomeExe; 
			$exe['descricao'] = $descricao; 
			$exe['video'] = $video; 
			$exe['ftExe'] = $ftExe;
			$exe['codCat'] = $codCat; 
			
			array_push($exes, $exe); 
		}
		return $exes; 
	}
		
		
		
		
		
	
	
	// Dados que vão ser atualizados no aplicativo 

	function updatePersonal($codPer, $nome, $cpf, $sexo, $ftPer, $senha, $cell, $cref, $email, $dataNasc){
		$stmt = $this->con->prepare("UPDATE tbPersonal SET nome = ?, cpf = ?, sexo = ?, ftPer = ?, senha = ?, cell = ?, cref = ?, email = ?, dataNasc = ? WHERE codPer = ?");
		$stmt->bind_param("sssssssssi", $nome, $cpf, $sexo, $ftPer, $senha, $cell, $cref, $email, $dataNasc, $codPer);
		if($stmt->execute())
			return true; 
		return false; 
	}

	function updateAluno($codAlun, $nome, $senha, $sexo, $dataNasc, $cell, $email, $ftAlun, $codPer){
		$stmt = $this->con->prepare("UPDATE tbAlunos SET nome = ?, senha = ?, sexo = ?, dataNasc = ?, cell = ?, email = ?, ftAlun = ?, codPer = ? WHERE codAlun = ?");
		$stmt->bind_param("sssssssii", $nome, $senha, $sexo, $dataNasc, $cell, $email, $ftAlun, $codPer, $codAlun);
		if($stmt->execute())
			return true; 
		return false; 
	}

	function updateLista($codLista, $codPer, $nomeLista, $observacao, $objetivo){
		$stmt = $this->con->prepare("UPDATE tbListaTreino SET codPer = ?, nomeLista = ?, observacao = ?, objetivo = ? WHERE codLista = ?");
		$stmt->bind_param("isssi", $codPer, $nomeLista, $observacao, $objetivo, $codLista);
		if($stmt->execute())
			return true; 
		return false; 
	}

	function updateTreino($codTreino, $codLista, $nomeTreino, $diaTreino){
		$stmt = $this->con->prepare("UPDATE tbTreino SET codLista = ?, nomeTreino = ?, diaTreino = ? WHERE coTreino = ?");
		$stmt->bind_param("issi", $codLista, $nomeTreino, $diaTreino, $codTreino);
		if($stmt->execute())
			return true; 
		return false; 
	}

	function updateExercicio($codExe, $nomeExe, $descricao, $video, $ftExe, $codCat){
		$stmt = $this->con->prepare("UPDATE tbExercicios SET nomeExe = ?, descricao = ?, video = ?, ftExe = ?, codCat = ? WHERE codExe = ?");
		$stmt->bind_param("ssssii", $nomeExe, $descricao, $video, $ftExe, $codCat, $codExe);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	// Dados que poderão ser deletados

	function deleteLista($codLista){
		$stmt = $this->con->prepare("DELETE FROM tbListaTreinos WHERE codLista = ? ");
		$stmt->bind_param("i", $codLista);
		if($stmt->execute())
			return true; 
		return false; 
	}

	function deleteTreino($codTreino){
		$stmt = $this->con->prepare("DELETE FROM tbTreino WHERE codTreino = ? ");
		$stmt->bind_param("i", $codTreino);
		if($stmt->execute())
			return true; 
		return false; 
	}

	function deleteExercicio($codExe){
		$stmt = $this->con->prepare("DELETE FROM tbExercicio WHERE codExe = ? ");
		$stmt->bind_param("i", $codExe);
		if($stmt->execute())
			return true; 
		return false; 
	}
}