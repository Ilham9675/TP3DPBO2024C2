<?php
include('config/db.php');
include('classes/DB.php');
include('classes/education.php');
include('classes/employee.php');
include('classes/jobtitle.php');
include('classes/Template.php');

$pegawai = new employee($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$pegawai->open();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $pegawai->deleteData($id);
    }
}


$pegawai->close();
header("Location: index.php");
exit;
?>