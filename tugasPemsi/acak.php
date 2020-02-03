<?php

include 'uts.php';

$acak = uniformDiskrit(0,1);

switch($acak){
    case 0:
        header("Location: index.php");
        break;
    case 1:
        header("Location: index1.php");
        break;
}

 ?>
