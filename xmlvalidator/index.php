<?php
include "flag.php";
ini_set('display_errors', 1);

if (!empty($_REQUEST['source'])) {
  highlight_file(__FILE__);
  die();
}

if (!empty($_REQUEST['xml'])) {
  $xmlstr = $_REQUEST['xml'];

  libxml_use_internal_errors(true);

  $doc = new DOMDocument();
  $doc->substituteEntities = true;
  if ($doc->loadXML($xmlstr)) {
    $xml = 'valid';
  }
  else {
    $xml = "invalid:\n";
    $err = libxml_get_errors();
    foreach($err as $e) {
      $xml .= "line {$e->line}: {$e->message}";
    }
    libxml_clear_errors();
  }
}

?>
<!doctype html>
<html>
  <head>
    <title>XML Validator</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

    <style>
body {
  padding: 20px;
}
    </style>
  </head>
  <body>
    <div classs="container">
      <form class="form-group"> 
        <label for="xml">Input XML to validate:</label>
        <textarea class="form-control" rows="20" id="xml" name="xml"><?=($xml)?$xml:""?></textarea>
        <button class="btn btn-primary btn-block" type="submit">validate!</button>
      </form>
    </div>
    <!-- <a href="/?source=1">source code</a>-->
  </body>
</html>
