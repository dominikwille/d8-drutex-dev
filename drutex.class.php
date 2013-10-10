<?php

namespace Drupal\drutex;

class Drutex {
  function __construct() {
  }

  function render($expression) {
    $name = md5($expression);
    $file = "/usr/www/privat/drupal-8.x-dev/sites/default/files/" . $name . ".tex";
    $dir =  "/usr/www/privat/drupal-8.x-dev/sites/default/files/";
    $pdf = $dir . $name . '.pdf';
    $png = $dir . $name . '.png';
    $src = "/privat/drupal-8.x-dev/sites/default/files/" . $name . ".png";

    $latex = '
    \documentclass[12pt]{article}
    \DeclareMathSizes{12}{20}{14}{10}
    \usepackage{amsmath}
    \pagestyle{empty}
    \begin{document} $' . $expression . '$ \end{document}';
    $handle = fopen($file, "w");
    fwrite($handle, $latex);

    // exec("export PATH='/sbin:/bin:/usr/sbin:/usr/bin:/usr/local/bin'");
    $command = "export PATH='/sbin:/bin:/usr/sbin:/usr/bin:/usr/local/bin' && pdflatex -output-directory ". $dir . " " . $file ." && convert -trim " . $pdf . " " . $png . " && chmod o+x " . $png;
    exec($command);
    // dpm($command);
    return '<img src="' . $src . '" />';
  }
}
