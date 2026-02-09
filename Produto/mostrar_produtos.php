<?php
$conteudo = file_get_contents("produtos.json");
$produtos = json_decode($conteudo, true);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
</head>
<body>

<h2>Lista de Produtos</h2>

<?php foreach ($produtos as $p): ?>
    <hr>
    <p><strong>ID:</strong> <?= $p['id'] ?></p>
    <p><strong>Título:</strong> <?= $p['title'] ?></p>
    <p><strong>Preço:</strong> R$ <?= $p['price'] ?></p>
    <p><strong>Descrição:</strong> <?= $p['description'] ?></p>
    <p><strong>Categoria:</strong> <?= $p['category'] ?></p>
    <p><strong>Imagem:</strong> <?= $p['image'] ?></p>
<?php endforeach; ?>

</body>
</html>