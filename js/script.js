if ($(window).width() < 800){
    var menu = '<ul id="slide-out" class="side-nav" style="background: #1a1a1a;">';
    menu = menu + '<li><div class="background">';
    menu = menu + '<img src="/images/logo.jpg" height="50" width="50" style="margin-top: 20px;border-radius:50%;">';
    menu = menu + '</div></li>';
    menu = menu + '<li><a href="/#" style="color:#00bebe;">Home</a></li>';
    menu = menu + '<li><a href="/events" style="color:#00bebe;">Events</a></li>';
    menu = menu + '<li><a href="/#aboutUs" style="color:#00bebe;">About Us</a></li>';
    menu = menu + '<li><a href="/#ourTeam" style="color:#00bebe;">Our Team</a></li>';
    menu = menu + '<li><a href="/#footer" style="color:#00bebe;">Contact</a></li>';
    menu = menu + '<li><a href="/register" style="color:#00bebe;">Register</a></li>';
    menu = menu + '<li><a href="/sponsors" style="color:#00bebe;">Sponsors</a></li>';
    menu = menu + '<li><a href="schedule.pdf" style="color:#00bebe;">Schedule</a></li>';
    menu = menu + '</ul>';
    menu = menu + '<a href="#" data-activates="slide-out" class="btn btn-floating cyan pulse button-collapse"><i class="material-icons">arrow_forward</i></a>';

    $('#header').html(menu);
    $('#header').css('box-shawdow', 'none');
    $('#header').css('position', 'static');

    $('.button-collapse').sideNav({
        menuWidth: 230, // Default is 300
        closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
        draggable: true, // Choose whether you can drag to open on touch screens,
        onOpen: function(el) {}
    });
}else{
    // Hide Header on on scroll down
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('#header').outerHeight();

    $(window).scroll(function(event){
        didScroll = true;
    });

    setInterval(function() {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);

    function hasScrolled() {
        console.log("hasScrolled");
        var st = $(this).scrollTop();
        
        // Make sure they scroll more than delta
        if(Math.abs(lastScrollTop - st) <= delta)
            return;
        
        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > navbarHeight){
            // Scroll Down
            $('#header').removeClass('animated flipInX nav-down').addClass('animated flipOutX');
        } else {
            // Scroll Up
            if(st + $(window).height() < $(document).height()) {
                $('#header').removeClass('animated flipOutX').addClass('nav-down animated flipInX');
            }
        }
        
        lastScrollTop = st;
    }
}

function validateText(element)
{
    var textPattern =  /^[A-Za-z ]{2,40}$/;
    var flag = 0;
    if(element.value == null || !textPattern.test(element.value)){
        flag = 1;
    }
    if(flag==0){
      $(element).removeClass("invalid");
      $(element).addClass("valid");
      element.valid = true;
    }else{
        $(element).removeClass("valid");
        $(element).addClass("invalid");
        element.valid = false;
    }
}

function validateNumber(element)
{
    var Pattern =  /^[0-9]{10,10}$/;
    var flag = 0;
    if(element.value == null || !Pattern.test(element.value)){
        flag = 1;
    }
    if(flag==0){
      $(element).removeClass("invalid");
      $(element).addClass("valid");
      element.valid = true;
    }else{
        $(element).removeClass("valid");
        $(element).addClass("invalid");
        element.valid = false;
    }
}

function validateEmail(element)
{
    var Pattern =  /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    var flag = 0;
    if(element.value == null || !Pattern.test(element.value)){
        flag = 1;
    }
    if(flag==0){
      $(element).removeClass("invalid");
      $(element).addClass("valid");
      element.valid = true;
    }else{
        $(element).removeClass("valid");
        $(element).addClass("invalid");
        element.valid = false;
    }
}
    
