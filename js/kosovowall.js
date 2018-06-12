// $(".options").click(
//   knowing();
// )
//$(".onbaby").css("back","block");

// $(".s3btn").click(
//   function(){
//     $('#knowing').css("transform","translateX(0%)");
//   }


// function knowing(){
//     $('#knowing').css("transform","translateX(0%)");
//     // $('.knowing-content').text($(this.attr("data"));
// }
var webUrl = "";

$(document).ready(function(){
    knowingToggle(true);
    toggleCarousel();
    getWebURL();
})

function getWebURL(){
    $.get("tool/info_weburl.php", function(result){
        webUrl = result;
    });
}


$('.s3btn').click(function(){
    var wallData = $(this).attr('data');
    var shareData = $(this).attr('share');
    $('.knowing-content').html(wallData);
    knowingToggle(false);
    $('#kwalshare').attr('onclick',"fbShare("+shareData+");");
    
});

$('.s3btn').hover(function(){

    if($(window).width()>=768){
        var target = $(this).attr('target');
        $(target).siblings('').removeClass('active');
        $(target).addClass('active');
    }
    
});


function knowingToggle(toggle){
    if(toggle==true){
        $('#knowing').css("transform","translateX(-105%)");
        //alert(true);
    }else{
        $('#knowing').css("transform","translateX(0%)");
    }
}


$(window).resize(function() {
    toggleCarousel();
});

function toggleCarousel(){
    if($(window).width()<768){
        $('.s3carousel').removeAttr('data-interval');
    }else{
        $('.s3carousel').attr('data-interval','false');
    }
}



function fbShare(sidData){
    
    FB.ui({
        method: 'share',
        display: 'popup',
        href: webUrl+'tool/facebook_share.php?sid='+sidData,
        //hashtag: '#KosovoWall',
    }, function(response){});
}