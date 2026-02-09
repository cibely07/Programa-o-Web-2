<?php
$novo = [
    "id" => $_POST['id'],
    "title" => $_POST['title'],
    "price" => $_POST['price'],
    "description" => $_POST['description'],
    "category" => $_POST['category'],
    "image" => $_POST['image']
];

$dados = json_decode(file_get_contents("produtos.json"), true);
$dados[] = $novo;

file_put_contents("produtos.json", json_encode($dados, JSON_PRETTY_PRINT));
?>

Produto salvo com sucesso!
