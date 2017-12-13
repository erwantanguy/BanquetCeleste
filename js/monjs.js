$(document).ready(function() { 
	$('[data-toggle="tooltip"]').tooltip();
	$('#slider .carousel ol.carousel-indicators li:first-child').addClass('active');
	$('#slider .carousel-inner .item:first-child').addClass('active');   
        $('.home #myModal').modal('show');
        $('.home .carousel-control.left').click(function(e) {
            e.stopPropagation();
            $('#slider').carousel('prev');
            return false;
        });
        $('.single-programme .vignettes').find('img').parent('a').addClass('fancybox').attr('rel','gallery-0');
        $('.home .carousel-control.right').click(function(e) {
            e.stopPropagation();
            $('#slider').carousel('next');
            return false;
        });
        //        $('.carousel-control').click(function(e){
        //            e.preventDefault();
        //            $('#slider').carousel( $(this).data() );
        //        });
        //        $('.carousel-control.left').click(function() {
        //        $('#slider').carousel('prev');
        //        });
        //
        //        $('.carousel-control.right').click(function() {
        //          $('#slider').carousel('next');
        //        });
        $('.page-template-video').click(function(e) {
            //e.stopPropagation();
            //$('#interviews').carousel('prev');
            //console.log('test');
            //return false;
        });
        
	$('.home .carousel').carousel({
            interval:8000,
            keyboard:true   
	}); 
        $('.page-template-video .carousel').carousel({
            interval: 10000 //false
        }); 
        var loader = $('.loader'),
        busy = false,
        i = 1;
        
        var offset = $('#i-scroll article:last').offset();
        //alert(offset.top);
        $(window).scroll(function(){
            //console.log('ok');
            if(((offset.top + $('#i-scroll article:last').height()) - $(window).height() <= $(window).scrollTop()) && busy === false ){
                //alert('ok');
                i++;
                busy = true;
                loader.show();
                
                $.get(document.location.href + '?events=' + i)
                        .done( function (data){
                            loader.hide();
                    
                    $('#i-scroll article:last').after( $('#i-scroll', data).html());
                    
                    offset = $('#i-scroll article:last').offset();
                    
                busy = false;
                })
                        .fail(function(){
                           loader.hide(); busy = true;
                        });
            }
        });
});
//$(document).load($(window).bind("resize", checkPosition));

//var youtubeReady = false;
//
//  function onYouTubeIframeAPIReady(){
//    youtubeReady = true;
//  }
//
//  $('.carousel').on('slide', function(){
//    if(youtubeReady){
//      console.log("setting player");
//      var iframeID = $(this).find('.active').find('iframe').attr("id");
//      player = new YT.Player(iframeID); 
//      player.stopVideo(); 
//    }
//  });