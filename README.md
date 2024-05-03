# TP3DPBO2024C2
## Janji
Saya ilham akbar NIM [2201017] mengerjakan Tugas Praktikum 3 dalam mata kuliah DPBO untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Desain Program
Proyek ini adalah sistem manajemen karyawan yang menggunakan basis data relasional. Ada tiga tabel utama dalam basis data ini: education, employee, dan jobtitle.

1. Tabel education: Tabel ini digunakan untuk menyimpan tingkat pendidikan yang berbeda yang mungkin dimiliki oleh karyawan. Setiap tingkat pendidikan memiliki ID unik (EducationID) dan nama (EducationName).
2. Tabel employee: Tabel ini digunakan untuk menyimpan informasi tentang setiap karyawan. Setiap karyawan memiliki ID unik (EID), nama belakang (LastName), nama depan (FirstName), foto (Foto), jenis kelamin (Gender), alamat (Street dan City), dan ID pendidikan (EducationID) dan pekerjaan (JobID) yang merujuk ke tabel education dan jobtitle.
3. Tabel jobtitle: Tabel ini digunakan untuk menyimpan berbagai pekerjaan yang mungkin dipegang oleh karyawan. Setiap pekerjaan memiliki ID unik (JobID) dan nama (JobName).
Desain program ini memungkinkan operasi CRUD (Create, Read, Update, Delete) pada setiap tabel

Selain itu, program ini juga mendukung pencarian berdasarkan nama di tabel employee dan fungsi pengurutan di tabel education dan jobtitle. Ini berarti Anda dapat mencari karyawan berdasarkan nama mereka dan mengurutkan data berdasarkan nama pendidikan atau pekerjaan.

## penjelasan alur
1. Halaman Home: Halaman ini menampilkan semua data dari tabel employee dan data terkait dari tabel education dan jobtitle. Informasi yang ditampilkan mencakup foto, nama, dan jabatan pekerjaan karyawan.
2. Halaman Detail Karyawan: Ketika Anda mengklik salah satu karyawan di halaman Home, Anda akan dibawa ke halaman detail karyawan. Di sini, Anda dapat melihat informasi lebih lanjut tentang karyawan dan memiliki opsi untuk mengedit atau menghapus data karyawan.
Form Edit: Jika Anda memilih untuk mengedit data karyawan, Anda akan dibawa ke form edit di mana Anda dapat memperbarui informasi karyawan.
Hapus Data: Jika Anda memilih untuk menghapus data karyawan, data akan langsung dihapus dari database.
3. Navigasi Bar: Di sini, Anda memiliki opsi untuk melihat daftar education dan jobtitle. Anda juga dapat menambahkan data baru ke kedua tabel ini.
Form Tambah Data: Jika Anda memilih untuk menambahkan data, Anda akan dibawa ke form tambah data di mana Anda dapat memasukkan informasi baru.
4. Fitur Pencarian: Ada fitur pencarian yang memungkinkan Anda mencari karyawan berdasarkan nama.
5. Daftar education dan jobtitle: Di dalamnya, ada tabel yang menampilkan data dari database. Anda dapat menambahkan, mengedit, atau menghapus data. Ada juga fitur pengurutan yang memungkinkan Anda mengurutkan data berdasarkan nama dalam urutan menurun.

## documentation
![Screenshot (750)](https://github.com/Ilham9675/TP3DPBO2024C2/assets/117561201/8be8b557-c1be-40e4-b443-7e49c72c402d)
![Screenshot (753)](https://github.com/Ilham9675/TP3DPBO2024C2/assets/117561201/8c09968c-fa4a-4aee-9cc8-a7c4d5d4a06d)
![Screenshot (754)](https://github.com/Ilham9675/TP3DPBO2024C2/assets/117561201/52a66223-5c60-4250-b0ae-7b1fa21d81e1)
![Screenshot (755)](https://github.com/Ilham9675/TP3DPBO2024C2/assets/117561201/d81650f1-d98e-4828-944b-9f3e775accdf)
![Screenshot (756)](https://github.com/Ilham9675/TP3DPBO2024C2/assets/117561201/397b2a6d-13b7-4d14-bacf-4ad6f925c53f)
![Screenshot (757)](https://github.com/Ilham9675/TP3DPBO2024C2/assets/117561201/f0688d19-d6d7-4dc0-95b3-0f937b0c3852)
![Screenshot (746)](https://github.com/Ilham9675/TP3DPBO2024C2/assets/117561201/8e712a49-06f1-4995-97bd-f8cb2f64de81)
![Screenshot (747)](https://github.com/Ilham9675/TP3DPBO2024C2/assets/117561201/2898f5f3-e1c7-4a88-8209-715a8530d8ca)
![Screenshot (748)](https://github.com/Ilham9675/TP3DPBO2024C2/assets/117561201/27c4b740-d161-4fff-9d8c-0b6f1758eeff)
![Screenshot (749)](https://github.com/Ilham9675/TP3DPBO2024C2/assets/117561201/feb77c8a-a451-4216-8e58-56b8abd002d1)