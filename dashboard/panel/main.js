$(document).ready(function(){
    $('#chat-text').on('keyup', function(event) {
        if (event.key === 'Enter') {
            performAction();
        }
    });

    $('#submit-button').on('click', function() {
        performAction();
    });

    function performAction() {
        var inputValue = $('#chat-text').val();
        $('.texts-content .texts').hide()
        $('#chat-text').val('');
        $('.messages').show();
        var nameId = generateRandomString(10)
        var nameUser = $('.name-user h1').text();
        $('.messages').append(`
            <div class="member-box">
                <div class="user-box">
                    <img src="../../assets/user.png" alt="" width="3.3%">
                    <h1 style="font-size: .8vw;">${nameUser}</h1>
                    <h2 style="font-size: .6vw;">4seg atras</h2>
                </div>
                <p style="font-size: .8vw;">${inputValue}</p>
            </div>

            <div class="member-box" id="${nameId}">
                <div class="user-box">
                    <img src="../../assets/avatar.png" alt="" width="3.3%">
                    <h1 style="font-size: .8vw;">Inteligencia Artificial</h1>
                    <h2 style="font-size: .6vw;">4seg atras</h2>
                </div>
                <div class="dots">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            </div>
        `);
        $.ajax({
            url: 'getResponseAPI.php',
            type: 'POST',
            dataType: 'text',
            data: {mensagem: inputValue},
            success: function(response) {
                console.log(response)
                $('#' + nameId).html(`    
                <div class="user-box">
                    <img src="../../assets/avatar.png" alt="" width="3.3%">
                    <h1 style="font-size: .8vw;">Inteligencia Artificial</h1>
                    <h2 style="font-size: .6vw;">4seg atras</h2>
                </div>
                <p style="font-size: .8vw;">${response}</p>
            </div>    
                `);
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });
    }

    function generateRandomString(length) {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let result = '';
        for (let i = 0; i < length; i++) {
          result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }
});