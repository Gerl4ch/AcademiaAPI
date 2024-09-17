<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "etecia";
$password = "123456";
$dbname = "bdAppPersonal";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o arquivo foi enviado corretamente
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    // Nome e e-mail recebidos do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    // Pega os dados do arquivo de imagem
    $nomeImagem = $_FILES['foto']['name'];
    $tipoImagem = $_FILES['foto']['type'];
    $tamanhoImagem = $_FILES['foto']['size'];
    $tmpImagem = $_FILES['foto']['tmp_name'];

    // Verifica se o arquivo é uma imagem
    $tipoPermitido = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($tipoImagem, $tipoPermitido)) {
        // Lê o arquivo de imagem e converte para binário
        $imagemBinaria = file_get_contents($tmpImagem);

        // Prepara o SQL para inserir os dados no banco de dados
        $sql = "INSERT INTO tbCategoria (nome, descricao, foto) VALUES (?, ?, ?)";

        // Prepara a instrução
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssb", $nome, $descricao, $imagemBinaria);

        // Executa a query
        if ($stmt->execute()) {
            echo "Imagem enviada e armazenada com sucesso!";
        } else {
            echo "Erro ao armazenar a imagem: " . $stmt->error;
        }

        // Fecha o statement e a conexão
        $stmt->close();
    } else {
        echo "Formato de arquivo inválido. Apenas JPEG, PNG e GIF são permitidos.";
    }
} else {
    echo "Nenhuma imagem foi enviada ou ocorreu um erro no upload.";
}

// Fecha a conexão com o banco
$conn->close();
?>