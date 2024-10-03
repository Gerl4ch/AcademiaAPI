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
	

	function createPersonal($nome, $cpf, $sexo, $ftPer, $cell, $cref, $email, $dataNasc){
		$stmt = $this->con->prepare("INSERT INTO tbPersonal (nome, cpf, sexo, ftPer, cell, cref, email, dataNasc) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssss", $nome, $cpf, $sexo, $ftPer, $cell, $cref, $email, $dataNasc);
		if($stmt->execute())
			return true; 			
		return false;
	}

	function createAluno($nome, $sexo, $dataNasc, $cell, $email, $ftAlun, $codPer){
		$stmt = $this->con->prepare("INSERT INTO tbAlunos (nome, sexo, dataNasc, cell, email, ftAlun, codPer) VALUES ( ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssi", $nome, $sexo, $dataNasc, $cell, $email, $ftAlun, $codPer);
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

	function createExercicio_Personal($nomeExePer, $descricao, $video, $ftExe, $codCat, $codPer){
		$stmt = $this->con->prepare("INSERT INTO tbExercicios_Personal (nomeExePer, descricao, video, ftExe, codCat, codPer) VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssii", $nomeExePer, $descricao, $video, $ftExe, $codCat, $codPer);
		if($stmt->execute())
			return true; 			
		return false;
	}


	// Busca e Lista 

	function getPersonal(){
		$stmt = $this->con->prepare("SELECT codPer, nome, cpf, sexo, ftPer, cell, cref, email, dataNasc FROM tbPersonal");
		$stmt->execute();
		$stmt->bind_result($codPer, $nome, $cpf, $sexo, $ftPer, $cell, $cref, $email, $dataNasc);
		
		$pers = array(); 
		
		while($stmt->fetch()){
			$per = array();
			$per['codPer'] = $codPer; 
			$per['nome'] = $nome; 
			$per['cpf'] = $cpf; 
			$per['sexo'] = $sexo; 
			$per['ftPer'] = $ftPer;
			$per['cell'] = $cell; 
			$per['cref'] = $cref; 
			$per['email'] = $email; 
			$per['dataNasc'] = $dataNasc;
			
			array_push($pers, $per); 
		}
		return $pers;
	}
	function getAluno(){
		$stmt = $this->con->prepare("SELECT codAlun, nome, sexo, dataNasc, cell, email, ftAlun, codPer FROM tbAlunos");
		$stmt->execute();
		$stmt->bind_result($codAlun, $nome, $sexo, $dataNasc, $cell, $email, $ftAlun, $codPer);
		
		$alunos = array(); 
		
		while($stmt->fetch()){
			$aluno = array();
			$aluno['codAlun'] = $codAlun; 
			$aluno['nome'] = $nome; 
			$aluno['sexo'] = $sexo; 
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
		function getExercicio_Personal(){
		$stmt = $this->con->prepare("SELECT codExePer, nomeExePer, descricao, video, ftExe, codCat, codPer FROM tbExercicios_Personal");
		$stmt->execute();
		$stmt->bind_result($codExePer, $nomeExePer, $descricao, $video, $ftExe, $codCat, $codPer);
		
		$exes = array(); 
		
		while($stmt->fetch()){
			$exe  = array();
			$exe['codExePer'] = $codExePer; 
			$exe['nomeExePer'] = $nomeExePer; 
			$exe['descricao'] = $descricao; 
			$exe['video'] = $video; 
			$exe['ftExe'] = $ftExe;
			$exe['codCat'] = $codCat;
			$exe['codPer'] = $codPer;  
			
			array_push($exes, $exe); 
		}
		return $exes; 
	}
		
		
		
		
		
	
	
	// Dados que vão ser atualizados no aplicativo 

	function updatePersonal($codPer, $nome, $cpf, $sexo, $ftPer, $cell, $cref, $email, $dataNasc){
		$stmt = $this->con->prepare("UPDATE tbPersonal SET nome = ?, cpf = ?, sexo = ?, ftPer = ?, cell = ?, cref = ?, email = ?, dataNasc = ? WHERE codPer = ?");
		$stmt->bind_param("ssssssssi", $nome, $cpf, $sexo, $ftPer, $cell, $cref, $email, $dataNasc, $codPer);
		if($stmt->execute())
			return true; 
		return false; 
	}

	function updateAluno($codAlun, $nome, $sexo, $dataNasc, $cell, $email, $ftAlun, $codPer){
		$stmt = $this->con->prepare("UPDATE tbAlunos SET nome = ?, sexo = ?, dataNasc = ?, cell = ?, email = ?, ftAlun = ?, codPer = ? WHERE codAlun = ?");
		$stmt->bind_param("ssssssii", $nome, $sexo, $dataNasc, $cell, $email, $ftAlun, $codPer, $codAlun);
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

	function updateExercicio_Personal($codExePer, $nomeExePer, $descricao, $video, $ftExe, $codCat, $codPer){
		$stmt = $this->con->prepare("UPDATE tbExercicios_Personal SET nomeExePer = ?, descricao = ?, video = ?, ftExe = ?, codCat = ?, codPer = ? WHERE codExePer = ?");
		$stmt->bind_param("ssssiii", $nomeExePer, $descricao, $video, $ftExe, $codCat, $codPer, $codExePer);
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

	function deleteExercicio($codExePer){
		$stmt = $this->con->prepare("DELETE FROM tbExercicio_Personal WHERE codExePer = ? ");
		$stmt->bind_param("i", $codExePer);
		if($stmt->execute())
			return true; 
		return false; 
	}
}