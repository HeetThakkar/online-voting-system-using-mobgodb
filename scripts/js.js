   

  $(document).ready(function(){
    $("#flip").mouseenter(function(){
    $("#panel").slideDown("slow");
   });

   $("#flip").mouseleave(function(){
    $("#panel").slideUp("slow");
   });

  });
    
  $(document).ready(function(){
    $(".grid-container").css({"background-image":'url("images/img.jpg")'})

    $(".item2").mouseenter(function(){
      $(".grid-container").css({"background-image":'url("images/bg.jpg")',"background-size": "100% 100%","background-attachment": "fixed"})
      $(".item2").css({'background':'rgba(0, 0, 0, 0.8)'})
      $("#animation").css({'color':'black'})
      
     });

     $(".item2").mouseleave(function(){
      $(".grid-container").css({"background-image":'url("images/img.jpg")'})
      $(".item2").css({'background':'rgba(0, 0, 0, 0.4)'})
      $("#animation").css({'color':'white'})
    });
    });


          
              