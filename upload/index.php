<?php


if(isset($_FILES['arquivo'])) {
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

$deu_certo = move_uploaded_file($arquivo["tmp_name"], $pasta . $novoNomeDoArquivo . "." . $extensao);
if($deu_certo)
    echo "<p>Arquivo enviado com sucesso! Para acessá-lo, <a target=\"_blank\" href=\"Arquivos/$novoNomeDoArquivo.$extensao\">clique aqui.</a></p>";
else
    echo "<p>Falha ao enviar arquivos</p>";
    
}
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
        <p><label for="">Escolha a imagem:</label>
        <input name="arquivo" type="file"></p>
        <input name= "upload" type="submit" value="Enviar">
    </form>
</body>
</html>