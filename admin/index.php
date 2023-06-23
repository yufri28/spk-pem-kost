<?php 
session_start();
unset($_SESSION['menu']);
$_SESSION['menu'] = 'beranda-admin';
require_once './header.php';
$alternatif = $koneksi->query("SELECT a.nama_alternatif, a.id_alternatif, a.latitude, a.longitude,
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
<div class="container">
    <div class="row">
        <div class="col-4 mt-2">
            <div class="teks d-flex align-items-center justify-content-center">
                <div class="">
                    <h5 class="display-6 fw-bold ls-tight">
                        Sistem Pendukung Keputusan <br />
                        <span class="text-primary">Pemilihan Kost</span>
                    </h5>
                    <p style="color: hsl(217, 10%, 50.8%)">
                        Sistem pendukung keputusan menggunakan metode <i style="color:#116A7B">Simple Additive
                            Weighting</i>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card mt-2 mb-4">
                <div class="card-body">
                    <div id="mapid"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
require_once './footer.php';
?>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
var mymap = L.map('mapid').setView([-10.178443, 123.577572], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(mymap);

<?php
      foreach ($alternatif as $location) {
        if($location['latitude'] != '-' && $location['longitude'] != '-'){
            echo "var marker = L.marker([" . $location['latitude'] . ", " . $location['longitude'] . "]).addTo(mymap);";
            echo "marker.bindPopup('<b>" . $location['nama_alternatif'] . "</b><br>Fasilitas : " . $location['nama_C1'] . "<br>Jarak : " . $location['nama_C2'] . "<br>Biaya : " . $location['nama_C3'] . "<br>Luas Kamar : " . $location['nama_C4'] . "<br>Keamanan : " . $location['nama_C5'] . "').openPopup();";
        }
      }
    ?>
</script>