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

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $notelp = $_POST['notelp'];
    $ulasan = $_POST['ulasan'];

    $img = $_FILES ['gambar']['name'];
    $explode = explode('.', $img );
    $ekstensi = strtolower(end($explode));
    $gambar_baru = "$nama.$ekstensi";
    $tmp = $_FILES['gambar']['tmp_name'];
    $sql = "UPDATE testi SET nama='$nama', email='$email', notelp='$notelp', ulasan='$ulasan', gambar='$gambar_baru' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../admin.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi database
$conn->close();
?>
