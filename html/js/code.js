
$(function() {

  // Load in google pretty printer
  prettyPrint();

  $('pre .expanded').each(function() {
    var self = this;
    var html = $(this).html();
    $(this).empty();

    var div = $(this).closest('div');
    var fn = div.data('expand');
    if (fn) {
      div.data('expand', function() {
        $(self).html(html);
        fn();
      });
      return;
    }

    var button = div.find('.expand');

    div.data('expand', function() {
      $(self).html(html);
      button.remove();
    });

    button.append(
      $('<img src="/img/ellipsis.gif">').click(function() {
        div.data('expand')();
      })
    );
  });

  // Highlights when clicking anchors
  /*$('a').live('click', function() {
    var href = $(this).attr('href');
    if (href.substring(0,1) == '#') {
      $(href).find('h3').css('background-color', '#cef').animate({'background-color':'#fff'}, 800, 'swing');
    }
  });*/

  // Scrollspy
  $('body').scrollspy({
    'target': '#menu'
  });
});
