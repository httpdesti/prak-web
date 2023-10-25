<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testimoni";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}


if (isset($_POST["add"])) {
// Fungsi untuk menambahkan data admin
    $date = date("Y-m-d");
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $notelp = $_POST['notelp'];
    $ulasan = $_POST['ulasan'];

    $img = $_FILES ['gambar']['name'];
    $explode = explode('.', $img );
    $ekstensi = strtolower(end($explode));
    $gambar_baru = "$date.$nama.$ekstensi";
    $tmp = $_FILES['gambar']['tmp_name'];


    if (move_uploaded_file($tmp,'../assets/'.$gambar_baru)){
        $result = mysqli_query($conn, "INSERT INTO testimoni VALUES ('', '$nama', '$email', '$notelp', '$ulasan', '$gambar_baru')");
    
        
        if ($result) {
            echo "
            <script>
                alert('Data Berhasil DiTambahkan!');
                document.location.href = 'dashboard.php'
            </script>";
        }else {
            echo "
            <script>
                alert('Data Gagal DiTambahkan!');
                document.location.href = 'tambah.php'
            </script>";
        }
        
    }else {
        echo"gagal meng-upload gambar";
    
    }
}



// Fungsi untuk menghapus data testi

    $id = $_GET['id'];

    $sql = "DELETE FROM testimoni WHERE id='$id'";
    $result = mysqli_query($conn , $sql);

    if ($result) {
        echo"
        <script>
            alert('p'); 

        </script>
        ";
        header("Location: ../admin.php"); // Redirect kembali ke halaman ../admin setelah data dihapus
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


// Tutup koneksi database
$conn->close();
