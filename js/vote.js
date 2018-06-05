//vote.js index_s4 Section Event with Ajax

$(document).ready(function(){
    getCookieVoteVal();
});


function getCookieVoteVal(){
    $.get("tool/vote_checked.php", function(result){
        if(result!='false'){
            var obj = JSON.parse(result);
            for (i = 0; i < obj.length; i++) { 
                $('#vote_'+obj[i]).addClass('btn-outline-secondary_active');
            }
        }
    });
}

function voteEvent(element,Voteval){
    var onClickElement = jQuery(element);
    var activeClass = 'btn-outline-secondary_active';
    if(onClickElement.hasClass(activeClass)){
        $.post("tool/vote_remove.php",{val:Voteval},function(result){
            if(result=='true'){
                onClickElement.removeClass(activeClass);
            }else{
                alert(result);
            }
        });
    }else{
        $.post("tool/vote_add.php",{val:Voteval},function(result){
            if(result=='true'){
                onClickElement.addClass(activeClass);
            }else{
                alert(result);
            }
        });
    }   
}