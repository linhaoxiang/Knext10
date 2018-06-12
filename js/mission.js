
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

$(document).ready(function(){
  getMissionData();
});

var timeLess = 0;

function getMissionData(){
  var lang = $('#langsetting').attr('language');
  $.get("tool/mission_jsondata.php?lang="+lang, function(result){
    var obj = JSON.parse(result);
    $('.mission-content').html(obj.mission_content);
    timeLess = obj.mission_time;
    //alert(result);
    if(obj.firstTime == "false"){
      missionStart();
    }
  });
}


setInterval(function() {
  timeCounter();
}, 1000);

function timeCounter(){
  if(timeLess>0){
    timeLess--;
  }
  var timeCount = timeLess;

  var hourTime = 60*60;
  var minTime = 60;

  var hh = 0;
  var mm = 0
  var ss = 0;

  var hhString = "00";
  var mmString = "00";
  var ssString = "00";
  
  if(timeCount>hourTime){
    hh = Math.floor(timeCount/hourTime);
    timeCount = timeCount-(hh*hourTime);
  }

  if(timeCount>minTime){
    mm = Math.floor(timeCount/minTime);
    timeCount = timeCount-(mm*minTime);
  }

  ss = timeCount;

  if(hh>=10){
    hhString = hh.toString();
  }else{
    hhString = "0"+hh.toString();
  }

  if(mm>=10){
    mmString = mm.toString();
  }else{
    mmString = "0"+mm.toString();
  }

  if(ss>=10){
    ssString = ss.toString();
  }else{
    ssString = "0"+ss.toString();
  }
  
  $('.missioncount').text(hhString+":"+mmString+":"+ssString);
}


