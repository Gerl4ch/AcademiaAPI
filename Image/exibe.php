<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "etecia";
$password = "123456";
$dbname = "bdAppPersonal";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta SQL para obter os dados dos usuários
$sql = "SELECT nome, descricao, foto FROM tbCategoria";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Percorre todos os resultados
    while ($row = $result->fetch_assoc()) {
        echo "Nome: " . $row['nome'] . "<br>";
        echo "Descrição: " . $row['descricao'] . "<br>";
        
        // Exibe a imagem codificada em Base64
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['foto']) . '" width="400"/><br><br>';
    }
} else {
    echo "Nenhum dado encontrado.";
}

$conn->close();
?>