var video = document.getElementById("teaserVideo");
video.play();
$('#main').css('display', 'none');
function skipVideo() {
	video.pause();
	$('#intro').css('display', 'none');
    $('#main').css('display', 'block');
    if ($(window).width() > 800){
        particlesJS.load('particles-js', '/js/particles.json', function() {
            console.log('callback - particles.js config loaded');
        });
    }
}

video.onended = function() {
    skipVideo();
};

