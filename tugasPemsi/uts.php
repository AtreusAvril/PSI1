<?php //s1
for ($i=0; $i < 2; $i++) {
    generateRandom();
}

function generateRandom() {
    if(isset($_POST["output"])){

        $microtime = (string) (float) microtime();
        $panjang = strlen($microtime);
        $lastIndex = $panjang - 1;
        $lastChar = $microtime[$lastIndex];

        $kunciUnik = bcmod($_POST["output"], '10');
        $kunciUnik += $lastChar;

  if ($kunciUnik >= 10) {
   $kunciUnik -=10;
  }

        if($kunciUnik == 0){
            $kunciUnik += 2;
        } else if($kunciUnik == 1) {
            $kunciUnik += 1;
        }

        $_POST["output"] *= $kunciUnik;
        $_POST["output"] = substr($_POST["output"], 0, 10);
        return $_POST["output"];
    } else {
        $_POST["output"] = time();
        return $_POST["output"];
    }
}
function mean($array){
  $x = count($array);
  $atas = 0; $hasil = 0;
  for($i = 0 ; $i < $x ; $i ++){
    $atas = $atas + $array[$i];
  }
  $hasil = $atas / $x;
  return $hasil;
}
$a=0;
$m =0;
function getZ(){
    $a = $_POST['a'];
    $m = $_POST['m'];


    $z = generateRandom();
    $z = ($a*$z);
    $z = fmod($z, $m);
    return $z;
}

function getU(){
    $m = $_POST['m'];

    $z = getZ();
    $u = $z/$m;

    return $u;
}
function eksponensial($theta){
  $e =2.718281828459;
  $u = getU();
  $x = -$theta * log($u,$e);
  return $x;
}
function uniformDiskrit($a, $b){
    $u = getU();
    $x = $a+($b+$a+1)*$u;
    $x = floor($x);
    return $x;
}
function binomial1($n, $p){
  $x=0;
  $i=1;

  while ($i < $n) {
    $u = getU();
    if($u<$p){
      $x++;
    }
    $i++;
  }
  return $x;
}

function poisson1($lambda){
  $x=0;
  $w=0;
  while($w<1){
    $y = eksponensial(1/$lambda);
    $w=$w+$y;
    $x++;
  }
  return $x;
}

function normal2(){
    $i = 0;
    $x = 0;

    while($i<12){
        $u = getU();
        $x += $u;
        $i++;
    }

    $x -= 6;
    return ($x);

}

function normal($mu, $tho_sqr){
    $x = normal2();
    $tho = sqrt($tho_sqr);
    $y = $mu + ($tho * $x);

    return $y;
}
function dist1($mu, $tho_sqr){
    return normal($mu, $tho_sqr);
}


function dist2($lambda,$n,$p){
  $alpha = getU();
  return ($alpha * (binomial1($n, $p)) + (1-$alpha) * poisson1($lambda));
}

function demand($TT){
  $randemand=0;
  $xx;
  $TT;
  $iday = $TT % 7;

  if($iday>5) {
    return $randemand;
    }
  else {
    $xx=getU();
    if ($xx > 0 && $xx < 0.14) {
      $randemand = 0;
    }
    if ($xx >= 0.14 && $xx <0.41) {
      $randemand = 1;
    }
    if ($xx >= 0.41 && $xx <0.68) {
      $randemand = 2;
    }
    if ($xx >= 0.68 && $xx <0.86) {
      $randemand = 3;
    }
    if ($xx >= 0.86 && $xx <0.95) {
      $randemand =4;
    }
    return $randemand;
  }
}

function topik35_0($tfinal,$s,$q){
$a = $_POST['nilaia'];
$b = $_POST['nilaib'];

$TT = 1;
$demand1 = 0;
$cumlost = 0;
$Norder = 0;
$TorderArrive = 0;
$Orderplaced = false;
$inv = 20;
$cuminv = $inv;
$Cinv = 0.4;
$Corder = 5;
$Cpenalty = 1;
while($TT < $tfinal){
  if($TT == $TorderArrive){
    $inv = $inv + $q;
    $Orderplaced = false;
  }
  $cuminv = $cuminv + $inv;
  $demand1 = demand($TT);
  if($demand1>$inv){
    $cumlost = $cumlost + $demand1 - $inv;
    $inv = 0;
  } else {
    $inv = $inv - $demand1;
  }
  if (($inv <= $s)&&(!$Orderplaced)) {
    $Orderplaced = true;
    $TorderArrive = $TT + 4 + (dist1($a,$b) * 3);
    $Norder = $Norder + 1;
  }
  $TT = $TT + 1;
}
$Tyear = $tfinal/365;
$aveannualcost = $Cinv * ($cuminv/$TT) + ($Corder/$Tyear) * $Norder + $Cpenalty * ($cumlost/$Tyear);
$aveinv = $cuminv/$TT;
$aveorderperyear = $Norder/$Tyear;
$avelostdemandperyear = $cumlost/$Tyear;

//
// $mean = 0;
// for($i=0;$i<10;$i++){
// $mean= $mean+ $hasil[$i];
// }
// $mean=$mean/10;

return [$Tyear,$aveannualcost,$aveinv,$aveorderperyear,$avelostdemandperyear];
}

function topik35_1($tfinal,$s,$q){
  $lambda = $_POST['lambda'];
  $n = $_POST['n'];
  $p = $_POST['p'];

$TT = 1;
$demand1 = 0;
$cumlost = 0;
$Norder = 0;
$TorderArrive = 0;
$Orderplaced = false;
$inv = 20;
$cuminv = $inv;
$Cinv = 0.4;
$Corder = 5;
$Cpenalty = 1;
while($TT < $tfinal){
  if($TT == $TorderArrive){
    $inv = $inv + $q;
    $Orderplaced = false;
  }
  $cuminv = $cuminv + $inv;
  $demand1 = demand($TT);
  if($demand1>$inv){
    $cumlost = $cumlost + $demand1 - $inv;
    $inv = 0;
  } else {
    $inv = $inv - $demand1;
  }
  if (($inv <= $s)&&(!$Orderplaced)) {
    $Orderplaced = true;
    $TorderArrive = $TT + 4 + (dist2($lambda,$n,$p) * 3);
    $Norder = $Norder + 1;
  }
  $TT = $TT + 1;
}
$Tyear = $tfinal/365;
$aveannualcost = $Cinv * ($cuminv/$TT) + ($Corder/$Tyear) * $Norder + $Cpenalty * ($cumlost/$Tyear);
$aveinv = $cuminv/$TT;
$aveorderperyear = $Norder/$Tyear;
$avelostdemandperyear = $cumlost/$Tyear;
//
// $mean = 0;
// for($i=0;$i<10;$i++){
// $mean= $mean+ $hasil[$i];
// }
// $mean=$mean/10;
return [$Tyear,$aveannualcost,$aveinv,$aveorderperyear,$avelostdemandperyear];
}
?>
