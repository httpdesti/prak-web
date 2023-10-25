<?php
$pesan = ''; // Pesan awal kosong


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $ulasan = $_POST["ulasan"];
    $notelp = $_POST["notelp"]; // Menambah notelp

    // Validasi sederhana
    if (empty($nama) || empty($email) || empty($ulasan) || empty($notelp)) {
        $pesan = '<p style="color: red;">Silakan lengkapi semua field.</p>';
    } else {
        // Koneksi ke database (sesuaikan dengan informasi Anda)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "testimoni";
        
        $img = $_FILES ['gambar']['name'];
        $explode = explode('.', $img );
        $ekstensi = strtolower(end($explode));
        $gambar_baru = "$nama.$ekstensi";
        $tmp = $_FILES['gambar']['tmp_name'];
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Cek koneksi
        if ($conn->connect_error) {
            die("Koneksi database gagal: " . $conn->connect_error);
        }

        // Siapkan pernyataan SQL untuk menyisipkan data ke dalam tabel
        if (move_uploaded_file($tmp,'./img'.$gambar_baru)){
            $sql = "INSERT INTO testimoni (nama, email, ulasan, notelp, gambar) VALUES ('$nama', '$email', '$ulasan', '$notelp', '$gambar_baru')";
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                $pesan = '<p style="color: green;">Terima kasih atas ulasan Anda! Ulasan Anda sudah tersimpan.</p>';
            } else {
                $pesan = '<p style="color: red;">Terjadi kesalahan: ' . $conn->error . '</p>';
            }

        }

        // Tutup koneksi database
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Review</title>
    <link rel="stylesheet" type="text/css" href="testimoni.css"> 
</head>
<body>

<h1>Input Review Produk</h1>

<?php
echo $pesan; // Menampilkan pesan
?>

<section>
    <p>Hari ini : <?php date_default_timezone_set ('Asia/Makassar'); echo date('d M Y |h:i:sa')?></p><br>
</section>
<form method="post" action="" enctype="multipart/form-data">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" placeholder="Nama" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" placeholder="Email" required><br>

    <label for="ulasan">Ulasan:</label>
    <textarea name="ulasan" placeholder="Ulasan" required></textarea><br>

    <label for="notelp">No Telepon:</label>
    <input type="text" name="notelp" placeholder="No. Telp" required>

    <label for="">Upload Gambar</label>
    <input type="file" name="gambar" id=""><br>
    <input type="submit" value="Kirim Ulasan">
</form>

</body>
</html>
