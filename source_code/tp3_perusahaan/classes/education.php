<?php

class education extends DB
{
    function geteducation()
    {
        $query = "SELECT * FROM education";
        return $this->execute($query);
    }

    function geteducationById($id)
    {
        $query = "SELECT * FROM education WHERE EducationID=$id";
        return $this->execute($query);
    }

    function geteducationbysort(){
        $query = "SELECT * FROM education ORDER BY EducationName DESC";
        return $this->execute($query);
    }
    
    // Fungsi untuk menambahkan data
    public function addEducation($data) {
        $name = $data['nama'];
        $query = "INSERT INTO education (EducationName) VALUES ('$name')";
        return $this->executeAffected($query);
    }

    // Fungsi untuk mengedit data
    public function editEducation($id, $data) {
        $name = $data['nama'];
        $query = "UPDATE education SET EducationName = '$name' WHERE EducationID = $id";
        return $this->executeAffected($query);
    }

    // Fungsi untuk menghapus data
    public function deleteEducation($id) {
        $query = "DELETE FROM education WHERE EducationID = $id";
        return $this->executeAffected($query);
    }

}
