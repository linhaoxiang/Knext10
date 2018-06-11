//section_scroll.js Event of index Sections

var pageScrollTop = 0;
var navbarHeight = 100;

$(document).ready(function(){
    detectDevices();
    updatePageScrollTop();
    updateStickyElement();
    updateActiveSection();
});

$(document).scroll(function() {
    detectDevices();
    updatePageScrollTop();
    updateStickyElement();
    updateActiveSection();
});

$(window).resize(function() {
  detectDevices();
  updatePageScrollTop();
  updateStickyElement();
  updateActiveSection();
});


function detectDevices(){
  if($(window).width() < 1200){
    navbarHeight = 25;
  }else{
    navbarHeight = 100;
  }
}

function updatePageScrollTop(){
    pageScrollTop = window.pageYOffset;
}

function updateStickyElement(){
   $('.stickySection').each(function(){
      stickyEvent($(this));
   });
}

function stickyEvent(element){
  var elementScrollTop = element.offset().top;
  if(pageScrollTop >= elementScrollTop-navbarHeight){
      element.find('.title_box').addClass("sticky");
      element.find('.title_box').css('top', navbarHeight);
      if(element.find('.emty_box').attr('status')!='active'){
        element.prepend('<div class="emty_box" status="active"></div>');
      }
      if(pageScrollTop >= elementScrollTop+element.height()-element.find('.title_box').height()-navbarHeight){
          var topChange = (elementScrollTop+element.height()-element.find('.title_box').height())-pageScrollTop;
          element.find('.title_box').css('top', topChange);
      }
  }else{
      element.find('.emty_box').remove();
      element.find('.title_box').removeClass("sticky");
  }
}

function pageScrollTo(elementSelector){
  var elementScrollTop = $(elementSelector).offset().top;
  var scrollHeight = pageScrollTop-elementScrollTop;
  if(scrollHeight<0){
    scrollHeight*=-1;
  }
  $('body, html').animate({scrollTop:elementScrollTop-navbarHeight}, scrollHeight/2);
  //呼叫方法  onclick="pageScrollTo('.selector');"
}


function updateActiveSection(){
   $('.activeSection').each(function(){
      sectionActiveEvent($(this));
   });
}

function sectionActiveEvent(element){
  var elementScrollTop = element.offset().top;
  var activeTarget = element.attr('target');
  var activeAddClass = element.attr('activeClass');
  if(pageScrollTop >= elementScrollTop-navbarHeight && pageScrollTop < elementScrollTop+element.height()-navbarHeight){
    $(activeTarget).addClass(activeAddClass);
  }else{
    $(activeTarget).removeClass(activeAddClass);
  }
  //該物件中需要有activeSection屬性
  //呼叫方法  target="目標物件.xxx or #xxx" activeClass="目標物件加入的class"
  //被呼叫物件 加入target中所填入的class
}