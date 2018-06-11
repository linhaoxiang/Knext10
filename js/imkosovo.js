$(document).ready(function(){
    getImKosovoData();
    $('.answer_section').css('opacity','0');
});


function getImKosovoData(){
    $.get("tool/quiz_jsondata.php", function(result){
        if(result!='false'){
            processData(result)
        }
    });
}

function processData(data){
    var obj = JSON.parse(data);

    var dataTotal = 0;
    var biggestVal = 0;
    var biggestGroup = 0;
    for (i = 1; i <= 6; i++) {
        dataTotal += obj[i];
        if(obj[i]>biggestVal){
            biggestVal = obj[i];
            biggestGroup = i;
        }
    }

    var percentArray = [];
    for (j = 1; j <= 5; j++) {
        var percent = (obj[j]/dataTotal)*101;
        percentArray[j-1] = percent;
    }
    for (i = 1; i <= 6; i++) {
        var percentTotal = 0;
        for (j = 0; j <= i-1; j++) {
            percentTotal += percentArray[j];
        }
        //alert(i+" : "+percentTotal);
        $('.circle'+(i-1)).css('stroke-dasharray', percentTotal+" 100");
    }
}


var qaPoints = [0, 0, 0, 0, 0, 0];
var answers = ["You are Knowledgeable Kosovar! The Kosovo Wall in Kosovo NEXT10 is recommended for you! Kosovo Wall will present 10 interesting facts about Kosovo in infographics, come to Kosovo NEXT10 and checkout what’s new for you!","You are Social Kosovar! The Wishing Tree in Kosovo NEXT10 is recommended for you! In the exhibition, people can write down their wishes and hang it on the tree, come to Kosovo NEXT10 and share your wishes with more people!","You are Kind Kosovar! The Children’s Painting Animation in Kosovo NEXT10 is recommended for you! In the animation, there are 20 children will tell you their imaginations about the future by paintings. Come to Kosovo NEXT10 and see their imaginations come true in the animation! ","You are Leading Kosovar! The Democracy Wall in Kosovo NEXT10 is recommended for you! Democracy Wall will present 10 achievements of Kosovo’s democracy in the past 10 years, and 10 social issues people want to change for the next 10 years. Come to Kosovo NEXT10 and vote for the changes you want for Kosovo!","You are Creative Kosovar! The VR Adventure in Kosovo NEXT10 is recommended for you! In the VR Adventure, you can travel around the world without VISA! It’s not only a game, but also our wish for future Kosovo. Come to Kosovo NEXT10 and try it out!","You are Activist Kosovar! The Mission Machine in Kosovo NEXT10 is recommended for you! There are 30 different missions for social changes are in the Mission Machine. Come to Kosovo NEXT10 and get a cool mission for yourself!"];


$(document).ready(function(){
  updateEvent(true);
});

$('.qa_btn').click(function(){
  $(this).find('.qa_btn_text').addClass('qa_btn_text_selected');
  $(this).siblings('').find('.qa_btn_text').removeClass('qa_btn_text_selected');
  $(this).attr('answer','true');
  $(this).siblings('').attr('answer','false');
  updateEvent(false);
});

function pointsCounter(){
   for (i = 0; i < qaPoints.length; i++) { 
      qaPoints[i] = 0;
   }
   $('.qa_btn').each(function(){
        if($(this).attr('answer') == 'true'){
          var grsp = $(this).attr('group').split(",");
          var gaVal = parseInt($(this).attr('qaval'));
          for (i = 0; i < grsp.length; i++) { 
             qaPoints[(parseInt(grsp[i]))-1] += gaVal;
          }
        }
    });
  
  var checkMaxVal = 0;
  var groupID = 0;
  for (r = 0; r < qaPoints.length; r++) { 
     if(qaPoints[r]>checkMaxVal){
       checkMaxVal = qaPoints[r];
       groupID = r;
     }
  }
  //alert(qaPoints); 
  //alert("結果：群組 "+(groupID+1));
  showAnswerModal(groupID+1);
}

function updateEvent(initial){
    var answeredTotal = 1;
  $('.qa_btn').each(function(){
      
        if($(this).attr('answer') == 'true'){
          answeredTotal+=1;
        }
  });
  for (r = 0; r <answeredTotal ; r++) {
     if(initial == false){
        $('.sec'+r).css('transition','all .5s');
     }
     $('.sec'+r).css('opacity','1');
  }
  for (r = answeredTotal; r <=6 ; r++) {
     $('.sec'+r).css('opacity','0'); 
  }
  if(answeredTotal>7){
    pointsCounter();
    imkModalSizeUpdate();
  }
}

function showAnswerModal(groupID){
  $('.answer_section').css('opacity','1');
  var answerInfo = "";
  switch(groupID) {
    case 1:
      answerInfo = answers[0];
      break;
    case 2:
      answerInfo = answers[1];
      break;
    case 3:
      answerInfo = answers[2];
      break;
    case 4:
      answerInfo = answers[3];
      break;
    case 5:
      answerInfo = answers[4];
      break;
    case 6:
      answerInfo = answers[5];
      break;
  }
  $('#answerContent').html(answerInfo);
}

function redoQA(){
    $('.qa_btn').each(function(){
        $(this).find('.qa_btn_text').removeClass('qa_btn_text_selected');
        $(this).attr('answer', 'false');
    });
    $('.answer_section').css('opacity','0');
    updateEvent(false);
    $('.qa_main').scrollTop(0);
}


