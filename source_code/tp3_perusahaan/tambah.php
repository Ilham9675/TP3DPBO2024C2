<?php

include('config/db.php');
include('classes/DB.php');
include('classes/education.php');
include('classes/employee.php');
include('classes/jobtitle.php');
include('classes/Template.php');

$pegawai = new employee($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$education = new education($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jobtitle = new jobtitle($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pegawai->open();
$education->open();
$jobtitle->open();
// $data = nulL;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['btn-submit'])) {
    // Ambil data dari form
    $data = array(
        'nama_depan' => $_POST['nama_depan'],
        'nama_belakang' => $_POST['nama_belakang'],
        'Gender' => $_POST['gender'],
        'Street' => $_POST['alamat'],
        'City' => $_POST['kota'],
        'EducationID' => $_POST['education_id'],
        'JobID' => $_POST['joptitle_id'],
    );
    $file = $_FILES['foto'];

    if ($_GET['action'] == 'add') {
        // Panggil fungsi untuk menambahkan data
        if ($pegawai->addData($data, $file)) {
            echo "Data berhasil dimasukkan.";
        } else {
            echo "Gagal memasukkan data.";
        }
    } elseif ($_GET['action'] == 'update') {
        // Panggil fungsi untuk memperbarui data
        if ($pegawai->updateData($_GET['id'], $data, $file)) {
            echo "Data berhasil diperbarui.";
        } else {
            echo "Gagal memperbarui data.";
        }
    }

    header("Location: index.php");
    exit;
}else{
    $data_form = null;
    $nama_depan = '';
    $nama_belakang = '';
    $gender = '';
    $alamat = '';
    $kota = '';
    $education_id = '';
    $joptitle_id = '';
    $foto = '';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $pegawai->getemployeeById($id);
        $row = $pegawai->getResult();
        $nama_depan = $row['FirstName'];
        $nama_belakang = $row['LastName'];
        $gender = $row['Gender'];
        $alamat = $row['Street'];
        $kota = $row['City'];
        $education_id = $row['EducationID'];
        $joptitle_id = $row['JobID'];
        $foto = $row['Foto'];
    }
    
    $data_education = null;
    $education->geteducation();
    $index = 0;
    while($row = $education->getResult()) {
        $selected = $row['EducationID'] == $education_id ? ' selected' : '';
        $data_education .= '<option value="' . $row['EducationID'] . '"' . $selected . '>' . $row['EducationName'] . '</option>';
        $index += 1;
    }
    if($index == 0){
        $data_education .= '<option value="">Tidak ada divisi</option>';
    }
    
    $data_jobtitle = null;
    $jobtitle->getjobtitle();
    $index = 0;
    while($row = $jobtitle->getResult()) {
        $selected = $row['JobID'] == $joptitle_id ? ' selected' : '';
        $data_jobtitle .= '<option value="' . $row['JobID'] . '"' . $selected . '>' . $row['JobName'] . '</option>';
        $index += 1;
    }
    if($index == 0){
        $data_jobtitle .= '<option value="">Tidak ada divisi</option>';
    }
    
    $action = isset($_GET['id']) ? 'update&id=' . $_GET['id'] : 'add';
    $button = isset($_GET['id']) ? 'Update' : 'Tambahkan';
    $Data = null;
    $Data .= '<form action="tambah.php?action=' . $action . '" method="post" enctype="multipart/form-data" class="tambah-data">
    <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <div class="mb-3" style="display: flex; align-items: center;">
        ';
    
    if (isset($_GET['id'])) {
        // Tampilkan input file saja jika aksi adalah 'add'
        $Data .= '<img id="output" src="assets/images/' . $foto . '" width="200" style="border: 2px solid #000; margin-right: 20px;"/>
        <input type="file" class="form-control" id="foto" name="foto" onchange="loadFile(event)">';
    }else {
        // Tampilkan gambar yang ada dan input file jika aksi adalah 'update'
        $Data .= '<img id="output"  width="200" style="border: 2px solid #000; margin-right: 20px;"/>
        <input type="file" class="form-control" id="foto" name="foto" onchange="loadFile(event)" required>';
    }
            
        
    $Data .= '
        </div>
    </div>
    <div class="mb-3">
        <label for="nama_depan" class="form-label">Nama depan</label>
        <input type="text" class="form-control" id="nama_depan" name="nama_depan" value="' . (isset($nama_depan) ? $nama_depan : '') . '" required>
    </div>
    <div class="mb-3">
        <label for="nama_belakang" class="form-label">Nama belakang</label>
        <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" value="' . (isset($nama_belakang) ? $nama_belakang : '') . '">
    </div>
    <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select class="form-control" id="gender" name="gender" required>
            <option value="">Pilih Gender</option>
            <option value="F"' . ($gender == 'F' ? ' selected' : '') . '>Perempuan</option>
            <option value="M"' . ($gender == 'M' ? ' selected' : '') . '>Laki-laki</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" value="' . (isset($alamat) ? $alamat : '') . '" required>
    </div>
    <div class="mb-3">
        <label for="kota" class="form-label">kota</label>
        <input type="text" class="form-control" id="kota" name="kota" value="' . (isset($kota) ? $kota : '') . '" required>
    </div>
    <div class="mb-3">
        <label for="education_id" class="form-label">ID educarion</label>
        <select class="form-control" id="education_id" name="education_id" required>
            <option value="">pilih pendidikan</option>
            ' . $data_education .'
        </select>
    </div>
    <div class="mb-3">
        <label for="joptitle_id" class="form-label">ID joptitle</label>
        
        <select class="form-control" id="joptitle_id" name="joptitle_id" required>
            <option value="">pilih jabatan</option>
            ' . $data_jobtitle . '
        </select>
    </div>
    
    <button type=" " class="btn btn-primary" name="btn-submit">'. $button .'</button>
    </form>';

}






$jobtitle->close();
$education->close();
$pegawai->close();
$detail = new Template('templates/skinform.html');
$detail->replace('DATA_FORM', $Data);

$detail->write();
