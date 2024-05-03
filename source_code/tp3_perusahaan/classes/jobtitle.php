<?php

class jobtitle extends DB
{
    function getjobtitle()
    {
        $query = "SELECT * FROM jobtitle";
        return $this->execute($query);
    }

    function getjobtitleById($id)
    {
        $query = "SELECT * FROM jobtitle WHERE JobID=$id";
        return $this->execute($query);
    }

    function getjobtitlebysort(){
        $query = "SELECT * FROM jobtitle ORDER BY JobName DESC";
        return $this->execute($query);
    }
    
    // Fungsi untuk menambahkan data
    public function addjobtitle($data) {
        $name = $data['nama'];
        $query = "INSERT INTO jobtitle (JobName) VALUES ('$name')";
        return $this->executeAffected($query);
    }

    // Fungsi untuk mengedit data
    public function editjobtitle($id, $data) {
        $name = $data['nama'];
        $query = "UPDATE jobtitle SET JobName = '$name' WHERE	JobID = $id";
        return $this->executeAffected($query);
    }

    // Fungsi untuk menghapus data
    public function deletejobtitle($id) {
        $query = "DELETE FROM jobtitle WHERE JobID = $id";
        return $this->executeAffected($query);
    }
}
