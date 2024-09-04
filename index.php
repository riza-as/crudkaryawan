<?php
include "config.php";

// Simpan / Create Data
if(isset($_POST['tombolsimpan'])) {
    $nik = $_POST['tNIK'];
    $nama = $_POST['tNAMA'];
    $divisi = $_POST['tDIVISI'];
    $jabatan = $_POST['tJABATAN'];
    $pt = $_POST['tPT'];

    $masuk = mysqli_query($konek, "INSERT INTO worker (NIK, NAMA, DIVISI, JABATAN, PT) VALUES ('$nik', '$nama', '$divisi', '$jabatan', '$pt')");

    if($masuk) {
        echo "<script>alert('Data berhasil disimpan'); document.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}

// Hapus Data
if(isset($_GET['delete'])) {
    $hapus = mysqli_query($konek, "DELETE FROM worker WHERE NIK = '{$_GET['delete']}'");
    if($hapus) {
        echo "<script>alert('Data berhasil dihapus'); document.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}

// Edit Data
if(isset($_GET['nik'])) {
    $getNIK = $_GET['nik'];
    $edit = mysqli_query($konek, "SELECT * FROM worker WHERE NIK = '$getNIK'");
    $summon = mysqli_fetch_array($edit);
}

// Update Data
if(isset($_POST['tomboledit'])) {
    $nik = $_POST['tNIK'];
    $nama = $_POST['tNAMA'];
    $divisi = $_POST['tDIVISI'];
    $jabatan = $_POST['tJABATAN'];
    $pt = $_POST['tPT'];

    $update = mysqli_query($konek, "UPDATE WORKER SET NAMA = '$nama', DIVISI = '$divisi', JABATAN = '$jabatan', PT = '$pt' WHERE NIK = '$nik'");

    if($update) {
        echo "<script>alert('Data berhasil diperbarui'); document.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data');</script>";
    }
}
?>

<form action="" method="post">
    <table>
        <tr>
            <td> NIK </td>
            <td><input type="text" name="tNIK" value="<?php echo @$summon['NIK']; ?>"/></td>
        </tr>
        <tr>
            <td> NAMA </td>
            <td><input type="text" name="tNAMA" value="<?php echo @$summon['NAMA']; ?>"/></td>
        </tr>
        <tr>
            <td> DIVISI </td>
            <td><input type="text" name="tDIVISI" value="<?php echo @$summon['DIVISI']; ?>"/></td>
        </tr>
        <tr>
            <td> JABATAN </td>
            <td><input type="text" name="tJABATAN" value="<?php echo @$summon['JABATAN']; ?>"/></td>
        </tr>
        <tr>
            <td> PT </td>
            <td><input type="text" name="tPT" value="<?php echo @$summon['PT']; ?>"/></td>
        </tr>
        <tr>
            <td bgcolor="grey" colspan="2" align="right">
                <input type="submit" name="tombolsimpan" value="Simpan">
                <input type="submit" name="tomboledit" value="Edit">
            </td>
        </tr>
    </table>
</form>

<?php
    include("config.php");
?>

<style>
    table {
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            box-shadow: inset 2px 2px 2px 2px grey, 2px 2px 2px 2px black;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color:green;
            color:green;
        }
</style>

<table>
    <tr>
        <td align="center" bgcolor="RED">NIK</td>
        <td align="center" bgcolor="YELLOW">NAMA</td>
        <td align="center" bgcolor="BLUE">DIVISI</td>
        <td align="center" bgcolor="BLUE">JABATAN</td>
        <td align="center" bgcolor="BLUE">PT</td>
        <td align="center" colspan="2" bgcolor="BLUE">Action</td>
    </tr>
    <?php
        $panggil = mysqli_query($konek, "SELECT * FROM worker ORDER BY PT ASC");
        while($data = mysqli_fetch_array($panggil)){
    ?>
    <tr>
        <td><?php echo $data['NIK']; ?></td>
        <td><?php echo $data['NAMA']; ?></td>
        <td><?php echo $data['DIVISI']; ?></td>
        <td><?php echo $data['JABATAN']; ?></td>
        <td><?php echo $data['PT']; ?></td>
        <td><a href="?delete=<?php echo $data['NIK']; ?>"><img src="trash.png" alt="" height="30" width="30"></a></td>
        <td><a href="?nik=<?php echo $data['NIK']; ?>"><img src="editikon.png" alt="" height="30" width="30"></a></td>
    </tr>
    <?php   
        }
    ?>
</table>