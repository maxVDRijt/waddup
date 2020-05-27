require('./bootstrap');

$(document).ready(() => {
    var scrolled = false;
    function updateScroll(){
        if(!scrolled){
            var element = document.getElementsByClassName("chat-message");
            element.scrollTop = element.scrollHeight;
        }
    }

    $(".chat-message").on('scroll', function(){
        scrolled=true;
    });
});
