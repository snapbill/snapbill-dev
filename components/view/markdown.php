<?php
class View_Markdown extends View {
  function render() {
    $extra = $this->extra;

    // Try load the menu
    $menu_dir = dirname($this->path);
    do {
      if (file_exists($menu_dir . '/menu.php')) {
        require $menu_dir . '/menu.php';
        break;
      }
      $i = strrpos($menu_dir, '/');
      if ($i == FALSE)
        break;
      $menu_dir = substr($menu_dir, 0, $i);
    } while(TRUE);

    $content = file_get_contents($this->path);
    echo '<div class="page span12">';
    echo Markdown($content);
    echo '</div>';
  }
}

