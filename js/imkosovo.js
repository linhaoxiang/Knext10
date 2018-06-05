$(document).ready(function(){
    getImKosovoData();
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