<?php_

$novoProduto = [
$id => $_POST['id']
$title => $_POST['title']
$price => $_POST['price']
$description => $_POST['description']
$category => $_POST['category']
$image => $_POST['image']
];

$arquivo = "produtos.json";

$dadosJson = file_get_contents($arquivo);
$produtos = json_decode($dadosJson, true);

$produtos[] = $novoProduto;


file_put_contents($arquivo, json_encode($produtos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produto Salvo</title>
</head>
<body>

<h2>Produto Cadastrado com sucesso</h2>
<pre>
    <?php print_r($novoProduto); ?>
</pre>
<a href="formulatio.html">Voltar para o formulário</a>

</body>
</html>