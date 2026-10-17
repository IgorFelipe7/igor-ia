# Igor.ia — Plataforma de IA e simulador de IDE

Projeto acadêmico desenvolvido no início do Ensino Médio Técnico em TI. Reúne uma página sobre inteligência artificial, um painel com chat integrado à API da OpenAI e uma simulação visual do Windows 11 com o VS Code.

O projeto foi uma forma de praticar o caminho completo de uma aplicação web: construir a interface, receber dados no PHP, persistir usuários no MySQL e integrar um serviço externo.

## Demonstração

![Demonstração da aplicação](https://i.imgur.com/hZ8WTfd.gif)

## Funcionalidades

- Página informativa sobre ferramentas de IA, com animações e layout em HTML, CSS e JavaScript.
- Simulador de IDE com barra de tarefas, janela do editor, explorador de arquivos e abas.
- Editor com CodeMirror e destaque de sintaxe para Python.
- Cadastro e login, hashing de senhas e gerenciamento de sessões no backend PHP.
- Painel de chat conectado à API da OpenAI pelo backend.

O simulador reproduz a interface de um ambiente de desenvolvimento. A edição de texto no navegador é parte dessa experiência visual.

## Tecnologias

| Camada | Ferramentas |
| --- | --- |
| Interface | HTML, CSS, JavaScript, SVG |
| Backend e dados | PHP, MySQL |
| Integrações | API da OpenAI, CodeMirror, jQuery e AOS |

## Contexto de aprendizado

A atividade começou no primeiro bimestre do curso técnico. Ao expandi-la, pratiquei composição de interfaces, manipulação do DOM, requisições AJAX, sessões e integração entre frontend e backend.

É um registro dessa etapa da minha formação. A demonstração e o código permitem conhecer o escopo; a configuração do chat depende do serviço e do modelo definidos no backend.

EN — Academic full stack project combining an AI information page, a PHP/MySQL user dashboard and a Windows/VS Code interface simulation. Built to practice web interfaces, authentication, data persistence and external API integration.

### ⚙️ Como Executar o Projeto Localmente

Siga os passos abaixo para configurar e rodar a aplicação no seu ambiente local.

1.  **Clone o repositório:**
    ```bash
    git clone https://github.com/IgorFelipe7/igor-ia.git
    cd igor-ia
    ```

2.  **Configure o Banco de Dados:**
    * Crie um banco de dados MySQL para o projeto.
    * Importe a estrutura das tabelas. Você pode usar o seguinte SQL para criar a tabela `users`:
        ```sql
        CREATE TABLE `users` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `nome` varchar(255) NOT NULL,
          `email` varchar(255) NOT NULL,
          `senha` varchar(255) NOT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `email` (`email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ```

3.  **Configure as Credenciais:**
    * Crie um arquivo chamado `config.php` na raiz do projeto.
    * Adicione a este arquivo o código para conexão com o banco de dados, preenchendo com as suas credenciais.
        ```php
        // Exemplo de config.php
        <?php
        $host = 'localhost';
        $dbname = 'nome_do_seu_banco';
        $user = 'seu_usuario_db';
        $pass = 'sua_senha_db';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
        ```

4.  **Configure a Chave da API da OpenAI:**
    * Para que o chat funcione, você precisa configurar a sua chave da API da OpenAI como uma variável de ambiente no seu servidor (Apache, Nginx, etc.). O arquivo `dashboard/panel/getResponseAPI.php` irá procurar pela variável `OPENAI_API_KEY`.

5.  **Execute a Aplicação:**
    * Coloque a pasta do projeto no diretório do seu servidor local (como `htdocs` no XAMPP).
    * Acesse `http://localhost/igoria` (ou o caminho correspondente) no seu navegador.

---

### Autor

**Igor Felipe**

* [LinkedIn](https://www.linkedin.com/in/igorfdev)
* [GitHub](https://github.com/IgorFelipe7)
