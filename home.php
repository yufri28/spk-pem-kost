<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['role'] == 1) {
    header("Location: ./user/index.php");
} else if (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['role'] == 0) {
    header("Location: ./admin/index.php");
}
require_once './config.php';
$alternatif = $koneksi->query("SELECT a.nama_alternatif, a.id_alternatif, a.latitude, a.longitude, a.jenis_kost,
MAX(CASE WHEN k.nama_kriteria = 'Fasilitas' THEN kak.id_alt_kriteria END) AS id_sub_C1,
MIN(CASE WHEN k.nama_kriteria = 'Jarak' THEN kak.id_alt_kriteria END) AS id_sub_C2,
MIN(CASE WHEN k.nama_kriteria = 'Biaya' THEN kak.id_alt_kriteria END) AS id_sub_C3,
MAX(CASE WHEN k.nama_kriteria = 'Luas Kamar' THEN kak.id_alt_kriteria END) AS id_sub_C4,
MAX(CASE WHEN k.nama_kriteria = 'Keamanan' THEN kak.id_alt_kriteria END) AS id_sub_C5,
MAX(CASE WHEN k.nama_kriteria = 'Fasilitas' THEN sk.nama_sub_kriteria END) AS nama_C1,
MIN(CASE WHEN k.nama_kriteria = 'Jarak' THEN sk.nama_sub_kriteria END) AS nama_C2,
MIN(CASE WHEN k.nama_kriteria = 'Biaya' THEN sk.nama_sub_kriteria END) AS nama_C3,
MAX(CASE WHEN k.nama_kriteria = 'Luas Kamar' THEN sk.nama_sub_kriteria END) AS nama_C4,
MAX(CASE WHEN k.nama_kriteria = 'Keamanan' THEN sk.nama_sub_kriteria END) AS nama_C5
FROM alternatif a
JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria
GROUP BY a.nama_alternatif;");

?>

<!DOCTYPE html>
<html>

<head>
    <title>SPK Pemilihan Kost</title>
    <style>
        #mapid {
            height: 100vh;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Prompt&family=Righteous&family=Roboto:wght@500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <div class="logo-section p-2 d-flex">
            <h3 class="mt-2" style="font-family: 'Righteous' cursive">SPK PEMILIHAN KOST</h3>
            <div class="navbar-nav ms-auto">
                <div class="d-flex">
                    <a class="btn btn-primary mt-2 px-4 me-2 py-1 btn-sm" href="./auth/login.php">Login</a>
                    <a class="btn btn-secondary mt-2 px-4 py-1 btn-sm" href="./user/index.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg> Cari Kost</a>
                </div>
            </div>
        </div>
    </div>
    <div id="mapid"></div>
    <footer class="bg-white text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: #F0F0F0;">
            © 2023 Copyright:
            <a class="text-dark" href="https://www.instagram.com/ilkom19_unc/">Intel'19</a>
        </div>
        <!-- Copyright -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var mymap = L.map('mapid').setView([-10.178443, 123.577572], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(mymap);

        <?php
        foreach ($alternatif as $location) {
            // if($location['latitude'] != '-' && $location['longitude'] != '-'){
            //     echo "var marker = L.marker([" . $location['latitude'] . ", " . $location['longitude'] . "]).addTo(mymap);";
            //     echo "marker.bindPopup('<b>" . $location['nama_alternatif'] . "</b><br>Fasilitas : " . $location['nama_C1'] . "<br>Jarak : " . $location['nama_C2'] . "<br>Biaya : " . $location['nama_C3'] . "<br>Luas Kamar : " . $location['nama_C4'] . "<br>Keamanan : " . $location['nama_C5'] . "').openPopup();";
            // }

            if ($location['latitude'] != '-' && $location['longitude'] != '-') {
                echo "var marker = L.marker([" . $location['latitude'] . ", " . $location['longitude'] . "], {";
                echo "  icon: L.divIcon({";
                if ($location['jenis_kost'] == 'Campuran') {
                    echo "className: 'custom-icon-green',";
                } elseif ($location['jenis_kost'] == 'Laki-Laki') {
                    echo "className: 'custom-icon-blue',";
                } elseif ($location['jenis_kost'] == 'Perempuan') {
                    echo "className: 'custom-icon-campuran',";
                }
                echo "    html: '<i class=\"fa fa-home\"></i>',"; // Menggunakan kelas 'fa' dan kelas angka sesuai dengan $iconNumber
                echo "    iconSize: [40, 40],";
                echo "    iconAnchor: [20, 40]";
                echo "  })";
                echo "}).addTo(mymap);";
                echo "marker.bindPopup('<b>" . $location['nama_alternatif'] . "</b><br>Fasilitas : " . $location['nama_C1'] . "<br>Jarak : " . $location['nama_C2'] . "<br>Biaya : " . $location['nama_C3'] . "<br>Luas Kamar : " . $location['nama_C4'] . "<br>Keamanan : " . $location['nama_C5'] . "').openPopup();";
            }
        }
        ?>

        // Tambahkan legenda
        var legend = L.control({
            position: 'bottomright'
        });

        legend.onAdd = function(map) {
            var div = L.DomUtil.create('div', 'info legend');
            div.innerHTML +=
                '<i style="color: #EB455F;font-size: 20pt;" class="fa fa-home"></i> Campuran<br>' +
                '<i style="color: blue;font-size: 20pt;" class="fa fa-home"></i> Laki-Laki<br>' +
                '<i style="color: #17594A;font-size: 20pt;" class="fa fa-home"></i> Perempuan<br>';

            return div;
        };

        legend.addTo(mymap);
    </script>
</body>

</html>
<style>
    .legend {
        background-color: white;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .legend i {
        width: 20px;
        height: 20px;
        display: inline-block;
        margin-right: 5px;
    }

    .custom-icon-campuran {
        text-align: center;
        color: #EB455F;
        font-size: 20pt;
        font-weight: bold;
    }

    .custom-icon-blue {
        text-align: center;
        color: blue;
        font-size: 20pt;
        font-weight: bold;
    }

    .custom-icon-green {
        text-align: center;
        color: #17594A;
        font-size: 20pt;
        font-weight: bold;
    }
</style>