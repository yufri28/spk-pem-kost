<?php 
session_start();
unset($_SESSION['menu']);
$_SESSION['menu'] = 'beranda-admin';
require_once './header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card mt-4">
                <div class="card-body">
                    <h3>
                        SELAMAT DATANG DI SISTEM PENDUKUNG KEPUTUSAN PEMILIHAN KOST
                        MENGGUNAKAN METODE SIMPLE ADDITIVE WEIGHTING
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
require_once './footer.php';
?>