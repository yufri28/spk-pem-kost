<?php 
session_start();
unset($_SESSION['menu']);
$_SESSION['menu'] = 'penilaian';
require_once './../includes/header.php';
require_once './functions/kost.php';
$id_user = $_SESSION['id_user'];

// $dataAlternatif = $koneksi->query("SELECT id_alternatif, nama_alternatif FROM alternatif");
// $dataFasilitas = $koneksi->query("SELECT k.id_kriteria, k.nama_kriteria, sk.id_sub_kriteria, sk.nama_sub_kriteria FROM kriteria k JOIN sub_kriteria sk ON sk.f_id_kriteria = k.id_kriteria WHERE k.nama_kriteria = 'Fasilitas'");
// $dataJarak = $koneksi->query("SELECT k.id_kriteria, k.nama_kriteria, sk.id_sub_kriteria, sk.nama_sub_kriteria FROM kriteria k JOIN sub_kriteria sk ON sk.f_id_kriteria = k.id_kriteria WHERE k.nama_kriteria = 'Jarak'");
// $dataBiaya = $koneksi->query("SELECT k.id_kriteria, k.nama_kriteria, sk.id_sub_kriteria, sk.nama_sub_kriteria FROM kriteria k JOIN sub_kriteria sk ON sk.f_id_kriteria = k.id_kriteria WHERE k.nama_kriteria = 'Biaya'");
// $dataLuasKamar = $koneksi->query("SELECT k.id_kriteria, k.nama_kriteria, sk.id_sub_kriteria, sk.nama_sub_kriteria FROM kriteria k JOIN sub_kriteria sk ON sk.f_id_kriteria = k.id_kriteria WHERE k.nama_kriteria = 'Luas Kamar'");
// $dataKeamanan = $koneksi->query("SELECT k.id_kriteria, k.nama_kriteria, sk.id_sub_kriteria, sk.nama_sub_kriteria FROM kriteria k JOIN sub_kriteria sk ON sk.f_id_kriteria = k.id_kriteria WHERE k.nama_kriteria = 'Keamanan'");
$dataAlternatif = $penilaian->getDataAlternatif();
$dataFasilitas = $penilaian->getDataFasilitas();
$dataJarak = $penilaian->getDataJarak();
$dataBiaya = $penilaian->getDataBiaya();
$dataLuasKamar = $penilaian->getDataLuasKamar();
$dataKeamanan = $penilaian->getDataKeamanan();
$dataPenilaian = $penilaian->getDataPenilaian();

if(isset($_POST['simpan'])){
    $prioritas1 = $_POST['prioritas_1'];
    $prioritas2 = $_POST['prioritas_2'];
    $prioritas3 = $_POST['prioritas_3'];
    $prioritas4 = $_POST['prioritas_4'];
    $prioritas5 = $_POST['prioritas_5'];
    $dataTampung = [
        $prioritas1,$prioritas2,$prioritas3,$prioritas4,$prioritas5
    ];
    $dataBobotPenilaian = [
        $prioritas1 => 0.3,
        $prioritas2 => 0.2,
        $prioritas3 => 0.2,
        $prioritas4 => 0.2,
        $prioritas5 => 0.1,
    ];
    $penilaian->tambahTampung($dataTampung, $id_user);
    $tambahPenilaianBobot = $penilaian->tambahPenilaianBobot($dataBobotPenilaian, $id_user);
}
if(isset($_POST['edit'])){
    $id = $_POST['id_tampung'];
    $prioritas1 = $_POST['prioritas_1'];
    $prioritas2 = $_POST['prioritas_2'];
    $prioritas3 = $_POST['prioritas_3'];
    $prioritas4 = $_POST['prioritas_4'];
    $prioritas5 = $_POST['prioritas_5'];

    $dataTampung = [
        $prioritas1,$prioritas2,$prioritas3,$prioritas4,$prioritas5
    ];
    $dataBobotPenilaian = [
        $prioritas1 => 0.3,
        $prioritas2 => 0.2,
        $prioritas3 => 0.2,
        $prioritas4 => 0.2,
        $prioritas5 => 0.1,
    ];
    $tambahPenilaianBobot = $penilaian->editPenilaianBobot($id,$dataBobotPenilaian);
    $penilaian->editTampung($id,$dataTampung);
}

$idKriteriaC1 = mysqli_fetch_assoc($dataFasilitas);
$idKriteriaC2 = mysqli_fetch_assoc($dataJarak);
$idKriteriaC3 = mysqli_fetch_assoc($dataBiaya);
$idKriteriaC4 = mysqli_fetch_assoc($dataLuasKamar);
$idKriteriaC5 = mysqli_fetch_assoc($dataKeamanan);


$dataKriteria = [
    "Fasilitas", "Jarak", "Biaya", "Luas Kamar", "Keamanan"
];


$stmt = $koneksi->prepare("SELECT * FROM bobot_kriteria WHERE f_id_user=?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$dataTampung = $koneksi->query("SELECT * FROM tabel_tampung WHERE f_id_user='$id_user'");


?>
<!-- Tampilkan pesan sukses atau error jika sesi tersebut diatur -->
<?php if (isset($_SESSION['success'])): ?>
<script>
Swal.fire({
    title: 'Sukses!',
    text: '<?php echo $_SESSION['success']; ?>',
    icon: 'success',
    confirmButtonText: 'OK'
});
</script>
<?php unset($_SESSION['success']); // Menghapus session setelah ditampilkan ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
<script>
Swal.fire({
    title: 'Error!',
    text: '<?php echo $_SESSION['error']; ?>',
    icon: 'error',
    confirmButtonText: 'OK'
});
</script>
<?php unset($_SESSION['error']); // Menghapus session setelah ditampilkan ?>
<?php endif; ?>
<div class="container mb-5 pt-5" style="font-family: 'Prompt', sans-serif">
    <div class="row">
        <div class="d-xxl-flex">
            <div class="col-xxl-12 mt-5 ms-xxl-1">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        DAFTAR KOST
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered nowrap" style="width:100%"
                                id="table-penilaian">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Kost</th>
                                        <th scope="col">Fasilitas</th>
                                        <th scope="col">Jarak</th>
                                        <th scope="col">Biaya</th>
                                        <th scope="col">Luas Kamar</th>
                                        <th scope="col">Keamanan</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <?php foreach ($dataPenilaian as $i => $nilai):?>
                                    <tr>
                                        <th scope="row"><?= $i+1; ?></th>
                                        <td><?= $nilai['nama_alternatif']; ?></td>
                                        <td><?= $nilai['nama_C1']; ?></td>
                                        <td><?= $nilai['nama_C2']; ?></td>
                                        <td><?= $nilai['nama_C3']; ?></td>
                                        <td><?= $nilai['nama_C4']; ?></td>
                                        <td><?= $nilai['nama_C5']; ?></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<?php foreach ($dataPenilaian as $nilai):?>
<div class="modal fade" id="edit<?=$nilai['id_alternatif'];?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="mb-3 mt-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Kost</label>
                            <select class="form-select" name="id_alternatif" aria-label="Default select example">
                                <option value="">-- Pilih nama kost --</option>
                                <?php foreach($dataAlternatif as $alternatif):?>
                                <option <?=$alternatif['id_alternatif'] == $nilai['id_alternatif'] ? 'selected':'';?>
                                    value="<?=$alternatif['id_alternatif'];?>">
                                    <?=$alternatif['nama_alternatif'];?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <input type="hidden" name="id_alt_kriteria[]" value="<?=$nilai['id_sub_C1'];?>">
                            <input type="hidden" name="kriteria[]" value="<?=$idKriteriaC1['id_kriteria'];?>">
                            <label for="exampleFormControlInput1" class="form-label">Fasilitas</label>
                            <select class="form-select" name="sub_kriteria[]">
                                <option value="">-- Pilih fasilitas --</option>
                                <?php foreach ($dataFasilitas as $fasilitas) :?>
                                <option <?=$fasilitas['nama_sub_kriteria'] == $nilai['nama_C1'] ? 'selected':'';?>
                                    value="<?=$fasilitas['id_sub_kriteria'];?>">
                                    <?=$fasilitas['nama_sub_kriteria'];?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <input type="hidden" name="id_alt_kriteria[]" value="<?=$nilai['id_sub_C2'];?>">
                            <input type="hidden" name="kriteria[]" value="<?=$idKriteriaC2['id_kriteria'];?>">
                            <label for="Jarak" class="form-label">Jarak Kost</label>
                            <select class="form-select" name="sub_kriteria[]">
                                <option value="">-- Pilih jarak --</option>
                                <?php foreach ($dataJarak as $jarak):?>
                                <option <?=$jarak['nama_sub_kriteria'] == $nilai['nama_C2'] ? 'selected':'';?>
                                    value="<?=$jarak['id_sub_kriteria'];?>">
                                    <?=$jarak['nama_sub_kriteria'];?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <input type="hidden" name="id_alt_kriteria[]" value="<?=$nilai['id_sub_C3'];?>">
                            <input type="hidden" name="kriteria[]" value="<?=$idKriteriaC3['id_kriteria'];?>">
                            <label for="Biaya" class="form-label">Biaya Kost</label>
                            <select class="form-select" name="sub_kriteria[]">
                                <option value="">-- Pilih biaya --</option>
                                <?php foreach ($dataBiaya as $biaya):?>
                                <option <?=$biaya['nama_sub_kriteria'] == $nilai['nama_C3'] ? 'selected':'';?>
                                    value="<?=$biaya['id_sub_kriteria'];?>">
                                    <?=$biaya['nama_sub_kriteria'];?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <input type="hidden" name="id_alt_kriteria[]" value="<?=$nilai['id_sub_C4'];?>">
                            <input type="hidden" name="kriteria[]" value="<?=$idKriteriaC4['id_kriteria'];?>">
                            <label for="luas_kamar" class="form-label">Luas Kamar</label>
                            <select class="form-select" name="sub_kriteria[]">
                                <option value="">-- Pilih luas kamar --</option>
                                <?php foreach ($dataLuasKamar as $luas_kamar):?>
                                <option <?=$luas_kamar['nama_sub_kriteria'] == $nilai['nama_C4'] ? 'selected':'';?>
                                    value="<?=$luas_kamar['id_sub_kriteria'];?>">
                                    <?=$luas_kamar['nama_sub_kriteria'];?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <input type="hidden" name="id_alt_kriteria[]" value="<?=$nilai['id_sub_C5'];?>">
                            <input type="hidden" name="kriteria[]" value="<?=$idKriteriaC5['id_kriteria'];?>">
                            <label for="keamanan" class="form-label">Keamanan</label>
                            <select class="form-select" name="sub_kriteria[]">
                                <option value="">-- Pilih keamanan --</option>
                                <?php foreach ($dataKeamanan as $keamanan):?>
                                <option <?=$keamanan['nama_sub_kriteria'] == $nilai['nama_C5'] ? 'selected':'';?>
                                    value="<?=$keamanan['id_sub_kriteria'];?>">
                                    <?=$keamanan['nama_sub_kriteria'];?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="edit" class="btn btn-outline-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach;?>
<?php 
require_once './../includes/footer.php';
?>
<script>
$(document).ready(function() {
    $("#prioritas_1").change(function() {
        var prioritas_1 = $("#prioritas_1").val();
        $.ajax({
            type: 'POST',
            url: "./functions/pilihan.php",
            data: {
                prioritas_1: [prioritas_1]
            },
            cache: false,
            success: function(msg) {
                $("#prioritas_2").html(msg);
            }
        });
    });

    $("#prioritas_2").change(function() {
        var prioritas_1 = $("#prioritas_1").val();
        var prioritas_2 = $("#prioritas_2").val();
        $.ajax({
            type: 'POST',
            url: "./functions/pilihan.php",
            data: {
                prioritas_2: [prioritas_1, prioritas_2]
            },
            cache: false,
            success: function(msg) {
                $("#prioritas_3").html(msg);
            }
        });
    });

    $("#prioritas_3").change(function() {
        var prioritas_1 = $("#prioritas_1").val();
        var prioritas_2 = $("#prioritas_2").val();
        var prioritas_3 = $("#prioritas_3").val();
        $.ajax({
            type: 'POST',
            url: "./functions/pilihan.php",
            data: {
                prioritas_3: [prioritas_1, prioritas_2, prioritas_3]
            },
            cache: false,
            success: function(msg) {
                $("#prioritas_4").html(msg);
            }
        });
        $("#prioritas_4").change(function() {
            var prioritas_1 = $("#prioritas_1").val();
            var prioritas_2 = $("#prioritas_2").val();
            var prioritas_3 = $("#prioritas_3").val();
            var prioritas_4 = $("#prioritas_4").val();
            $.ajax({
                type: 'POST',
                url: "./functions/pilihan.php",
                data: {
                    prioritas_4: [prioritas_1, prioritas_2, prioritas_3, prioritas_4]
                },
                cache: false,
                success: function(msg) {
                    $("#prioritas_5").html(msg);
                }
            });
        });
    });
});
</script>