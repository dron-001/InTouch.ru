



$(document).ready(function(){
    
  var width = $('#slider-container').width();
  
  $('.slides>li').width('190px');
  $('.slides').width(width*$('.slides>li').length);
  
  
  
  //positing
  
  $('.slides>li:last-child').prependTo('.slides');
  
  
  
  //move
  
  function nextSlide(){
      $('.slides').animate({
          'margin-left': -200
      },500, function(){
          $('.slides>li:first-child').appendTo('.slides');
          $('.slides').css('margin-left', 0);
      
      });
    }
    
    
    function prevSlide(){
      $('.slides').animate({
          'margin-left': 200
      },500, function(){
          $('.slides>li:last-child').prependTo('.slides');
          $('.slides').css('margin-left', 0);
      
      });
    }

    $('.next').click(nextSlide);
    $('.prev').click(prevSlide);
    
    // отправка файлов
    $('.add').on('click', function(){ 
    
    $('.select_add').slideToggle();
    
    });
    
    
    $('#add_photo').on('click', function(){ 
   
    $('.qwe').slideToggle();
    
    
    });
    $('.close_select').on('click', function(){ 
   
    $('.qwe').slideToggle();
    
    
    });
    
    
    //go photo
    
    $('.select').on('click', function(){
    
    
    $('.qwe').slideToggle();
   
    
    
    
    });
    
    //galery
    
    
    
    
    
    
    
    
    
    
    
    
    
                //status message
                
                
              

    
    
    
    
    // работа с фото
       $('.del').on('click', function(){ 
       alert(123);
       
    
    
    });
    
    
  
    

});
