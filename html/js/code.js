
$(function() {

  // Load in google pretty printer
  $('pre.input').addClass('prettyprint');
  prettyPrint();

  $('pre .closeable .closeable .closeable .closeable').each(function() {
    var self = this;
    var html = $(this).css('display', 'none');
    var button = $('<span class="expand-button">');

    $(self).before(button);

    button.append(
      $('<img src="/img/ellipsis.gif">').click(function() {
        $(self).css('display', 'block');
        $(this).remove();
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
