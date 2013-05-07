<?php
class View_Markdown extends View {
  function render() {
    $extra = $this->extra;

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

    $content = file_get_contents($this->path);

    if (preg_match_all('/<section[^>]*id="([^"]*)"[^>]data-title="([^"]*)"/', $content, $matches)) {
      $menu = array();
      foreach ($matches[1] as $k => $id) {
        $title = $matches[2][$k];
        $menu[$title] = "#$id";
      }
      Layout_Menu::update($menu);
    }

    Layout_Menu::render();
    Layout_Page::content();

    /***
     * %%json:<filename>%
     **/

    $content = preg_replace_callback("/%%json:([^%]+)%/", function ($filename) {
      $json = trim(file_get_contents($filename[1]));

      $json = json_decode($json, True);
      return '<div class="json">'.JSONPretty::val($json).'</div>';

    }, $content);
    /***
     * %parameter-table / %option-table
     *
     * depth: add, get
     *    This is the depth bla bla bla
     *
     * %%%
     **/
    $content = preg_replace_callback("/\n%(parameter|option)-table\n((.|\n)*?)\n%%%\n/", function ($m) {

      if ($m[1] == 'option') {
        $column = 'Required';
      }else{
        $column = 'Availability';
      }

      $md = "\n<table class='table'><thead><tr>";
      $md .= '<th>Name</th><th colspan="4">'.$column.'</th><th>Description</th>';
      $md .= '</tr></thead><tbody>';

      $rows = explode("\n", $m[2]);
      while ($rows) {
        $row = trim(array_shift($rows));
        if (!$row) continue;

        list($name, $tags) = array_map('trim', explode(':', $row));
        $tags = array_map('trim', explode(',', $tags));

        $name = str_replace('->', '&#8627; ', $name);

        if (ends_with($name, '[X]')) {
          $name = substr($name, 0, -3).'<small>[<span>X</span>]</small>';
        }

        $md .= '<tr><td nowrap="nowrap">'.$name.'</td>';
        foreach (array('add', 'get', 'update', 'optional') as $column) {
          if (in_array($column, $tags, True)) {
            $label = '<span class="label label-'.$column.'">'.$column.'</span>';
            if ($column != 'deprecated') {
              $label = '<a href="#'.$column.'">'.$label.'</a>';
            }
            $md .= '<td>'.$label.'</td>';
          }else{
            $md .= '<td style="padding:0;margin:0"></td>';
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
     * %uri-table
     *
     * new
     *   This is the state all new accounts are created in
     * %%%
     **/
    $content = preg_replace_callback("/\n%uri-table\n((.|\n)*?)\n%%%\n/", function ($m) {
      $md = "\n<table class='table'><thead><tr>";
      $md .= '<th>Path</th><th>Description</th>';
      $md .= '</tr></thead><tbody>';

      $rows = explode("\n", $m[1]);
      while ($rows) {
        $row = trim(array_shift($rows));
        if (!$row) continue;

        $row = preg_replace_callback('/{([^}]+)}/', function($m) {
          return '<span style="color:green;">'.HTML($m[1]).'</span>';
        }, $row);

        $md .= '<tr><td nowrap>'.$row.'</td>';
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
    $content = preg_replace_callback("/\n%state-table\n((.|\n)*?)\n%%%\n/", function ($m) {
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

    /***
     * %expand%
     **/
    $content = preg_replace_callback("/<%((.|\n)*?)%>/", function ($m) {
      return '<span class="expand">'.$m[1].'</span>';
    }, $content);

    /***
     * labels (%optional%)
     **/
    $content = preg_replace_callback("/%([a-z]+)([.?]?)%/i", function ($m) {
      return '<span class="label label-'.strtolower($m[1]).'">'.$m[1].$m[2].'</span>';
    }, $content);


    // Run the content through Markdown and print it out
    echo '<div class="page span10">';
    if (isset($_GET['plain'])) print '<pre>'.HTML($content).'</pre>';
    else echo Markdown($content);
    echo '</div>';
  }
}

