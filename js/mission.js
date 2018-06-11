
// $( document ).ready(function(){
//     missionKartToggle(true);
// })
function missionStart(){
    $('.mission-content').css("display","block");
    $('.missionGO').css("display", "none");
    $('.missionKart').css("display", "flex");
  }

// function missionShow(){
//     $('.missionKart').css("right", "0");    
// }

// function missionKartToggle(toggle){
//     if(toggle==true){
//         $('.missionKart').css("right", "0");    
//     }else{
//         $('.missionKart').css("right", "-250px");    
//     }
// }
function missionKartShow(){
    $('.missionKart').toggleClass("missionKart-show");
  }