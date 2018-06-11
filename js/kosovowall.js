// $(".options").click(
//   knowing();
// )
$(".onbaby").css("back","block");

// $(".s3btn").click(
//   function(){
//     $('#knowing').css("transform","translateX(0%)");
//   }


// function knowing(){
//     $('#knowing').css("transform","translateX(0%)");
//     // $('.knowing-content').text($(this.attr("data"));
// }

$(document).ready(function(){
    knowingToggle(true);
})

function knowingToggle(toggle){
    if(toggle==true){
        $('#knowing').css("transform","translateX(-105%)");
    }else{
        $('#knowing').css("transform","translateX(0%)");
    }
    
}


