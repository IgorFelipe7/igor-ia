<?php

declare(strict_types=1);

function fetchAuthenticatedUser(PDO $pdo, int $userId): ?array
{
    $stmt = $pdo->prepare('SELECT nome FROM users WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user ?: null;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userId = $_SESSION['user_id'] ?? null;

if (!is_int($userId)) {
    header('Location: ../');
    exit();
}

$pdo = require __DIR__ . '/../config.php';

$userData = fetchAuthenticatedUser($pdo, $userId);

if ($userData === null) {
    session_unset();
    session_destroy();
    header('Location: ../');
    exit();
}

$userName = htmlspecialchars($userData['nome'], ENT_QUOTES, 'UTF-8');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>IgorAi</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.3.4/dist/aos.css" />
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.3.4/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <div class="sidebar" data-aos="slide-right" data-aos-duration="800">
        <div class="title-sidebar">
            <img src="../../assets/avatar.png" alt="Foto Ia">
            
            <div class="texts-title-sidebar">
                <h1>Igor.Ai</h1>
                <h2>12 membros</h2>
            </div>
        </div>
        <div class="general">
            <h1>Geral</h1>
            <nav>
                <div class="option">
                    <img src="../../assets/search.png" alt="">
                    <h2>Pesquisar</h2>
                </div>
                <div class="option">
                    <img src="../../assets/search.png" alt="">
                    <h2>Contas</h2>
                </div>
            </nav>
        </div>
        <div class="projects">
            <h1>Projetos</h1>
            <nav>
                <div class="option" id="select-side">
                    <img src="../../assets/square.png" alt="">
                    <h2>Igor Felipe</h2>
                </div>
                <div class="option">
                    <img src="../../assets/triangle.png" alt="">
                    <h2>1 TIC</h2>
                </div>
                <div class="option">
                    <img src="../../assets/square-orange.png" alt="">
                    <h2>Professor Samuel</h2>
                </div>
                <div class="option">
                    <img src="../../assets/octagon.png" alt="">
                    <h2>To sem criatividade</h2>
                </div>
                <div class="option" id="add">
                    <img src="../../assets/plus-circle.png" alt="">
                    <h2>Novo projeto</h2>
                </div>
            </nav>
        </div>
        <div class="user">
            <img src="../../assets/user.png" alt="">
            <div class="name-user">
                <h1><?= $userName ?></h1>
                <h2>Premium</h2>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M12 10C13.1046 10 14 10.8954 14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10Z" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6.90136 6.7469C5.96492 6.20624 4.76749 6.52709 4.22684 7.46353L4.1851 7.53583C3.64424 8.47263 3.96521 9.67051 4.902 10.2114L5.1448 10.3515C5.71742 10.6821 6 11.3388 6 12C6 12.6612 5.71742 13.3179 5.1448 13.6485L4.902 13.7886C3.96521 14.3295 3.64424 15.5274 4.1851 16.4642L4.22684 16.5365C4.7675 17.4729 5.96492 17.7938 6.90136 17.2531L7.14546 17.1122C7.71803 16.7816 8.42331 16.863 8.9953 17.1946C9.56711 17.526 10 18.1005 10 18.7614V19.0427C10 20.1237 10.8763 21 11.9573 21H12.0427C13.1237 21 14 20.1237 14 19.0427V18.7614C14 18.1005 14.4329 17.5261 15.0047 17.1946C15.5767 16.863 16.282 16.7816 16.8545 17.1122L17.0986 17.2531C18.0351 17.7938 19.2325 17.4729 19.7732 16.5365L19.8149 16.4642C20.3558 15.5274 20.0348 14.3295 19.098 13.7886L18.8552 13.6485C18.2826 13.3179 18 12.6612 18 12C18 11.3388 18.2826 10.6821 18.8552 10.3515L19.098 10.2114C20.0348 9.6705 20.3558 8.47262 19.8149 7.53581L19.7732 7.46353C19.2325 6.52709 18.0351 6.20623 17.0986 6.74689L16.8545 6.88783C16.282 7.2184 15.5767 7.13699 15.0047 6.80541C14.4329 6.47395 14 5.89952 14 5.23859V4.95728C14 3.8763 13.1237 3 12.0427 3L11.9573 3C10.8763 3 10 3.8763 10 4.95727V5.23858C10 5.89952 9.56711 6.47395 8.9953 6.80542C8.42331 7.13699 7.71803 7.2184 7.14546 6.88783L6.90136 6.7469Z" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
    <div class="content">
        <div class="topbar">
            <div class="heading">
                <div class="texts">
                    <h1>Simulação Inteligencia Artificial</h1>
                    <p>Redesign inspirado no Chat GPT</p>
                </div>
                <button>
                    <img src="../../assets/edit.svg" alt="Edição">
                </button>
            </div>
            <div class="navigation">
                <div class="navbar">
                    <a href="#" id="selected">
                        <img src="../../assets/artificium.svg" alt="">
                        <span>Artificial</span>
                    </a>
                    <a href="#">
                        <img src="../../assets/chat.svg" alt="">
                        Chat
                    </a>
                    <a href="#">
                        <img src="../../assets/folder.svg" alt="">
                        Biblioteca
                    </a>
                </div>
            </div>
        </div>
        <div class="texts-content">
            <div class="messages"></div>
            <div class="texts">
                <h1>Início da Inovação</h1>
                <p>Inicie o seu processo de inovação com a nossa seleção de sugestões predefinidas.</p>
                <div class="content-cols">
                    <div class="card">
                        <div class="content-card">
                            <div class="logo">
                                <img src="../../assets/green-chat.png" alt="">
                            </div>
                            <h1>Recursos Criativos</h1>
                            <div class="buttons">
                                <button>
                                    <span>Interface do usuário</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button>
                                    <span>Design de flyers</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                
                                <button>
                                    <span>Mídias sociais</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                
                                <button>
                                    <span>Diretrizes de marca</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="content-card">
                            <div class="logo">
                                <img src="../../assets/code.png" alt="">
                            </div>
                            <h1>Ferramentas Dev</h1>
                            <div class="buttons">
                                <button>
                                    <span>Integração de API</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button>
                                    <span>Automação de teste</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button>
                                    <span>Otimização DB</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button>
                                    <span>Revisão do código</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="content-card">
                            <div class="logo">
                                <img src="../../assets/pencil.png" alt="">
                            </div>
                            <h1>Criação Conteúdo</h1>
                            <div class="buttons">
                                <button>
                                    <span>Descrição de Produto</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button>
                                    <span>Texto de Email</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button>
                                    <span>Whitepaper</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button>
                                    <span>Nota a Imprensa</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="content-card">
                            <div class="logo">
                                <img src="../../assets/luz.png" alt="">
                            </div>
                            <h1>Gerador de Ideias</h1>
                            <div class="buttons">
                                <button>
                                    <span>Ideias de Hashtags</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button>
                                    <span>Brainstorming</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button>
                                    <span>Análise de Tendência</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <button>
                                    <span>Redes Sociais</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M14 8L10 4M14 8L10 12M14 8L2 8" stroke="#686B6E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat">
            <input id="chat-text" placeholder="Digite aqui" type="text">
            <button id="submit-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9.73084 14.2692L19.2337 4.76642M5.48664 7.99807L17.1349 4.11532C18.8344 3.54883 20.4512 5.16564 19.8847 6.8651L16.0019 18.5134C15.3895 20.3507 12.8613 20.5304 11.9952 18.7981L10.0548 14.9174C9.84447 14.4967 9.50334 14.1555 9.08263 13.9452L5.20188 12.0048C3.46962 11.1387 3.64929 8.61052 5.48664 7.99807Z" stroke="#CDCECF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>
    <script src='../../main.js'></script>
    <script src='main.js'></script>
</body>
</html>