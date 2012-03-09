<?php
class View_Markdown extends View {
  function render() {
    $extra = $this->extra;

    // Short-circuit cached htm versions
    if (Config::get('server', 'mode') == 'production') {
      if (file_exists(substr($this->path, 0, -4).'.htm')) {
        echo file_get_contents(substr($this->path, 0, -4).'.htm');
        return;
      }
    }

    // Try load the menu
    $menu_dir = dirname($this->path);
    $menus = array();
    do {
      if (file_exists($menu_dir . '/menu.php')) {
        array_unshift($menus, $menu_dir . '/menu.php');
      }
      $i = strrpos($menu_dir, '/');
      if ($i == FALSE)
        break;
      $menu_dir = substr($menu_dir, 0, $i);
    } while(TRUE);

    foreach ($menus as $menu) require $menu;

    Layout_Menu::render();
    Layout_Page::content();

    $content = file_get_contents($this->path);

    /***
     * %parameter-table
     *
     * depth: add, get
     *    This is the depth bla bla bla
     *
     * %%%
     **/
    $content = preg_replace_callback("/\n%parameter-table\n((.|\n)*)\n%%%\n/", function ($m) {
      $md = "\n<table class='table'><thead><tr>";
      $md .= '<th>Name</th><th colspan="4">Availability</th><th>Description</th>';
      $md .= '</tr></thead><tbody>';

      $rows = explode("\n", $m[1]);
      while ($rows) {
        $row = trim(array_shift($rows));
        if (!$row) continue;

        list($name, $tags) = array_map('trim', explode(':', $row));
        $tags = array_map('trim', explode(',', $tags));

        $name = str_replace('->', '&#8627; ', $name);
        $md .= '<tr><td>'.$name.'</td>';
        foreach (array('add', 'get', 'update', 'deprecated') as $column) {
          if (in_array($column, $tags, True)) {
            $label = '<span class="label label-'.$column.'">'.$column.'</span>';
            if ($column != 'deprecated') {
              $label = '<a href="#'.$column.'">'.$label.'</a>';
            }
            $md .= '<td>'.$label.'</td>';
          }else{
            $md .= '<td></td>';
          }
        }
        $md .= '<td markdown=1>'."\n";
        while ($row = trim(array_shift($rows))) {
          $md .= "$row\n";
        }
        $md .= '</td></tr>'."\n";
      }
      $md .= "</tbody></table>\n";

      return $md;
    }, $content);

    /***
     * %state-table
     *
     * new
     *   This is the state all new accounts are created in
     * %%%
     **/
    $content = preg_replace_callback("/\n%state-table\n((.|\n)*)\n%%%\n/", function ($m) {
      $md = "\n<table class='table'><thead><tr>";
      $md .= '<th>Name</th><th>Description</th>';
      $md .= '</tr></thead><tbody>';

      $rows = explode("\n", $m[1]);
      while ($rows) {
        $row = trim(array_shift($rows));
        if (!$row) continue;

        $md .= '<tr><td>'.$row.'</td>';
        $md .= '<td markdown=1>'."\n";
        while ($row = trim(array_shift($rows))) {
          $md .= "$row\n";
        }
        $md .= '</td></tr>'."\n";
      }
      $md .= "</tbody></table>\n";

      return $md;
    }, $content);

    // Run the content through Markdown and print it out
    echo '<div class="page span10">';
    if (isset($_GET['plain'])) print '<pre>'.HTML($content).'</pre>';
    else echo Markdown($content);
    echo '</div>';
  }
}

