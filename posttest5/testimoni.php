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

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Cek koneksi
        if ($conn->connect_error) {
            die("Koneksi database gagal: " . $conn->connect_error);
        }

        // Siapkan pernyataan SQL untuk menyisipkan data ke dalam tabel
        $sql = "INSERT INTO testi (nama, email, ulasan, notelp) VALUES ('$nama', '$email', '$ulasan', '$notelp')";

        if ($conn->query($sql) === TRUE) {
            $pesan = '<p style="color: green;">Terima kasih atas ulasan Anda! Ulasan Anda sudah tersimpan.</p>';
        } else {
            $pesan = '<p style="color: red;">Terjadi kesalahan: ' . $conn->error . '</p>';
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

<form method="post" action="">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" placeholder="Nama" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" placeholder="Email" required><br>

    <label for="ulasan">Ulasan:</label>
    <textarea name="ulasan" placeholder="Ulasan" required></textarea><br>

    <label for="notelp">No Telepon:</label>
    <input type="text" name="notelp" placeholder="No. Telp" required>
    <input type="submit" value="Kirim Ulasan">
</form>

</body>
</html>
