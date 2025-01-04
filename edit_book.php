<?php
include('koneksi.php');

if (isset($_POST['id_buku'])) {
    $id_buku = $_POST['id_buku'];
    $book = $conn->query("SELECT * FROM buku WHERE id_buku = '$id_buku'")->fetch_assoc();
    $publishers = $conn->query("SELECT * FROM penerbit");
}

if (isset($_POST['update_book'])) {
    $id_buku = $_POST['id_buku'];
    $nama_buku = $_POST['nama_buku'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $penerbit = $_POST['penerbit'];
    $sql = "UPDATE buku SET nama_buku='$nama_buku', kategori='$kategori', harga='$harga', stok='$stok', id_penerbit='$penerbit' WHERE id_buku='$id_buku'";
    $conn->query($sql);
    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
    <h1>Edit Book</h1>
    <form method="POST" action="">
        <div>
            <input type="hidden" class="form-control" name="id_buku" value="<?php echo htmlspecialchars($book['id_buku']); ?>"><br>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Buku</label>
            <input type="text" class="form-control" name="nama_buku" placeholder="Nama Buku" value="<?php echo htmlspecialchars($book['nama_buku']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" class="form-control" name="kategori" placeholder="Kategori" value="<?php echo htmlspecialchars($book['kategori']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="text" class="form-control" name="harga" placeholder="Harga" value="<?php echo htmlspecialchars($book['harga']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="text" class="form-control" name="stok" placeholder="Stok" value="<?php echo htmlspecialchars($book['stok']); ?>" required>
        </div>
        <div>
            <label class="form-label">Penerbit</label>
            <select name="penerbit" class="form-select" required>
                <option value="">Select Publisher</option>
                <?php while($publisher = $publishers->fetch_assoc()): ?>
                    <option value="<?php echo $publisher['id_penerbit']; ?>" <?php if ($publisher['id_penerbit'] == $book['id_penerbit']) echo 'selected'; ?>><?php echo htmlspecialchars($publisher['nama_penerbit']); ?></option>
                <?php endwhile; ?>
            </select><br>
        </div>
        <button type="submit" class="btn btn-primary" name="update_book">Update Book</button>
    </form> 
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>
