/*$('#main').css('display', "none");
$( document ).ready(function() {
    odoo.default({ el: '.js-odoo', from: '', to: 'TECHMARATHON', animationDelay: 1000 });
    setTimeout(
        function() {
            $('#headline').addClass('animated fadeOutUpBig');
        }, 6000);
    setTimeout(function() {
        $('#headline').removeClass('animated fadeOutUpBig');
        $('#headline').addClass('animated zoomIn');
        $('#headline').html("EVEN MORE BIGGER");
        $('#headline').css('color', "#00bebe");
        $('#headline').addClass('pulse');
    }, 6300);
    setTimeout(
        function() {
            document.body.style.background = '#00bebe'
        }, 9000);
    setTimeout(
        function() {
            */document.body.style.background = 'black'
            $('#headline').css('display', "none");
            $('#main').css('display', "block");
            /*if ($(window).width() > 500){
                particlesJS.load('particles-js', '/js/particles.json', function() {
                    console.log('callback - particles.js config loaded');
                });
            }*/
        //}, 9100);
    
//});