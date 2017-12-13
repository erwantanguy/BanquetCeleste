(function($) {
	$('.page-template-page-realisations #localisation .nav li>a').click(function(){
		$('#masonry').css({opacity: .5});
		$.post(ajaxurl, {param: this.rel, action: 'mon_action'})
			.success(function( response ) {
				$('#masonry').html(response).css({opacity: 1});
			});
	});
        $('.page-template-page-references #localisation .nav li>a').click(function(){
		$('#masonry').css({opacity: .5});
		$.post(ajaxurl, {param: this.rel, action: 'structures'})
			.success(function( response ) {
				$('#masonry').html(response).css({opacity: 1});
			});
	});
        $('.page-template-page-archives #localisation .nav li>a').click(function(){
		$('#masonry').css({opacity: .5});
		$.post(ajaxurl, {param: this.rel, action: 'mon_action2'})
			.success(function( response ) {
				$('#masonry').html(response).css({opacity: 1});
			});
	});
	$('#categories .nav li>a').click(function(){
		$('#masonry').css({opacity: .5});
		$.post(ajaxurl, {param: this.rel, action: 'mes_references'})
			.success(function( response ) {
				$('#masonry').html(response).css({opacity: 1});
			});
	});
	$('.tax-categorie #localisation .nav li>a').click(function(){
		$('#slider').css({opacity: .5});
		cat = $(this).attr('data-categorie');
		$.post(ajaxurl, {param: this.rel,catname: cat, action: 'mes_categories'})
			.success(function( response ) {
				$('#slider').html(response).css({opacity: 1});
			});
	});
	
})(jQuery);