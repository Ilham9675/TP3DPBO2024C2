<?php

include('config/db.php');
include('classes/DB.php');
include('classes/education.php');
include('classes/employee.php');
include('classes/jobtitle.php');
include('classes/Template.php');

// buat instance pengurus
$listPegawai = new employee($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listPegawai->open();
// tampilkan data pengurus
$listPegawai->getemployeeJoin();

// cari pengurus
if (isset($_POST['btn-cari'])) {
    // methode mencari data pengurus
    $listPegawai->searchemployee($_POST['cari']);
} else {
    // method menampilkan data pengurus
    $listPegawai->getemployeeJoin();
}

$data = null;

// ambil data pengurus
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listPegawai->getResult()) {
    $educationName = isset($row['EducationName']) ? $row['EducationName'] : '';
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 pengurus-thumbnail">
        <a href="detail.php?id=' . $row['EID'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['Foto'] . '" class="card-img-top" alt="' . $row['Foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text pengurus-nama my-0">' . $row['FirstName'] . ' ' . $row['LastName'] . '</p>
                <p class="card-text divisi-nama">' . $educationName .'</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listPegawai->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_PENGURUS', $data);
$home->write();
