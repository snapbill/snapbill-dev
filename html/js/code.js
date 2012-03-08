
$(function() {

  $('pre .extended').each(function() {
    var html = $(this).html();
    var self = this;
    $(this).empty().append(
      $('<img class="extend" src="/img/ellipsis.gif">').click(function() {
        $(self).html(html);
      })
    );
  });

  // Highlights when clicking anchors
  $('a').live('click', function() {
    var href = $(this).attr('href');
    console.log(href);
    if (href.substring(0,1) == '#') {
      $(href).find('h3').css('background-color', '#cef').animate({'background-color':'#fff'}, 800, 'swing');
    }
  });
  // Load in google pretty printer
  prettyPrint();

  // Scrollspy
  $('body').scrollspy({
    'target': '#menu'
  });
});
