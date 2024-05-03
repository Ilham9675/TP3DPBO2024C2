<?php

class employee extends DB
{
    function getemployeeJoin()
    {
        $query = "SELECT *
        FROM Employee e
        LEFT JOIN education ed ON e.EducationID = ed.EducationID
        LEFT JOIN jobtitle jt ON e.JobID = jt.JobID";

        return $this->execute($query);
    }

    function getemployee()
    {
        $query = "SELECT * FROM employee";
        return $this->execute($query);
    }

    function getemployeeById($id)
    {
        $query = "SELECT *
        FROM Employee e
        LEFT JOIN education ed ON e.EducationID = ed.EducationID
        LEFT JOIN jobtitle jt ON e.JobID = jt.JobID WHERE EID =$id";
        return $this->execute($query);
    }

    function searchemployee($keyword)
    {
        $query = "SELECT *
        FROM Employee e
        LEFT JOIN education ed ON e.EducationID = ed.EducationID
        LEFT JOIN jobtitle jt ON e.JobID = jt.JobID 
        WHERE e.FirstName LIKE '%$keyword%' OR e.LastName LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function addData($data, $file)
    {
        // Ambil data dari array $data dan $file
        $nama_depan = $data['nama_depan'];
        $nama_belakang = $data['nama_belakang'];
        $gender = $data['Gender'];
        $street = $data['Street'];
        $city = $data['City'];
        $education_id = $data['EducationID'];
        $job_id = $data['JobID'];
        $foto = $file['name'];

        // Tentukan direktori tujuan
        $target_dir = "assets/images/";
        $target_file = $target_dir . basename($foto);

        // Pindahkan file yang diunggah ke direktori tujuan
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            echo "File ". htmlspecialchars(basename($foto)). " telah berhasil diunggah.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
        }

        // Query SQL untuk menyisipkan data ke dalam tabel employee
        $query = "INSERT INTO employee (LastName, FirstName, Foto, Gender, Street, City, EducationID, JobID) VALUES ('$nama_belakang', '$nama_depan', '$foto', '$gender', '$street', '$city', $education_id, $job_id)";

        // Eksekusi query dan ambil hasilnya
        $result = $this->executeAffected($query);

        return $result > 0;
    }

    public function getFotoById($id)
{
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    // Query SQL untuk mendapatkan foto berdasarkan ID pegawai
    $query = "SELECT Foto FROM employee WHERE EID = $id";

    // Eksekusi query dan ambil hasilnya
    $result = $this->execute($query);

    // Jika ada hasil, kembalikan nama file foto
    if ($result->num_rows > 0) {
        $row = $result->getResult();
        return $row['Foto'];
    }

    // Jika tidak ada hasil, kembalikan null
    return null;
}


    function updateData($id, $data, $file)
{
    // Ambil data dari array $data
    $nama_depan = $data['nama_depan'];
    $nama_belakang = $data['nama_belakang'];
    $gender = $data['Gender'];
    $street = $data['Street'];
    $city = $data['City'];
    $education_id = $data['EducationID'];
    $job_id = $data['JobID'];

    // Cek apakah file baru diunggah
    if ($file['name'] != '') {
        // Jika ya, hapus file lama
        $oldFile = $this->getFotoById($id);
        unlink("assets/images/" . $oldFile);

        // Unggah file baru
        $foto = $file['name'];
        $target_dir = "assets/images/";
        $target_file = $target_dir . basename($foto);
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            echo "File ". htmlspecialchars(basename($foto)). " telah berhasil diunggah.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
        }
        $query = "UPDATE employee SET LastName='$nama_belakang', FirstName='$nama_depan', Foto='$foto', Gender='$gender', Street='$street', City='$city', EducationID=$education_id, JobID=$job_id WHERE EID=$id";
    } else {
        // Jika tidak, pertahankan file lama
        
        $foto = $this->getFotoById($id);
        
        
        $query = "UPDATE employee SET LastName='$nama_belakang', FirstName='$nama_depan', Gender='$gender', Street='$street', City='$city', EducationID=$education_id, JobID=$job_id WHERE EID=$id";
    }

    
    // Eksekusi query dan ambil hasilnya
    $result = $this->executeAffected($query);

    return $result > 0;
}


    function deleteData($id)
    {
        $query = "DELETE FROM employee WHERE EID=$id";
        return $this->executeAffected($query);
    }
}
