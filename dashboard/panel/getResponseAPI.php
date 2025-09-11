<?php

declare(strict_types=1);

define('OPENAI_API_ENDPOINT', 'https://api.openai.com/v1/chat/completions');
define('AI_MODEL', 'gpt-3.5-turbo');
define('GENERIC_ERROR_MESSAGE', 'Nao consigo te ajudar agora.');

function sendJsonResponse(string $status, array $data, int $http_code = 200): void
{
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($http_code);
    echo json_encode(['status' => $status] + $data);
    exit;
}

function handleError(\Throwable $exception): void
{
    error_log('OpenAI API Error: ' . $exception->getMessage());
    sendJsonResponse('error', ['message' => GENERIC_ERROR_MESSAGE], 500);
}

set_exception_handler('handleError');

$apiKey = getenv('OPENAI_API_KEY');
if ($apiKey === false || empty($apiKey)) {
    throw new \RuntimeException('A variável de ambiente OPENAI_API_KEY não está configurada no servidor.');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse('error', ['message' => 'Método não permitido. Use POST.'], 405);
}

$mensagemUsuario = trim($_POST['mensagem'] ?? '');
if (empty($mensagemUsuario)) {
    sendJsonResponse('error', ['message' => 'O campo "mensagem" é obrigatório.'], 400);
}

try {
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey,
    ];

    $postData = [
        'model' => AI_MODEL,
        'messages' => [
            ['role' => 'system', 'content' => 'You are a helpful assistant.'],
            ['role' => 'user', 'content' => $mensagemUsuario],
        ],
        'max_tokens' => 150,
        'temperature' => 0.7,
    ];

    $ch = curl_init(OPENAI_API_ENDPOINT);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $responseJson = curl_exec($ch);
    $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        throw new \RuntimeException('Falha na comunicação cURL: ' . curl_error($ch));
    }

    curl_close($ch);

    if ($httpStatusCode !== 200) {
        throw new \RuntimeException("A API da OpenAI retornou um status HTTP inesperado: {$httpStatusCode}. Resposta: {$responseJson}");
    }

    $responseArray = json_decode($responseJson, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new \RuntimeException('Falha ao decodificar a resposta JSON da API.');
    }

    $conteudoResposta = $responseArray['choices'][0]['message']['content'] ?? null;
    if ($conteudoResposta === null) {
        throw new \RuntimeException('A resposta da API não contém o conteúdo esperado.');
    }

    sendJsonResponse('success', ['response' => trim($conteudoResposta)]);

} catch (\Throwable $e) {
    handleError($e);
}