<?php

include('config/db.php');
include('classes/DB.php');
include('classes/education.php');
include('classes/employee.php');
include('classes/jobtitle.php');
include('classes/Template.php');

$jobtitle = new jobtitle($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$jobtitle->open();
if(isset($_POST['btn-cari'])){
    $jobtitle->getjobtitlebysort();
}else{
    $jobtitle->getjobtitle();
}
if(isset($_GET['action'])){
    if ($_GET['action'] == 'add') {
        $data = array(
            'nama' => $_POST['nama'],
        );
        $jobtitle->addjobtitle($data);
    }else{
        $id = $_GET['id'];
        $data = array(
            'nama' => $_POST['nama'],
        );
        $jobtitle->editjobtitle($id,$data);
    }
    header("Location: jobtitle.php");
    exit;
}

$mainTitle = 'jobtitle';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama jobtitle</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'jobtitle';

while ($div = $jobtitle->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['JobName'] . '</td>
    <td style="font-size: 22px;">
        <a href="jobtitle.php?id=' . $div['JobID'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="jobtitle.php?hapus=' . $div['JobID'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

$close_modal = 'jobtitle.php';

$modal = null;


                            

$action = isset($_GET['id']) ? 'update&id=' . $_GET['id'] : 'add';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        

        $jobtitle->getjobtitleById($id);
        $row = $jobtitle->getResult();

        $dataUpdate = $row['JobName'];
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
                    <form action="jobtitle.php?action=' . $action . '" class="namaForm" id="namaForm" method="post">
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
                    <form action="jobtitle.php?action=' . $action . '" class="namaForm" id="namaForm" method="post">
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
        if ($jobtitle->deletejobtitle($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'jobtitle.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'jobtitle.php';
            </script>";
        }
        header("Location: jobtitle.php");
        exit;
    }
}



$jobtitle->close();
$view = new Template('templates/jobtitle.html');
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);


$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_MODAL', $modal);
$view->replace('DATA_TUJUAN', $close_modal);
$view->write();
