<?php

include('config/db.php');
include('classes/DB.php');
include('classes/education.php');
include('classes/employee.php');
include('classes/jobtitle.php');
include('classes/Template.php');

$education = new education($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$education->open();
if(isset($_POST['btn-cari'])){
    $education->geteducationbysort();
}else{
    $education->geteducation();
}
// $btn = '';

// if (!isset($_GET['id'])) {
//     if (isset($_POST['submit'])) {
//         if ($education->addeducation($_POST) > 0) {
//             echo "<script>
//                 alert('Data berhasil ditambah!');
//                 document.location.href = 'education.php';
//             </script>";
//         } else {
//             echo "<script>
//                 alert('Data gagal ditambah!');
//                 document.location.href = 'education.php';
//             </script>";
//         }
//     }

//     $btn = 'Tambah';
//     $title = 'Tambah';
// }

if(isset($_GET['action'])){
    if ($_GET['action'] == 'add') {
        $data = array(
            'nama' => $_POST['nama'],
        );
        $education->addEducation($data);
    }else{
        $id = $_GET['id'];
        $data = array(
            'nama' => $_POST['nama'],
        );
        $education->editEducation($id,$data);
    }
    header("Location: education.php");
    exit;
}

$mainTitle = 'education';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama education</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'education';

while ($div = $education->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['EducationName'] . '</td>
    <td style="font-size: 22px;">
        <a href="education.php?id=' . $div['EducationID'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="education.php?hapus=' . $div['EducationID'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

$close_modal = 'education.php';

$modal = null;


                            

$action = isset($_GET['id']) ? 'update&id=' . $_GET['id'] : 'add';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        

        $education->geteducationById($id);
        $row = $education->getResult();

        $dataUpdate = $row['EducationName'];
        $modal .= '
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">update data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Mulai form di sini -->
                    <form action="education.php?action=' . $action . '" class="namaForm" id="namaForm" method="post">
                        <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="'. $dataUpdate .'">
                    </div>
                    </form>
                    <!-- Akhir form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                    <button type="button" class="btn btn-primary" onclick="updateForm()">Update</button>
                </div>
            </div>
        </div>
    </div>';

    }
}else{
    $modal .= '
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">add data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Mulai form di sini -->
                    <form action="education.php?action=' . $action . '" class="namaForm" id="namaForm" method="post">
                        <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    </form>
                    <!-- Akhir form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitForm()">Tambahkan</button>
                </div>
            </div>
        </div>
    </div>';
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($education->deleteEducation($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'education.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'education.php';
            </script>";
        }
        header("Location: education.php");
        exit;
    }
}



$education->close();
$view = new Template('templates/skintabel.html');
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);

// $view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_MODAL', $modal);
$view->replace('DATA_TUJUAN', $close_modal);
$view->write();
