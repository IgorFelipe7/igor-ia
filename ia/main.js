var url = new URL(window.location.href);

var aiParameterValue = url.searchParams.get("ia");

if (aiParameterValue !== null) {
    console.log(aiParameterValue)
    switch(aiParameterValue) {
        case "1":
            $('.home-texts h2').html('Ia de Texto_')
            $('.home-texts h1').html('Chat GPT')
            $('.home-texts p').html('O Chat GPT é um tipo de programa de computador que pode conversar com as pessoas como se fosse um humano. Ele funciona usando uma tecnologia chamada inteligência artificial para entender o que as pessoas dizem e responder de maneira apropriada. Basicamente, ele aprende com muitas conversas que teve antes e usa esse conhecimento para responder às perguntas e interagir com as pessoas de forma natural.')
            break;
        case "2":
            $('.home-texts h2').html('Ia de Texto_')
            $('.home-texts h1').html('Gemini')
            $('.home-texts p').html('Gemini é uma nova tecnologia inteligente criada pelo Google, que substitui o antigo Bard. Ela é especial porque consegue entender e lidar com muitos tipos diferentes de informação, como palavras escritas, fotos, vídeos, sons e até mesmo códigos de computador. Isso quer dizer que você pode falar com o Gemini, escrever para ele ou até mesmo mostrar imagens para que ele entenda o que você quer.')
            break;
        case "3":
            $('.home-texts h2').html('Ia de Voz_')
            $('.home-texts h1').html('Siri')
            $('.home-texts p').html('A Siri é um assistente virtual da Apple que usa inteligência artificial. Ela responde a comandos de voz e ajuda com tarefas como enviar mensagens e definir lembretes. A Siri funciona ouvindo o que você diz, entendendo sua solicitação e executando a ação desejada.')
            break;
        case "4":
            $('.home-texts h2').html('Ia de Imagem_')
            $('.home-texts h1').html('DALL-E')
            $('.home-texts p').html('Criada pela OpenAI,     a DALL-E 2 é uma IA que gera imagens a partir de descrições por texto. Ela permite criar imagens realistas e até mesmo surrealistas, com alto nível de detalhamento e qualidade. A DALL-E 2 ainda está em fase de testes, mas já tem potencial para revolucionar a forma como criamos e consumimos conteúdo visual.')
            break;
        case "5":
            $('.home-texts h2').html('Ia de Texto_')
            $('.home-texts h1').html('LaMDA')
            $('.home-texts p').html('Desenvolvida pelo Google AI, a LaMDA (Language Model for Dialogue Applications) é um modelo de linguagem factual capaz de gerar diálogos e textos realistas em português e outros idiomas. Ela pode ser utilizada para diversos fins, como chatbots, assistentes virtuais e ferramentas de criação de conteúdo.')
            break;
        case "6":
            $('.home-texts h2').html('Ia de Texto_')
            $('.home-texts h1').html('WuDao 2.0')
            $('.home-texts p').html('Desenvolvida pela Academia Chinesa de Ciências, a WuDao 2.0 é um modelo de linguagem multimodal que integra diversas habilidades, como processamento de linguagem natural, visão computacional e geração de texto e imagem. Ela é considerada uma das IAs mais avançadas do mundo e tem potencial para ser utilizada em diversas áreas, como saúde, educação e indústria.')
            break;
    }
}