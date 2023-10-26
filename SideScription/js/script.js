// ___________Applay btn listener______________

let aplly = document.querySelectorAll('.card-body a');
aplly.forEach(id => {
   id.addEventListener('click', function(e){
    e.preventDefault();
    $("#applayform").removeAttr('class')
   })
})



// ___________Applay btn listener______________

$("header >  nav ul li a").click( function(){
    let thissection = $(this).attr('href');
    let thisLink = $(this);


    $("html, body").stop().animate({
        scrollTop: $(thissection).offset().top - 100 
    }, 200, 'easeOutCirc')
  
    return false;
    
});



$(window).on('load', function(){

    let allLinks = $("header > nav ul li a");
    let posts = $('.hdr');
    let pageTop;
    let postPos;
    let counter = 0;

    let postTops = [];
    let prevCounter;
    let doneResizing;

    resetPagePosition();

    // console.log(postTops)

    $(window).scroll(function(){

        pageTop = $(window).scrollTop() + 100;

        if(pageTop > postTops[counter + 1]){
            counter++;
        }
        else if(counter > 0 && pageTop < postTops[counter]){
            counter--;
        }
        if(counter != prevCounter){

            $(allLinks).removeAttr('class');
            $("header > nav ul li a").eq(counter).addClass('selected');
            prevCounter = counter;

        }
          
    })

    $(window).on('resize', function(){
        clearTimeout(doneResizing);
        doneResizing = setTimeout(function(){

            resetPagePosition();
            
        }, 500)
    })

    function resetPagePosition() {
        
        postTops = [];
        posts.each(function(){
            postTops.push(Math.floor($(this).offset().top));
        })

        let pagePosition = $(window).scrollTop() + 100;
        counter = 0;

        for(let i = 0; i < postTops.length; i++){
            if (pagePosition > postTops[i]) {
                counter++;
            }
        }
            counter--;
            $(allLinks).removeAttr('class');
            $("header > nav ul li a").eq(counter).addClass('selected');

    }

})

$(window).on('load',function() {
    $('.flexslider').flexslider({
        animation: "slide", 
    });
  });



(function(){

    let counter = 1;
    function contentRotator(){

        $(`#rotator blockquote:nth-child(${counter})`).fadeIn(2000, function(){
            if($(this).is("#rotator blockquote:last-child")){

                setTimeout(function(){
                    $(`#rotator blockquote:nth-child(${counter})`).fadeOut(2000, function(){

                        counter = 1;
                        contentRotator();

                    });
                }, 7000)

            }
            else{
                setTimeout(function(){

                    $(`#rotator blockquote:nth-child(${counter})`).fadeOut(2000, function(){
                        counter++;
                        contentRotator();
                    });
                    
                }, 7000);   
            }
        })

    }

    contentRotator();

}());
