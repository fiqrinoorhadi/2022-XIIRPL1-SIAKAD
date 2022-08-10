<?php

//memanggil script koneksi yang ada di koneksi.php
include('koneksi.php');

//variable kosong untuk menghindari error echo variable yang ada di input masing2 form input
$nis_edit        = "";
$nama_edit       = "";
$kelas_edit      = "";
$jurusan_edit    = "";

//pengecekan pada url apakah ada indeks key 'proses' pada url browser, pada saat pencet tombol hapus ataupun edit. Jika ada, maka jalankan kode program yang ada didalam kondisi if tersebut
if (isset($_GET['proses'])) 
{
    //variabel $id untuk menyimpan nilai id yang diambil dari url, setelah klik tombol hapus ataupun edit
    $id = $_GET['id'];

    //pengecekan pada url apakah indeks key 'proses' berisi = 'hapus'. Jika sama, maka jalankan kode program yang ada didalam kondisi if tersebut
    if ($_GET['proses']=='hapus') 
    {
        //query delete sql yang di masukan kedalam variable $sql
        $sql = "DELETE FROM siswa WHERE id='$id'";

        //eksekusi query sql yang sebelumnya dibuat menggunakan function mysqli_query dan disimpan kedalam variable $delete
        $delete = mysqli_query($koneksi,$sql);

        //pengecekan kondisi if jika eksekusi query $delete gagal atau tidak
        if (!$delete) 
        {
            echo "Gagal di Delete";
        }
        else
        {
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil Di Delete!</strong> Mudah-mudahan datanya sudah ke delete.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }

        //Javascript untuk refresh page dengan jangka waktu, agar urlnya kembali ke siswa.php
        ?>
        <script>
            setTimeout(function () 
            {    
                window.location.href = 'http://localhost/01-siakad-fiqri/siswa.php'; 
            },1500); // 1500 = 1.5 seconds
        </script>
        <?php
    }

    if ($_GET['proses']=='edit') 
    {
        $sql = "SELECT * FROM siswa WHERE id = '$id'";
        $select = mysqli_query($koneksi,$sql);

        //agar data yang diambil dari database dapat ditampilkan, hasil eksekusi mysqli_query harus diproses kembali menggunakan mysqli_fetch_assoc
        $data = mysqli_fetch_assoc($select);

        //variable untuk menyimpan data dari database
        $nis_edit       = $data['nis'];
        $nama_edit      = $data['nama'];
        $kelas_edit     = $data['kelas'];
        $jurusan_edit   = $data['jurusan'];
    }
    
}
    

if (isset($_POST['simpan_input_form'])) 
{
    
    $nis        = $_POST['nis_input_form'];
    $nama       = $_POST['nama_input_form'];
    $kelas      = $_POST['kelas_input_form'];
    $jurusan    = $_POST['jurusan_input_form'];

    if (isset($_GET['proses'])) 
    {
        $id = $_GET['id'];
        $sql = "UPDATE siswa SET nis = '$nis',
        nama = '$nama', kelas = '$kelas', jurusan = '$jurusan'
        WHERE id = '$id'";
        $update = mysqli_query($koneksi,$sql);
    }
    else
    {

        $sql = "INSERT INTO siswa(nis,nama,kelas,jurusan) VALUES ('$nis','$nama','$kelas','$jurusan')";
        $insert = mysqli_query($koneksi,$sql);
        if (!$insert) 
        {
            echo $gagal =  "Data Gagal Disimpan";
        }
        else
        {
            echo $sukses = "Data Berhasil Disimpan";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="bootstrap-5.2.0-dist/css/bootstrap.css">
    <script src="bootstrap-5.2.0-dist/js/bootstrap.js"></script>
</head>
<body>
    <div class="container">
        <div class="row"> <!-- div row 1 -->
            <div class="col-3">kolom 1</div>
            <div class="col-6">
                <!-- ini  -->
                <div class="card">
                    <div class="card-header">
                        Form Data Siswa
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input value="<?php echo $nis_edit ?>" class="form-control" type="text" name="nis_input_form" id="nis" required>
                            </div>

                            <div class="form-group">
                                <label for="nama">Nama Siswa</label>
                                <input value="<?php echo $nama_edit ?>" class="form-control" type="text" name="nama_input_form" id="nama" required>
                            </div>

                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select class="form-control" name="kelas_input_form" id="kelas">
                                    <option value="<?php echo $kelas_edit ?>"><?php echo $kelas_edit ?></option>
                                    <option value="XII RPL 1">XII RPL 1</option>
                                    <option value="XII RPL 2">XII RPL 2</option>
                                    <option value="XII RPL 3">XII RPL 3</option>
                                    <option value="XII TKR 1">XII TKR 1</option>
                                    <option value="XII TKR 2">XII TKR 2</option>
                                    <option value="XII TKR 3">XII TKR 3</option>
                                    <option value="XII TITL 1">XII TITL 1</option>
                                    <option value="XII TITL 2">XII TITL 2</option>
                                    <option value="XII TITL 3">XII TITL 3</option>
                                    <option value="XII TAV 1">XII TAV 1</option>
                                    <option value="XII TAV 2">XII TAV 2</option>
                                    <option value="XII TAV 3">XII TAV 3</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <select class="form-control" name="jurusan_input_form" id="jurusan">
                                    <option value="<?php echo $jurusan_edit?>"><?php echo $jurusan_edit ?></option>
                                    <option value="RPL">Rekayasa Perangkat Lunak</option>
                                    <option value="TKR">Teknik Kendaraan Ringan</option>
                                    <option value="TITL">Teknik Instalasi Tenaga Listrik</option>
                                    <option value="TAV">Teknik Audio Video</option>
                                </select>
                            </div>
                            <button class="btn btn-success" type="submit" name="simpan_input_form">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-3">kolom 3</div>
        </div> <!-- ini penutup tag row 1 -->

        <div class="row"> <!-- row ke2 -->
            <div class="col-2"></div>
            <div class="col-8">
                <table class="table table-striped">
                    <tr>
                        <td>No</td>
                        <td>NIS</td>
                        <td>Nama</td>
                        <td>Kelas</td>
                        <td>Jurusan</td>
                        <td>--Action--</td>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM siswa";
                    $select = mysqli_query($koneksi,$sql);
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($select)) {
                    ?>
                    <tr>
                        <td><?php echo $no ; ?></td>
                        <td><?php echo $data['nis']; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['kelas']; ?></td>
                        <td><?php echo $data['jurusan']; ?></td>
                        <td>
                            <a href="?proses=edit&id=<?php echo $data['id']; ?>">
                                <button class="btn btn-warning">edit</button>
                            </a>
                            <a href="?proses=hapus&id=<?php echo $data['id']; ?>">
                                <button class="btn btn-danger">hapus</button>
                            </a>
                            
                    </td>
                    </tr>
                    <?php
                    $no++;
                    }
                    ?>
                </table>
            </div>
            <div class="col-2"></div>
        </div> <!-- penutup row ke2 -->

    </div>
</body>
</html>