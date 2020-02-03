<?php
    include 'uts.php';

    if (isset($_POST['tampilkan'])){
            $tfinal = $_POST['tfinal'];
            $s = $_POST['s'];
            $q = $_POST['q'];
            $percobaan = $_POST['percobaan'];
            $Tyear = array();
            $aveannualcost = array();
            $aveinv = array();
            $aveorderperyear = array();
            $avelostdemandperyear = array();
            for($i = 0; $i < $percobaan; $i++){
                $arrayHasil = topik35_0($tfinal,$s,$q);
                array_push($Tyear,$arrayHasil[0]);
                array_push($aveannualcost,$arrayHasil[1]);
                array_push($aveinv,$arrayHasil[2]);
                array_push($aveorderperyear,$arrayHasil[3]);
                array_push($avelostdemandperyear,$arrayHasil[4]);
            }
              $mean = mean($aveorderperyear);
        }
        ?>
<!DOCTYPE html>
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
    <h1>UTS Topik 35 <small class="text-muted">(Dist 1)</small></h1>
</div>

<div class="konten text-center container">

    <div class="row">

        <div class="col-6 p-5">
            <div class="form-jumlah">

                <form action="" method="post">
                <label for="">, </label>
                    <div class="row">
                        <div class="col-12 pb-3">
                            <input type="text" class="form-control" placeholder="Nilai miu" name="nilaia" required>
                            <input type="text" class="form-control" placeholder="Nilai thosqr" name="nilaib" required>
                        </div>
                    </div>

                    <label for="">,</label>
                    <div class="row">
                        <div class="col-12 pb-3">
                            <input type="text" class="form-control" placeholder="tfinal" name="tfinal" required>
                            <input type="text" class="form-control" placeholder="s" name="s" required>
                            <input type="text" class="form-control" placeholder="q" name="q" required>
                        </div>
                    </div>
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
                    <input type="number" class="form-control" placeholder="Masukkan banyak data" name="percobaan" required><br>
                    <button class="btn btn-info" name="tampilkan" type="submit">Tampilkan data</button>
                </form>
            </div>

        </div>
        <div class="col-6  p-5 hasil-random">
        <?php if(isset($_POST['tampilkan'])){ ?>
            <table class="table">

              <tr>
                                  <th>Tyear</th>
                                  <th>aveannualcost</th>
                                  <th>aveinv</th>
                                  <th>aveorderperyear</th>
                                  <th>avelostdemandperyear</th>
                              </tr>
                              <?php for($i = 0; $i < $percobaan; $i++){
                                  echo '<tr>';
                                      echo '<td>';
                                              echo $Tyear[$i];
                                      echo '</td>';
                                      echo '<td>';
                                              echo $aveannualcost[$i];
                                      echo '</td>';
                                      echo '<td>';
                                              echo $aveinv[$i];
                                      echo '</td>';
                                      echo '<td>';
                                              echo $aveorderperyear[$i];
                                      echo '</td>';
                                      echo '<td>';
                                              echo $avelostdemandperyear[$i];
                                      echo '</td>';
                                  echo '</tr>';
                                  } ?>
            </table>
            <?php
            echo "<br>";
            echo "mean = $mean";
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
</html>
