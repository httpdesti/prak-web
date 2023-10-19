<?php
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $ulasan = isset($_POST['ulasan']) ? $_POST['ulasan'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tampil</title>
</head>
<body>
    <?=
     $nama;
     $email;
     $ulasan;
    ?>
    <?=
     $email;
    ?>
    <?=
     $email;
    ?>
</body>
</html>