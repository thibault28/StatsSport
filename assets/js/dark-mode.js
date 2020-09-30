$( document ).ready(function() {
   const toggle = $("#dark-mode");
   dmToggle(toggle);

   toggle.change(function (e) { 

    dmToggle($(this));
    
    })

});

function dmToggle(element){
    
    if(element.is(':checked')){
        $("*").each(function(){
            $(this).addClass("dark")
        });
    }else{
        $("*").each(function(){
            $(this).removeClass("dark")
        });
    }
}