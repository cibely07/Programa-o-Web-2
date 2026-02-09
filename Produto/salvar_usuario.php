<?php
$usuario = [
    "id" => $_POST['id'],
    "username" => $_POST['username'],
    "email" => $_POST['email'],
    "password" => password_hash($_POST['password'], PASSWORD_DEFAULT)
];

$usuarios = json_decode(file_get_contents("usuarios.json"), true);
$usuarios[] = $usuario;

file_put_contents("usuarios.json", json_encode($usuarios, JSON_PRETTY_PRINT));
?>

Usuário cadastrado com sucesso!
