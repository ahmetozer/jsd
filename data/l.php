<?php

$file = file("latest.txt");
for ($i = max(0, count($file)-99); $i < count($file); $i++) {
  echo $file[$i] ;
}
?>