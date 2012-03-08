
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

  // Load in google pretty printer
  prettyPrint();

  // Scrollspy
  setTimeout(function() {
  $('body').scrollspy({
    'target': '#menu'
  });
  }, 1000);
});
