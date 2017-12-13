$(document).ready(function(){
    $('.page-template-video .load').click(function(){
        var index = '';
        var id = '';
        var cat = '';
        $(this).each(function(){
            index += $(this).attr('data-index');
            id += $(this).attr('data-id');
            cat += $(this).attr('data-cat');
            console.log(index + ' - ' + id + ' - ' + cat);
        });
        if(index){
            //console.log(index + ' - ' + id);
            $.post(
                    ajaxurl,
            {
                'action': 'la_video',
                'index': index,
                'id': id,
                'cat': cat
            },
            function(response){
                console.log(response);
                console.log(index + ' - ' + id + ' - ' + cat);
                //alert(response);
                $('.page-template-video #lesvideos figure#vue').empty();
                $('.page-template-video #lesvideos figure#vue').append(response);
            }
                    );
        }
    })
  ;
});