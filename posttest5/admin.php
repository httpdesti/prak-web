<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        th,
        td,
        a {
            transition: 0.3s;
            /* Animasi transisi selama 0.3 detik */
        }

        a {
            text-decoration: none;
            color: #007BFF;
            cursor: pointer;
        }

        a:hover {
            color: #0056b3;
        }

        #tambahData {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        #tambahData:hover {
            background-color: #0056b3;
        }

        #formTambahData,
        #formEditData {
            display: none;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        #formTambahData h2,
        #formEditData h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ddd;
        }

        button:active {
            transform: scale(0.98);
        }

        /* CSS khusus untuk tombol Close */
        button[onclick="tutupFormEdit()"] {
            background-color: #f44336;
            /* Merah */
            color: white;
        }

        button[onclick="tutupFormEdit()"]:hover {
            background-color: #d32f2f;
            /* Merah yang lebih gelap saat dihover */
        }
    </style>
</head>

<body>
    <h1>Data Admin</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No. Telp</th>
            <th>Ulasan</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Koneksi ke database (gantilah dengan informasi database Anda)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "testimoni";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Cek koneksi
        if ($conn->connect_error) {
            die("Koneksi database gagal: " . $conn->connect_error);
        }

        // Fungsi untuk menampilkan data admin
        $sql = "SELECT * FROM testi";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["notelp"] . "</td>";
                echo "<td>" . $row["ulasan"] . "</td>";
                echo "<td>";
                echo "<a href='javascript:void(0);' onclick='tampilkanFormEdit(" . $row["id"] . ")'>Edit</a> | ";
                echo "<a href='crud/crud.php?hapus=" . $row["id"] . "'>Delete</a>"; // Tautan hapus dengan aksi di admin_crud.php
                echo "</td>";
                echo "</tr>";
            }
        }

        // Tutup koneksi database
        $conn->close();
        ?>
    </table>

    <!-- Tombol untuk menambahkan data -->
    <button id="tambahData" onclick="tampilkanFormTambah()">Tambah Data</button>

    <!-- Form tambah data (awalnya tidak terlihat, ditampilkan saat tombol "Tambah Data" diklik) -->
    <div id="formTambahData" style="display: none;">
        <h2>Tambah Data</h2>
        <form method="post" action="crud/crud.php">
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="text" name="notelp" placeholder="No. Telp" required>
            <textarea name="ulasan" placeholder="Ulasan" required></textarea>
            <input type="submit" name="add" value="Tambah Data">
        </form>
    </div>

    <div id="formEditData" style="display: none;">
        <h2>Edit Data</h2>
        <form method="post" action="crud/edit.php">
            <input type="hidden" id="editID" name="id" value="" required>
            <input type="text" id="editNama" name="nama" placeholder="Nama" required>
            <input type="text" id="editEmail" name "email" placeholder="Email" required>
            <input type="text" id="editNotelp" name="notelp" placeholder="No. Telp" required>
            <textarea id="editUlasan" name="ulasan" placeholder="Ulasan"></textarea>
            <input type="submit" name="edit" value="Simpan Perubahan">
            <button type="button" onclick="tutupFormEdit()">Close</button>
        </form>
    </div>
    <script>
        var formTambahData = document.getElementById("formTambahData");
        var tambahDataButton = document.getElementById("tambahData");
        var formEditData = document.getElementById("formEditData");

        var isTambahFormVisible = false;
        var isEditFormVisible = false;


        tambahDataButton.addEventListener("click", function() {
            if (isTambahFormVisible) {
                formTambahData.style.display = "none"; // Sembunyikan form tambah
            } else {
                formTambahData.style.display = "block"; // Tampilkan form tambah
            }
            isTambahFormVisible = !isTambahFormVisible; // Toggle status form tambah
        });

        function tambahData() {
            var nama = document.getElementById("nama").value;
            var email = document.getElementById("email").value;
            var notelp = document.getElementById("notelp").value;
            var ulasan = document.getElementById("ulasan").value;

            // Implementasikan kode untuk mengirim data tambahan ke server (misalnya melalui AJAX)

            // Setelah data terkirim, Anda dapat menyembunyikan kembali form dengan mengatur isTambahFormVisible menjadi false
            formTambahData.style.display = "none";
            isTambahFormVisible = false;
        }

        function tampilkanFormEdit(id) {
            var formEditData = document.getElementById("formEditData");
            var editIDInput = document.getElementById("editID");
            var editNamaInput = document.getElementById("editNama");
            var editEmailInput = document.getElementById("editEmail");
            var editNotelpInput = document.getElementById("editNotelp");
            var editUlasanInput = document.getElementById("editUlasan");

            // Mengisi nilai input dengan data yang sesuai
            editIDInput.value = id;

            // Mengambil data dari server berdasarkan ID
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    if (data) {
                        editNamaInput.value = data.nama;
                        editEmailInput.value = data.email;
                        editNotelpInput.value = data.notelp;
                        editUlasanInput.value = data.ulasan;
                    }
                }
            };
            xhr.open("GET", "crud/edit.php?id=" + id, true);
            xhr.send();

            // Menampilkan formulir edit
            formEditData.style.display = "block";
        }

        function tutupFormEdit() {
            // Sembunyikan formulir edit
            formEditData.style.display = "none";
            isEditFormVisible = false;
        }
    </script>
</body>

</html>