/* Author: Joel Souza */

/*
 * trigger functions based on controller and actions names
 * see more on http://www.viget.com/inspire/extending-paul-irishs-comprehensive-dom-ready-execution/
 */ 
UTIL = {
  exec: function( controller, action ) {
    var ns = MANAGER,
        action = ( action === undefined ) ? "init" : action;
    if ( controller !== "" && ns[controller] && typeof ns[controller][action] == "function" ) {
      ns[controller][action]();
    }
  },
  init: function() {
    var body = document.body,
        controller = body.getAttribute( "data-controller" ),
        action = body.getAttribute( "data-action" );

    UTIL.exec( "common" );
    UTIL.exec( controller );
    UTIL.exec( controller, action );
  }
};

$( document ).ready( UTIL.init );


MANAGER = {
  common: {
    init: function(){
      //datepicker
      $('input.datepicker').datepicker({
        dateFormat: 'dd/mm/yy',
        dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
        monthNames: ['Janeiro','Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
      });

      //table links
      $('tr.link td:not(.actions):not(.select)').click(function(){
        document.location.href = $(this).parent().attr('data-link');
      });

      //delete links
      $('a.delete').click(function(){
        return confirm('Tem certeza que deseja excluir?');
      });

      //delete selecteds
      $("button.delete[type='submit']").click(function(){
        if(confirm('Tem certeza que deseja excluir os registros selecionados?')) 
        {
          $("#bulk_action input[name='action']").val('delete');
          $("#bulk_action").submit();
        }
      });

      //select all
      $('#check_all').click(function(){
        if($(this).is(':checked'))
        {
          $(this).closest('form').find('input[name="id[]"]:not(:checked)').click();
        }
        else
        {
         $(this).closest('form').find('input[name="id[]"]:checked').click(); 
        }
      });
      
      //textarea
      $('textarea.richtext').wysiwyg({
        controls: {
          html: { visible: true }
        }
      });
    }
  },
  news: {
    edit: function(){
      $('.add_images').click(function(e){
        var input = $(this).prev();

        var last = $('#images input').last().attr('name').split('_');

        $('#images').append('<br/>');
        $('#images').append($('<input/>').attr('type', 'file').attr('name', 'image_' + (parseInt(last[1]) + 1)));

        return e.preventDefault();

      });

      $('#images a').click(function(e){
        $.post(this.href, function(data) {
          $('#image_' + data['id']).remove();
        });

        e.preventDefault();
      }); 

    },
    new: function(){
      $('.add_images').click(function(e){
        var input = $(this).prev();

        var last = $('#images input').last().attr('name').split('_');

        $('#images').append('<br/>');
        $('#images').append($('<input/>').attr('type', 'file').attr('name', 'image_' + (parseInt(last[1]) + 1)));

        return e.preventDefault();

      });
    }
  },
  banners: {
    form: function(){

      $('form').submit(function(){
        if ($('#banner_link').val() && $('#banner_category_id').val()) {
          alert('Você pode escolher apenas um link para o banner');
          return false;
        }
      });

    },
    new: function(){
      MANAGER.banners.form();
    }
  },
  quizusers: {
    index: function(){
      $('table.grid .is_active a').click(function(){
        var $link = $(this);

        $.ajax({
          url: $link.attr('href'),
          dataType: 'json',
          beforeSend: function(data){
            $link.closest('td').addClass('loading');
            console.log(data);
          },
          error: function(data){
            $link.closest('td').removeClass('loading');
            console.log(data)
          },
          success: function(data){
            $link.closest('td').removeClass('loading');
            console.log(data);
          }
        });
      });
    }
  }


}


















