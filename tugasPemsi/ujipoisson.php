<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Uji Poisson</title>
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


<div class="judul text-center mt-5">
    <h1>Uji Poisson <small class="text-muted"></small></h1>
</div>

<div class="konten text-center container">

    <div class="row">

        <div class="col-6 p-5">
            <div class="form-jumlah">

                <form action="" method="post">
                    <div class="row">
                        <div class="col-6 pb-3">
                            <input type="text" class="form-control" placeholder="Nilai lambda" name="nilai-lambda" required>
                        </div>
                    </div>

                    <select class="form-control mb-3" name="algoritma">
                        <option value="algo-poisson1">Algoritma 1</option>
                        <option value="algo-poisson2">Algoritma 2</option>
                    </select>
                    <?php if(isset($_POST['nilai-lambda'])): ?>
                    <!-- Button trigger modal -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm text-right" data-toggle="modal" data-target="#exampleModalCenter">
                    <span class="fa fa-search-plus"></span> Perbesar Grafik
                    </button>

                    <canvas id="myChart" width="200" height="100"></canvas>
                    <?php endif; ?>
                    <input type="number" class="form-control" placeholder="Masukkan jumlah data yang diinginkan" name="jumlah" required><br>
                    <button class="btn btn-info" name="tampilkan" type="submit">hasil</button>
                </form>

            </div>

        </div>
        <div class="col-6  p-5 hasil-random">
        <?php if(isset($_POST['jumlah'])){ ?>
            <table class="table table-striped">
                <tr>
                    <th style="width: 5%">i</th>
                    <th style="width: 20%">x</th>
                </tr>

                <?php for ($i=1; $i<=$_POST['jumlah']; $i++){
                ?>
                    <tr>
                        <td><?= $i ?></td>

                        <?php if($_POST['algoritma']=='algo-poisson1'): ?>
                            <td>
                                <?php $xSekarang = poisson1($_POST['nilai-lambda']);
                                $kumpulanX[] = $xSekarang;
                                echo $xSekarang;?>
                            </td>
                        <?php elseif($_POST['algoritma']=='algo-poisson2'):?>
                            <td>
                                <?php $xSekarang = poisson2($_POST['nilai-lambda']);
                                $kumpulanX[] = $xSekarang;
                                echo $xSekarang;?>
                            </td>
                        <?php endif; ?>

                    </tr>
                <?php } ?>

            </table>
        <?php } else { ?>
            <h5></h5>
        <?php } ?>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Grafik Diperbesar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <canvas id="myChart2" width="1000" height="500"></canvas>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>

<?php
    sort($kumpulanX);
    $hitungX = array_count_values($kumpulanX);
    $labels = "";
    $value = "";
    foreach($hitungX as $h) :
        list($key,$result) = each($hitungX);
        $labels .= "'$key'," ;
        $value .= "$result,";
    endforeach;



?>

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?=$labels?>],
        datasets: [{
            label: '# nilai x',
            data: [<?=$value?>],
            backgroundColor: [
                <?php foreach($hitungX as $h1): ?>
                'rgba(75, 192, 192, 0.2)',
                <?php endforeach ?>
            ],
            borderColor: [
                <?php foreach($hitungX as $h1): ?>
                'rgba(75, 192, 192, 1)',
                <?php endforeach ?>
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var ctx = document.getElementById('myChart2').getContext('2d');
var myChart2 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?=$labels?>],
        datasets: [{
            label: '# nilai x',
            data: [<?=$value?>],
            backgroundColor: [
                <?php foreach($hitungX as $h1): ?>
                'rgba(75, 192, 192, 0.2)',
                <?php endforeach ?>
            ],
            borderColor: [
                <?php foreach($hitungX as $h1): ?>
                'rgba(75, 192, 192, 1)',
                <?php endforeach ?>
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
</body>
</html>



<?php

$kumpulanX =[];
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

// $a = 44485709377909;
// $m = 281474976710656;

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


function binomial1($n, $p){
    $x = 0;
    $i = 1;

    while ($i < $n) {
        $u  = getU();

        if ($u < $p) {
            $x++;
        }
        $i++;
    }
    return $x;
}

function binomial2($n, $p){
    $f = (1-$p)**$n;
    $F = $f;
    $x = 0;

    $u = getU();

    while ($u > $F){
        $x++;
        $f = $f * $p *($n-$x+1)/((1-$p)*$x);
        $F = $F+$f;
    }

    return $x;
}

function eksponensial($theta){
    $e = 2.718281828459;
    $u = getU();
    $x = -$theta * log($u,$e);
    return $x;
}

function poisson1($lambda){
    $x = 0;
    $w = 0;
    while($w<1) {
        $y = eksponensial(1/$lambda);
        $w = $w + $y;
        $x++;
    }
    return $x;
}


function poisson2($lambda){
    $e = 2.718281828459;
    $x = 0;
    $f = $e**-$lambda;
    $F = $f;

    $u = getU();
    while ($u>$F){
        $x++;
        $f *= ($lambda/$x);
        $F = $F+$f;
    }
    return $x;
}

?>
