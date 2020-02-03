
<?php
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

function eksponensial($tetha){
 $e = 2.718281828459;
 $u = getU();
 $x = -$tetha*log($u,$e);
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

function uniformDiskrit($a, $b){
    $u = getU();
    $x = $a+($b+$a+1)*$u;
    $x = floor($x);
    return $x;
}

// //$n = bilangan bulat
// $p=probabilitas angka bilangan 0.
// $a=nilai lebih kecil dari b_bilangan bulat
// $b=nilai lebih besar dari a_bilangan bulat

function dist2($lambda,$n,$p){
  $alpha = getU();
  return ($alpha * (binomial1($n, $p)) + (1-$alpha) * poisson1($lambda));
}
?>

<style>
/* Dropdown Button */
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #3e8e41;}
</style>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

 <form action="" method="post">
  <input type="hidden" name="hasil" value="<?php echo $save ?>">
  <input type="text" name="nilain" placeholder="INPUT n" />
  <input type="text" name="nilaip" placeholder="INPUT p" />
  A=
  <select name="a">
    <option value="44485709377909">RANF (CDC 60000 FTN Compiler )</option>
    <option value="16807">GGUBS (IMSL Routine)</option>
    <option value="65539">RANDU (IBM Scientific Subroutine)</option>
    <option value="16807">GGL (IBM subroutine Lib.-Math.)</option>
  </select>

  M=
  <select name="m">
    <option value="281474976710656">RANF (CDC 60000 FTN Compiler )</option>
    <option value="2147483648">GGUBS (IMSL Routine)</option>
    <option value="2147483648">RANDU (IBM Scientific Subroutine)</option>
    <option value="2147483648">GGL (IBM subroutine Lib.-Math.)</option>
  </select>
        <input type="submit" name="submit" value="JALANKAN"/>
 </form>
 <?php
    $hasilx = '';
    if (isset($_POST['submit'])) {
      $a= $_POST['a'];
      $m= $_POST['m'];
      echo 'm='.$m;echo '<br>';
      echo 'a='.$a;echo '<br>';

        for ($i=0; $i < 1000; $i++) {

            $n = $_POST['nilain'];
            $p = $_POST['nilaip'];
            $hasilx = binomial1($n, $p);

            echo $hasilx."<br>";
            }
    }

 ?>
</body>
</html>
