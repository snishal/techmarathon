odoo.default({ el: '.js-odoo', from: '', to: 'TECHMARATHON', animationDelay: 1000 });
setTimeout(
    function() {
        $('#headline').addClass('animated fadeOutUpBig');
    }, 6000);
setTimeout(function() {
    $('#headline').removeClass('animated fadeOutUpBig');
    $('#headline').addClass('animated zoomIn');
    $('#headline').html("EVEN MORE BIGGER");
    var headText = new WordShuffler(headline, {
        textColor: '#fff',
        timeOffset: 5,
        mixCapital: true,
        mixSpecialCharacters: true
    });
}, 6300);
setTimeout(
    function() {
        $('#headline').html('');
        $('#headline').css('background', '#00bebe');
        $('#headline').removeClass('js-odoo animated zoomIn');
        $('#headline').addClass('pulse');
    }, 11000);

setTimeout(
    function() {
        document.body.style.background = '#00bebe'
    }, 13000);
setTimeout(
    function() {
        document.body.style.background = 'black'
        $('#headline').css('display', "none");
        $('#main').css('display', "block");
        particlesJS.load('particles-js', '/js/particles.json', function() {
            console.log('callback - particles.js config loaded');
        });
    }, 13500);