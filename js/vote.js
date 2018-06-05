$(document).ready(function(){
    
});

//voteAdd(this,1);
var onClickElement;
function voteAdd(element,Voteval){
    onClickElement = jQuery(element);
    $.post("tool/vote_add.php",{val:Voteval},function(result, element){
        if(result=='true'){
            onClickElement.addClass('btn-outline-secondary_active');
        }else{
            alert(result);
        }
    });
}