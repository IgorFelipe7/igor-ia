# Igor.ia • Plataforma de IA com Simulador de IDE

*Uma aplicação web full-stack que combina uma landing page sobre Inteligência Artificial, um painel de usuário com chat integrado à API da OpenAI e uma impressionante **simulação visual de um ambiente de desenvolvimento no Windows 11**, criada como projeto de destaque no início do Ensino Médio Técnico em TI.*

---

### демонстрация (Demonstração)

![Gif da Aplicação](https://i.imgur.com/AAQnZF5.gif)

---

### ✨ Sobre o Projeto

O que começou como uma atividade avaliativa para o **primeiro bimestre do primeiro ano do Ensino Médio Técnico em TI**, rapidamente se tornou um projeto de paixão para explorar e aplicar conceitos avançados de desenvolvimento web.

O objetivo era ir além dos requisitos básicos e construir uma aplicação completa que fosse tecnicamente desafiadora e visualmente única. O resultado é o **Igor.ia**, um projeto que demonstra uma atenção meticulosa aos detalhes e habilidades em front-end, back-end e integração de APIs.

---

### 🚀 Funcionalidades Principais

* 🌐 **Landing Page Informativa:** Apresenta de forma clara e bonita informações sobre diversas Inteligências Artificiais.
* 🖥️ **Simulador de Ambiente de Desenvolvimento (IDE):** A peça central do projeto. Uma interface totalmente construída com **HTML, CSS e JavaScript** que recria com alta fidelidade a aparência do Windows 11 com o Visual Studio Code aberto. Inclui:
    * **Barra de Tarefas Funcional:** Com ícones de sistema e aplicativos.
    * **Janela do VS Code Detalhada:** Com cabeçalho, menus, abas de arquivos com ícones específicos de linguagem, painel de explorador de arquivos e um editor de código funcional.
    * **Editor de Código Real:** Utiliza a biblioteca **CodeMirror** para oferecer um campo de digitação com *syntax highlighting* para Python, simulando uma experiência de codificação real.
* 🔒 **Sistema de Autenticação Completo:** Usuários podem se registrar e fazer login de forma segura. O back-end utiliza hashing para proteger as senhas.
* 🤖 **Dashboard com Chat de IA:** Após o login, o usuário tem acesso a um painel com um chat funcional integrado diretamente à **API da OpenAI (GPT-3.5-turbo)**.
* 🔑 **Gerenciamento de Sessão:** A autenticação e as sessões são gerenciadas de forma segura no back-end com **PHP**.

---

### 🛠️ Tecnologias Utilizadas

Este projeto foi construído com as seguintes tecnologias:

* **Front-End:**
    * HTML5
    * CSS3 (com uso extensivo de `flexbox`, `grid` e SVGs)
    * JavaScript
* **Back-End:**
    * PHP
* **Banco de Dados:**
    * MySQL
* **APIs e Bibliotecas:**
    * **OpenAI API:** Para a funcionalidade do chat de IA.
    * **CodeMirror:** Para o simulador de editor de código.
    * **jQuery:** Para manipulação do DOM e requisições AJAX.
    * **AOS (Animate On Scroll):** Para as animações na landing page.

---

### 🌟 O Que Este Projeto Representa

* **Fundamentos Sólidos Desde o Início:** Demonstra um forte domínio dos conceitos fundamentais de desenvolvimento web, aplicados em um estágio inicial da jornada de aprendizado.
* **Ambição e Proatividade:** Mostra a iniciativa de ir além do esperado para uma atividade acadêmica, transformando-a em um portfólio robusto e memorável.
* **Atenção Excepcional aos Detalhes:** A recriação fiel da interface do VS Code, incluindo ícones, menus e layout, prova uma habilidade rara de transformar um conceito em uma execução precisa.
* **Aprendizagem Rápida:** A combinação de tantas tecnologias diferentes (front-end complexo, back-end seguro, API externa) evidencia uma alta capacidade de aprender e aplicar novos conhecimentos de forma eficaz.

---

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