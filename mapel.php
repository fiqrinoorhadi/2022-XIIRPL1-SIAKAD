<?php
    include('koneksi.php');
    if(isset($_POST['simpan']))
    {
        $km = $_POST['kode_mapel'];
        $nm = $_POST['nama_mapel'];

        $sql = "INSERT INTO mapel (kode_mapel,nama_mapel) VALUES ('$km','$nm')";

        $insert = mysqli_query($koneksi,$sql);

        if(!$insert){
            echo "Gagal Disimpan";
        }else{
            echo "Berhasil Disimpan";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Pelajaran</title>
    <link rel="stylesheet" href="bootstrap-5.2.0-dist/css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>Input Mapel</h1>
                <form action="" method="post">
                    <div class="form-group mb-3">
                        <label for="kode_mapel">Kode Mapel</label>
                        <input class="form-control" type="text" name='kode_mapel' id='kode_mapel'>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_mapel">Nama Mapel</label>
                        <input class="form-control" type="text" name='nama_mapel' id='nama_mapel'>
                    </div>
                    <div class="form-group mb-3">
                        <button class="btn btn-success" type="submit" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <table class="table table-striped">
                    <tr>
                        <th>No</th>
                        <th>Kode Mapel</th>
                        <th>Nama Mapel</th>
                        <th>--Action--</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>MP001</td>
                        <td>PWPB</td>
                        <td>
                            <button class="btn btn-warning">Edit</button>
                            <button class="btn btn-danger">Hapus</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-2"></div>
        </div>
        
    </div>
</body>
</html>