<?php

require_once 'funcao_curl.php';


function exibirErro($resultado) {
    if (isset($resultado['httpCode']) && $resultado['httpCode'] == 429) {
        echo "<div style='background-color:#fff3cd; border:2px solid #ffc107; padding:15px; margin:10px 0; border-radius:5px;'>";
        echo "<p style='color:#856404; margin:0;'><strong>⚠️ Limite de Requisições Excedido (Erro 429)</strong></p>";
        echo "<p style='color:#856404; margin:5px 0;'>A API atingiu o limite de requisições. Tente novamente em alguns minutos.</p>";
        echo "</div>";
    } else {
        echo "<p style='color:red;'><strong>Erro:</strong> {$resultado['mensagem']}</p>";
    }
}

$baseUrl = "https://parallelum.com.br/fipe/api/v1/carros/marcas";
 
$marcaId  = $_GET['marca'] ?? null;
$modeloId = $_GET['modelo'] ?? null;
$anoId    = $_GET['ano'] ?? null;

echo "<h1>Consulta Tabela FIPE (2026)</h1>";

if (!$marcaId) {
    $marcas = consultarAPI($baseUrl);
    if (isset($marcas['erro'])) {
        exibirErro($marcas);
    } else {
        echo "<h3>Selecione uma Marca:</h3><ul>";
        foreach ($marcas as $m) {
            echo "<li><a href='?marca={$m['codigo']}'>{$m['nome']}</a></li>";
        }
        echo "</ul>";
    }

} elseif ($marcaId && !$modeloId) {
    $resultado = consultarAPI("$baseUrl/$marcaId/modelos");
    if (isset($resultado['erro'])) {
        exibirErro($resultado);
    } else {
        echo "<h3>Selecione o Modelo:</h3><ul>";
        foreach ($resultado['modelos'] as $mod) {
            echo "<li><a href='?marca=$marcaId&modelo={$mod['codigo']}'>{$mod['nome']}</a></li>";
        }
        echo "</ul><a href='index.php'>[ Voltar ]</a>";
    }

} elseif ($modeloId && !$anoId) {
    $anos = consultarAPI("$baseUrl/$marcaId/modelos/$modeloId/anos");
    if (isset($anos['erro'])) {
        exibirErro($anos);
    } else {
        echo "<h3>Selecione o Ano:</h3><ul>";
        foreach ($anos as $a) {
            echo "<li><a href='?marca=$marcaId&modelo=$modeloId&ano={$a['codigo']}'>{$a['nome']}</a></li>";
        }
        echo "</ul><a href='?marca=$marcaId'>[ Voltar ]</a>";
    }

} else {
    $final = consultarAPI("$baseUrl/$marcaId/modelos/$modeloId/anos/$anoId");
    if (isset($final['erro'])) {
        exibirErro($final);
    } else {
        echo "<h2>Resultado Final:</h2>";
        echo "<strong>Veículo:</strong> {$final['Modelo']}<br>";
        echo "<strong>Valor:</strong> {$final['Valor']}<br>";
        echo "<strong>Mês:</strong> {$final['MesReferencia']}<br><br>";
        echo "<a href='index.php'>Fazer Nova Consulta</a>";
    }
}

?>
