<?php

Api::get(function($req, $res){
$css = <<<EFO
.container {
  position: relative;
}
nav {
  position: absolute;
  left: 0px;
  width: 200px;
}
section {
  /* position is static by default */
  margin-left: 200px;
}
footer {
  position: fixed;
  bottom: 0;
  left: 0;
  height: 70px;
  background-color: white;
  width: 100%;
}
body {
  margin-bottom: 120px;
}
EFO;

    $res->setContent('text/css')->outPut( preg_replace("/\s\s|\n/", "", $css) );

});