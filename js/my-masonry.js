/*$('.grid').masonry({
  // options
  itemSelector: '.grid-item',
  columnWidth: '.grid-item'
});*/

/*var $container = $('.grid');
$container.imagesLoaded( function () {
  $container.masonry({
    columnWidth: '.grid-item',
    itemSelector: '.grid-item'
  });   
});*/
 $(document).ready(function(){
    $('.home #categories').masonry({
      // options
      //itemSelector: 'aside',
      //columnWidth: 'aside',
      //itemSelector: 'aside'
  });
  $('.page-template-page-musiciens main #liste').masonry({
      // options
      //itemSelector: 'article',
      //columnWidth: '.col-md-4',
      //itemSelector: 'aside',[class^=col-sm-]
      itemSelector: 'article',
      //columnWidth: '[class^=col-sm-4]',
      columnWidth: 'article'
  });
});
$(window).load(function() {
    $('.home #categories').masonry({
      // options
      itemSelector: 'aside',
      columnWidth: 'aside'
      //itemSelector: 'aside'
  });
});