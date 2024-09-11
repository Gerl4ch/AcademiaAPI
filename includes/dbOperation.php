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

	function createAluno($nome, $senha, $sexo, $dataNasc, $cell, $email, $ftAlun, $cep, $estado, $cidade, $bairro, $rua, $bairro, $num, $codPer){
		$stmt = $this->con->prepare("INSERT INTO tbAlunos (nome, senha, sexo, dataNasc, cell, email, ftAlun, cep, estado, cidade, bairro, rua, bairro, num, codPer) VALUES (?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("ssssssssssssssi", $nome, $senha, $sexo, $dataNasc, $cell, $email, $ftAlun, $cep, $estado, $cidade, $bairro, $rua, $bairro, $num, $codPer);
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

	function createExercicio($nomeExe, $descricao, $video, $codCat){
		$stmt = $this->con->prepare("INSERT INTO tbExercicios (nomeExe, descricao, video, codCat) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("sssi", $nomeExe, $descricao, $video, $codCat);
		if($stmt->execute())
			return true; 			
		return false;
	}


	// Busca e Lista 

	function getAluno(){
		$stmt = $this->con->prepare("SELECT codAlun, nome, senha, sexo, dataNasc, cell, email, ftAlun, cep, estado, cidade, bairro, rua, bairro, num, codPer FROM tbAlunos");
		$stmt->execute();
		$stmt->bind_result($codAlun, $nome, $senha, $sexo, $dataNasc, $cell, $email, $ftAlun, $cep, $estado, $cidade, $bairro, $rua, $bairro, $num, $codPer);
		
		$alunos = array(); 
		
		while($stmt->fetch()){
			$hero  = array();
			$hero['id'] = $id; 
			$hero['name'] = $name; 
			$hero['realname'] = $realname; 
			$hero['rating'] = $rating; 
			$hero['teamaffiliation'] = $teamaffiliation; 
			
			array_push($heroes, $hero); 
		}

		function getLista(){
		$stmt = $this->con->prepare("SELECT id, name, realname, rating, teamaffiliation FROM heroes");
		$stmt->execute();
		$stmt->bind_result($id, $name, $realname, $rating, $teamaffiliation);
		
		$heroes = array(); 
		
		while($stmt->fetch()){
			$hero  = array();
			$hero['id'] = $id; 
			$hero['name'] = $name; 
			$hero['realname'] = $realname; 
			$hero['rating'] = $rating; 
			$hero['teamaffiliation'] = $teamaffiliation; 
			
			array_push($heroes, $hero); 
		}

		function getTreino(){
		$stmt = $this->con->prepare("SELECT id, name, realname, rating, teamaffiliation FROM heroes");
		$stmt->execute();
		$stmt->bind_result($id, $name, $realname, $rating, $teamaffiliation);
		
		$heroes = array(); 
		
		while($stmt->fetch()){
			$hero  = array();
			$hero['id'] = $id; 
			$hero['name'] = $name; 
			$hero['realname'] = $realname; 
			$hero['rating'] = $rating; 
			$hero['teamaffiliation'] = $teamaffiliation; 
			
			array_push($heroes, $hero); 
		}

		function getExercicio(){
		$stmt = $this->con->prepare("SELECT id, name, realname, rating, teamaffiliation FROM heroes");
		$stmt->execute();
		$stmt->bind_result($id, $name, $realname, $rating, $teamaffiliation);
		
		$heroes = array(); 
		
		while($stmt->fetch()){
			$hero  = array();
			$hero['id'] = $id; 
			$hero['name'] = $name; 
			$hero['realname'] = $realname; 
			$hero['rating'] = $rating; 
			$hero['teamaffiliation'] = $teamaffiliation; 
			
			array_push($heroes, $hero); 
		}
		
		return $heroes; 
	}
	
	// Dados que vão ser atualizados no aplicativo 

	function updatePersonal($id, $name, $realname, $rating, $teamaffiliation){
		$stmt = $this->con->prepare("UPDATE heroes SET name = ?, realname = ?, rating = ?, teamaffiliation = ? WHERE id = ?");
		$stmt->bind_param("ssisi", $name, $realname, $rating, $teamaffiliation, $id);
		if($stmt->execute())
			return true; 
		return false; 
	}

	function updateAluno($id, $name, $realname, $rating, $teamaffiliation){
		$stmt = $this->con->prepare("UPDATE heroes SET name = ?, realname = ?, rating = ?, teamaffiliation = ? WHERE id = ?");
		$stmt->bind_param("ssisi", $name, $realname, $rating, $teamaffiliation, $id);
		if($stmt->execute())
			return true; 
		return false; 
	}

	function updateLista($id, $name, $realname, $rating, $teamaffiliation){
		$stmt = $this->con->prepare("UPDATE heroes SET name = ?, realname = ?, rating = ?, teamaffiliation = ? WHERE id = ?");
		$stmt->bind_param("ssisi", $name, $realname, $rating, $teamaffiliation, $id);
		if($stmt->execute())
			return true; 
		return false; 
	}

	function updateTreino($id, $name, $realname, $rating, $teamaffiliation){
		$stmt = $this->con->prepare("UPDATE heroes SET name = ?, realname = ?, rating = ?, teamaffiliation = ? WHERE id = ?");
		$stmt->bind_param("ssisi", $name, $realname, $rating, $teamaffiliation, $id);
		if($stmt->execute())
			return true; 
		return false; 
	}

	function updateExercicio($id, $name, $realname, $rating, $teamaffiliation){
		$stmt = $this->con->prepare("UPDATE heroes SET name = ?, realname = ?, rating = ?, teamaffiliation = ? WHERE id = ?");
		$stmt->bind_param("ssisi", $name, $realname, $rating, $teamaffiliation, $id);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	// Dados que poderão ser deletados

	function deleteLista($id){
		$stmt = $this->con->prepare("DELETE FROM heroes WHERE id = ? ");
		$stmt->bind_param("i", $id);
		if($stmt->execute())
			return true; 
		return false; 
	}

	function deleteTreino($id){
		$stmt = $this->con->prepare("DELETE FROM heroes WHERE id = ? ");
		$stmt->bind_param("i", $id);
		if($stmt->execute())
			return true; 
		return false; 
	}

	function deleteExercicio($id){
		$stmt = $this->con->prepare("DELETE FROM heroes WHERE id = ? ");
		$stmt->bind_param("i", $id);
		if($stmt->execute())
			return true; 
		return false; 
	}
}