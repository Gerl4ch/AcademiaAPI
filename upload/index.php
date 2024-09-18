<?php
include("conexao.php");

if(isset($_FILES['arquivo'])) {

    // Nome e e-mail recebidos do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $arquivo = $_FILES['arquivo'];
    if($arquivo['error'])
    die("Falha ao enviar arquivo");

if ($arquivo['size'] > 2097152)
    die("Arquivo muito grande!!! Max: 2mb");

$pasta = "Arquivos/";
$nomeDoArquivo = $arquivo['name'];
$novoNomeDoArquivo = uniqid();
$extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

if ($extensao != "jpg" && $extensao != 'png')
    die("Tipo de arquivo não aceito");

$foto = $pasta . $novoNomeDoArquivo . "." . $extensao;
$deu_certo = move_uploaded_file($arquivo["tmp_name"], $foto);
if($deu_certo){
    $mysql->query("INSERT INTO tbCategoria (nome, descricao, foto) VALUES('$nome', '$descricao','$foto')") or die($mysql->error);
    echo "<p>Arquivo enviado com sucesso! </p>";
}else
    echo "<p>Falha ao enviar arquivos</p>";
    
}

$sql_query = $mysql->query("SELECT * FROM tbCategoria") or die($mysql->error);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Imagem</title>
</head>
<body>
        <form method= "POST" enctype="multipart/form-data" action="">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br><br>

        <label for="email">Descrição:</label>
        <input type="descricao" name="descricao" required><br><br>
        <p><label for="">Escolha a imagem:</label>
        <input name="arquivo" type="file"></p>
        <input name= "upload" type="submit" value="Enviar">
    </form>

    <h1> Lista de Imagens </h1>
    <table border = "1" cellpadding="10" >
        <thead>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Imagem</th>
        </thead>
        <tbody>
        <?php
    while($arquivo = $sql_query->fetch_assoc()){
    ?>
            <tr>
                <td><?php echo $arquivo['nome'];?></td>
                <td><?php echo $arquivo['descricao'];?></td>
                <td><img height = 80 src="<?php echo $arquivo['foto'];?>" alt=""></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    

</body>
</html>