
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
  <input type="text" name="miu" placeholder="INPUT miu" />
  <input type="text" name="thosqr" placeholder="INPUT tho_sqr" />
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

            $mu = $_POST['miu'];
            $tho_sqr = $_POST['thosqr'];
            $hasilx = substr(normal($mu, $tho_sqr),0,4);

            echo $hasilx."<br>";
            }
    }

 ?>
</body>
</html>
<!-- <?php

    if (isset($_POST['tampilkan'])){
        $miu = $_POST['miu'];
        $tho_sqr = $_POST['tho_sqr'];
        $a=0;
        $m=0;
        $percobaan = $_POST['percobaan'];
        for($i = 0; $i < $percobaan; $i++){
            $arrayHasil[] = substr(dist1($miu,$tho_sqr),0,4);
        }
    }
?> -->
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>UTS Topik 35</title>
    <style>
        .form-jumlah {
            position:fixed;
            width:30%;
        }

        .act-btn{
            background:#3792cb;
            display: block;
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            color: white;
            font-size: 30px;
            font-weight: bold;
            border-radius: 50%;
            -webkit-border-radius: 80%;
            text-decoration: none;
            transition: ease all 0.3s;
            position: fixed;
            right: 30px;
            bottom:30px;
        }

        .act-btn:hover{
            background: #1c4966;
            text-decoration: none;
            color:white;
            }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark navbar-fixed-top">
<a class="navbar-brand" href="#">Topik 35</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Fixed
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php">Dist 1 x Dist 1</a>
                    <a class="dropdown-item" href="index1.php">Dist 1 x Dist 2</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="acak.php">Acak</a>
                <a class="nav-link" href="dist1.php">dist1 loop</a>
            </li>
        </ul>
    </div>
</nav>

<div class="judul text-center mt-5">
    <h1>UTS Topik 35 <small class="text-muted">(Dist 1 x Dist 1)</small></h1>
</div>

<div class="konten text-center container">

    <div class="row">

        <div class="col-6 p-5">
            <div class="form-jumlah">

                <form action="" method="post">
                <label for="">Dist x, </label>
                    <div class="row">
                        <div class="col-12 pb-3">
                            <input type="text" class="form-control" placeholder="Nilai miu" name="miu" required>
                            <input type="text" class="form-control" placeholder="Nilai tho sqr" name="tho_sqr" required>
                        </div>
                    </div>
                    <input type="number" class="form-control" placeholder="Masukkan banyak data" name="percobaan" required><br>
                    <button class="btn btn-info" name="tampilkan" type="submit">Tampilkan data</button>
                </form>
            </div>

        </div>
        <div class="col-6  p-5 hasil-random">
          A=
          <select name="a">
            <option value="44485709377909">RANF (CDC 60000 FTN Compiler )</option>
            <option value="16807">GGUBS (IMSL Routine)</option>
            <option value="65539">RANDU (IBM Scientific Subroutine)</option>
            <option value="16807">GGL (IBM subroutine Lib.-Math.)</option>
          </select>
<br>
          M=
          <select name="m">
            <option value="281474976710656">RANF (CDC 60000 FTN Compiler )</option>
            <option value="2147483648">GGUBS (IMSL Routine)</option>
            <option value="2147483648">RANDU (IBM Scientific Subroutine)</option>
            <option value="2147483648">GGL (IBM subroutine Lib.-Math.)</option>
          </select>
        <?php if(isset($_POST['tampilkan'])){
          $a= $_POST['a'];
          $m= $_POST['m'];
          echo 'm='.$m;echo '<br>';
          echo 'a='.$a;echo '<br>';
          ?>
            <table class="table">

                <tr>
                    <th>arrayHasil</th>
                </tr>
                <tr>
                    <td><?php for($i = 0; $i < $percobaan; $i++){
                        echo $arrayHasil[$i];
                        echo '<br>';
                        } ?></td>
                </tr>

            </table>
            <?php
            echo "<br>";
            echo "Nilai mean = $mean";
           ?>
            <br>
        <?php } else { ?>
            <h5>Belum ada data untuk ditampilkan</h5>
        <?php } ?>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html> -->
