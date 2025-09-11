function formatarHoraData(data) {
    var hora = data.getHours();
    var minutos = data.getMinutes();

    hora = hora < 10 ? '0' + hora : hora;
    minutos = minutos < 10 ? '0' + minutos : minutos;

    return hora + ':' + minutos;
}

function atualizarInformacoesTempoReal() {
    var dataAtual = new Date();
    var horaFormatada = formatarHoraData(dataAtual);

    $('#hora').text(horaFormatada);
    $('#data').text(dataAtual.toLocaleDateString());
}

atualizarInformacoesTempoReal();

setInterval(atualizarInformacoesTempoReal, 1000);

const defaultValue = `
    from transformers import GPT2LMHeadModel, GPT2Tokenizer

    # Carregar o modelo GPT-2 pré-treinado e o tokenizador
    model_name = 'gpt2'
    model = GPT2LMHeadModel.from_pretrained(model_name)
    tokenizer = GPT2Tokenizer.from_pretrained(model_name)

    # Texto de entrada
    input_text = "Olá, como você está?"

    # Tokenizar e gerar resposta
    input_ids = tokenizer.encode(input_text, return_tensors='pt')
    output = model.generate(input_ids, max_length=100, num_beams=5, no_repeat_ngram_size=2, top_k=50, top_p=0.95)

    # Decodificar a saída
    output_text = tokenizer.decode(output[0], skip_special_tokens=True)
    print(output_text)

`;

const inputCode = document.getElementById('inputCode');

inputCode.value = defaultValue;

const editor = CodeMirror.fromTextArea(inputCode, {
    mode: 'python',
    theme: 'dracula',
    indentUnit: 4, 
    smartIndent: true,
    lineWrapping: true,
    styleActiveLine: true,
    styleSelectedText: true,
});
