$(document).ready(function(){
    
});
//voteAdd(this,1);
function voteAdd(element,Voteval){
    element = $(this);
    $.post("tool/vote_add.php",{val:Voteval},function(result){
        alert(result);
    });
}