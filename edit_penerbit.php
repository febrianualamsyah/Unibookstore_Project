<?php
include('koneksi.php');

if (isset($_POST['id_penerbit'])) {
    $id_penerbit = $_POST['id_penerbit'];
    $publisher = $conn->query("SELECT * FROM penerbit WHERE id_penerbit = '$id_penerbit'")->fetch_assoc();
}

if (isset($_POST['update_publisher'])) {
    $id_penerbit = $_POST['id_penerbit'];
    $nama_penerbit = $_POST['nama_penerbit'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $telepon = $_POST['telepon'];
    $sql = "UPDATE penerbit SET nama_penerbit='$nama_penerbit', alamat='$alamat', kota='$kota', telepon='$telepon' WHERE id_penerbit='$id_penerbit'";
    $conn->query($sql);
    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Publisher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1>Edit Publisher</h1>
    <form action="" method="POST" class="m-4">
      <div class="mb-3">
        <input type="hidden" name="id_penerbit" value="<?php echo htmlspecialchars($publisher['id_penerbit']); ?>">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="text" class="form-control" name="nama_penerbit" placeholder="Nama Penerbit" value="<?php echo htmlspecialchars($publisher['nama_penerbit']); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?php echo htmlspecialchars($publisher['alamat']); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Kota</label>
        <input type="text" class="form-control" name="kota" placeholder="Kota" value="<?php echo htmlspecialchars($publisher['kota']); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Kota</label>
        <input type="text" class="form-control" name="telepon" placeholder="Telepon" value="<?php echo htmlspecialchars($publisher['telepon']); ?>" required>
      </div>
      <button type="submit" name="update_publisher" class="btn btn-primary" >Update Publisher</button>
    </form>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>
