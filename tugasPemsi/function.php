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

function getZ(){
    $a = 44485709377909;
    $m = 281474976710656;

    $z = generateRandom();
    $z = ($a*$z);
    $z = fmod($z, $m);
    return $z;
}

function getU(){
    $m = 281474976710656;

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
    $y = $eksponensial(1/$lambda);
    $w=$w+$y;
    $x++;
  }
  return $x;
}

function topik35_0($TT){
$randemand=0;
$xx;
$TT;
$iday = $TT % 7;

if($iday>5) {
  return $randemand;
  }
else {
  $xx=getU();
  if (getU() > 0 && getU() < 0.14) {
    $randemand = 0;
  }
  if (getU() >= 0.14 && getU() <0.41) {
    $randemand = 1;
  }
  if (getU() >= 0.41 && getU() <0.68) {
    $randemand = 2;
  }
  if (getU() >= 0.68 && getU() <0.86) {
    $randemand = 3;
  }
  if (getU() >= 0.86 && getU() <0.95) {
    $randemand =4;
  }
  return $randemand;
}
}

?>
