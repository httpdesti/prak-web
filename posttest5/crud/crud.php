<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testimoni";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Fungsi untuk menambahkan data admin
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $notelp = $_POST['notelp'];
    $ulasan = $_POST['ulasan'];

    $sql = "INSERT INTO testi (nama, email, notelp, ulasan) VALUES ('$nama', '$email', '$notelp', '$ulasan')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin.php"); // Redirect kembali ke halaman ../admin setelah data ditambahkan
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



// Fungsi untuk menghapus data testi
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $sql = "DELETE FROM testi WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin.php"); // Redirect kembali ke halaman ../admin setelah data dihapus
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi database
$conn->close();
