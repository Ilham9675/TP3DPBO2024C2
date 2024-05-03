<?php

include('config/db.php');
include('classes/DB.php');
include('classes/education.php');
include('classes/employee.php');
include('classes/jobtitle.php');
include('classes/Template.php');

$pegawai = new employee($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pegawai->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $pegawai->getemployeeById($id);
        $row = $pegawai->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' .  $row['FirstName'] . ' ' . $row['LastName']  . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['Foto'] . '" class="img-thumbnail" alt="' . $row['Foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['FirstName'] . ' ' . $row['LastName'] . '</td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>:</td>
                                    <td>' . ($row['Gender'] == 'F' ? 'Perempuan' : 'Laki-laki') . '</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>' . $row['Street'] . ' ' . $row['City'] . '</td>
                                </tr>
                                <tr>
                                    <td>pendidikan</td>
                                    <td>:</td>
                                    <td>' . $row['EducationName'] . '</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>' . $row['JobName'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="tambah.php?id=' . $row['EID'] . '"><button type="button" class="btn btn-success text-white" >Ubah Data</button></a>
                <a href="delete.php?id=' . $row['EID'] . '"><button type="button" class="btn btn-danger" >Hapus Data</button></a>
            </div>';
    }
}




$pegawai->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_PENGURUS', $data);
$detail->write();
