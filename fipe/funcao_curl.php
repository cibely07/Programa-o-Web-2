<?php

function consultarAPI($url) {
    $ch = curl_init();
    
   
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retorna o resultado como string [cite: 2]
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Apenas para teste local [cite: 2]
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Máximo 10 segundos [cite: 2]

    $resposta = curl_exec($ch);
    $erro = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);

    
    if ($erro || $httpCode !== 200) {
        return [
            'erro' => true,
            'httpCode' => $httpCode,
            'mensagem' => $erro ? $erro : "Falha na requisição: HTTP $httpCode"
        ];
    }

   
    $dados = json_decode($resposta, true);


    if (json_last_error() !== JSON_ERROR_NONE) {
        return ['erro' => true, 'mensagem' => 'JSON inválido: ' . json_last_error_msg()];
    }

    return $dados;
}
?>