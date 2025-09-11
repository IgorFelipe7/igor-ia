AOS.init();

$(document).ready(function() {

    $('#access').click(function() {
      window.location.href = 'dashboard/index.php';
    });
    $('#explore').click(function() {
        window.location.href = 'vscode/index.html';
    });
    $('.cardArtificial').click(function() {
        var ia = $(this).attr('ia');
        window.location.href = 'ia/index.html?ia=' + ia;
    });

    $('.navbar a').click(function(){
        if(this.hash !== "") {
            event.preventDefault();

            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){
                window.location.hash = hash;
            });
        }
    });

    animateShadows();
      
});

function animateShadows() {
    const shadowDuration = 3000;
    const shadowDelay = 100;

    anime({
        targets: '#shadow1',
        translateX: [50, 0],
        opacity: [0, 0.3],
        duration: shadowDuration,
        easing: 'easeInOutQuad',
        delay: shadowDelay,
        direction: 'alternate',
        loop: true
    });

    anime({
        targets: '#shadow2',
        translateX: [50, 0],
        opacity: [0, 0.3],
        duration: shadowDuration,
        easing: 'easeInOutQuad',
        delay: shadowDelay + 200,
        direction: 'alternate',
        loop: true
    });

    anime({
        targets: '#shadow3',
        translateX: [50, 0],
        opacity: [0, 0.3],
        duration: shadowDuration,
        easing: 'easeInOutQuad',
        delay: shadowDelay + 400,
        direction: 'alternate',
        loop: true
    });
}

