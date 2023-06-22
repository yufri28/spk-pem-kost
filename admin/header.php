<?php 
require_once '../config.php';
global $conn;

if(!isset($_SESSION['login']) && $_SESSION['login'] != true){
    header("Location: ../index.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Prompt&family=Righteous&family=Roboto:wght@500&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="logo-section p-2">
            <h3 style="font-family: 'Righteous', cursive">SPK PEMILIHAN KOST</h3>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg sticky-top shadow-lg fixed-top" style="background-color: #3b6dd8"
        data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup" style="font-family: 'Manrope', sans-serif">
                <div class="navbar-nav ms-auto me-auto mt-3 mb-3">
                    <a class="nav-link <?=$_SESSION['menu'] == 'beranda-admin' ? 'active':'';?>"
                        href="index.php">Beranda</a>
                    <a class="nav-link <?=$_SESSION['menu'] == 'alternatif' ? 'active':'';?>"
                        href="alternatif.php">Alternatif</a>
                    <a class="nav-link <?=$_SESSION['menu'] == 'kriteria' ? 'active':'';?>"
                        href="kriteria.php">Kriteria</a>
                    <a class="nav-link <?=$_SESSION['menu'] == 'sub-kriteria' ? 'active':'';?>" href="#">Sub
                        Kriteria</a>
                    <a class="nav-link <?=$_SESSION['menu'] == 'bobot' ? 'active':'';?>" href="#">Bobot</a>
                    <a class="nav-link <?=$_SESSION['menu'] == 'penilaian' ? 'active':'';?>"
                        href="penilaian.php">Penilaian</a>
                    <a class="nav-link <?=$_SESSION['menu'] == 'hasil' ? 'active':'';?>" href="hasil.php">Hasil</a>
                    <a class="nav-link <?=$_SESSION['menu'] == 'hasil' ? 'active':'';?>"
                        href="../auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>