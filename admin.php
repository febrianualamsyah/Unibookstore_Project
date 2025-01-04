<?php
include('koneksi.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add_book') {
        $id_buku = $conn->real_escape_string($_POST['id_buku']);
        $nama_buku = $conn->real_escape_string($_POST['nama_buku']);
        $kategori = $conn->real_escape_string($_POST['kategori']);
        $harga = $conn->real_escape_string($_POST['harga']);
        $stok = $conn->real_escape_string($_POST['stok']);
        $id_penerbit = $conn->real_escape_string($_POST['id_penerbit']);
        $sql = "INSERT INTO buku (id_buku, nama_buku, kategori, harga, stok, id_penerbit) VALUES ('$id_buku', '$nama_buku', '$kategori', '$harga', '$stok', '$id_penerbit')";
        $conn->query($sql);
    } elseif ($action == 'edit_book') {
        $id_buku = $conn->real_escape_string($_POST['id_buku']);
        $nama_buku = $conn->real_escape_string($_POST['nama_buku']);
        $kategori = $conn->real_escape_string($_POST['kategori']);
        $harga = $conn->real_escape_string($_POST['harga']);
        $stok = $conn->real_escape_string($_POST['stok']);
        $id_penerbit = $conn->real_escape_string($_POST['id_penerbit']);
        $sql = "UPDATE buku SET nama_buku='$nama_buku', kategori='$kategori', harga='$harga', stok='$stok', id_penerbit='$id_penerbit' WHERE id_buku='$id_buku'";
        $conn->query($sql);
    } elseif ($action == 'delete_book') {
        $id_buku = $conn->real_escape_string($_POST['id_buku']);
        $sql = "DELETE FROM buku WHERE id_buku='$id_buku'";
        $conn->query($sql);
    } elseif ($action == 'add_publisher') {
        $id_penerbit = $conn->real_escape_string($_POST['id_penerbit']);
        $nama_penerbit = $conn->real_escape_string($_POST['nama_penerbit']);
        $alamat = $conn->real_escape_string($_POST['alamat']);
        $kota = $conn->real_escape_string($_POST['kota']);
        $telepon = $conn->real_escape_string($_POST['telepon']);
        $sql = "INSERT INTO penerbit (id_penerbit, nama_penerbit, alamat, kota, telepon) VALUES ('$id_penerbit', '$nama_penerbit', '$alamat', '$kota', '$telepon')";
        $conn->query($sql);
    } elseif ($action == 'edit_publisher') {
        $id_penerbit = $conn->real_escape_string($_POST['id_penerbit']);
        $nama_penerbit = $conn->real_escape_string($_POST['nama_penerbit']);
        $alamat = $conn->real_escape_string($_POST['alamat']);
        $kota = $conn->real_escape_string($_POST['kota']);
        $telepon = $conn->real_escape_string($_POST['telepon']);
        $sql = "UPDATE penerbit SET nama_penerbit='$nama_penerbit', alamat='$alamat', kota='$kota', telepon='$telepon' WHERE id_penerbit='$id_penerbit'";
        $conn->query($sql);
    } elseif ($action == 'delete_publisher') {
        $id_penerbit = $conn->real_escape_string($_POST['id_penerbit']);
        $sql = "DELETE FROM penerbit WHERE id_penerbit='$id_penerbit'";
        $conn->query($sql);
    }
}

$books = $conn->query("SELECT buku.*, penerbit.nama_penerbit FROM buku INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit");
$publishers = $conn->query("SELECT * FROM penerbit");
$publishers2 = $conn->query("SELECT * FROM penerbit");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary d-flex align-items-center">
        <a href="index.php" style="text-decoration: none;"><h1 class="navbar-brand p-2 text-light">Halaman Admin</h1></a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="nav navbar-nav p-2">
                <a class="nav-item nav-link text-light" href="admin.php">Admin</a>
                <a class="nav-item nav-link text-light" href="pengadaan.php">Pengadaan</a>
            </ul>
        </div>
    </nav>

    <h2 style="margin-left: 8px; margin-top: 20px;">Manage Books</h2>

    <div class="container-md mx-auto " style="padding: 20px;">
        <form method="POST" class="d-flex justify-content-between flex-wrap" action="">
        <input type="hidden" name="action" value="add_book">
        <input type="text" name="id_buku" placeholder="ID Buku" required>
        <input type="text" name="nama_buku" placeholder="Nama Buku" required>
        <input type="text" name="kategori" placeholder="Kategori" required>
        <input type="text" name="harga" placeholder="Harga" required>
        <input type="text" name="stok" placeholder="Stok" required>
        <select name="id_penerbit" class=" form-select p-2 my-3" required>
            <option value="">Pilih penerbit</option>
            <?php while($publisher = $publishers->fetch_assoc()): ?>
                <option value="<?php echo htmlspecialchars($publisher['id_penerbit']); ?>"><?php echo htmlspecialchars($publisher['nama_penerbit']); ?></option>
            <?php endwhile; ?>
        </select>
        <button type="submit" class="btn btn-primary">Add Book</button>
    </form>
    </div>

    <div class="container">
        <table class="table table-bordered m-2">
        <thead>
            <tr>
                <th  class="bg-primary text-light text-center">ID Buku</th>
                <th  class="bg-primary text-light text-center">Kategori</th>
                <th  class="bg-primary text-light text-center">Nama Buku</th>
                <th  class="bg-primary text-light text-center">Harga</th>
                <th  class="bg-primary text-light text-center">Stok</th>
                <th  class="bg-primary text-light text-center">Penerbit</th>
                <th  class="bg-primary text-light text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($book = $books->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($book['id_buku']); ?></td>
                    <td><?php echo htmlspecialchars($book['kategori']); ?></td>
                    <td><?php echo htmlspecialchars($book['nama_buku']); ?></td>
                    <td><?php echo htmlspecialchars($book['harga']); ?></td>
                    <td><?php echo htmlspecialchars($book['stok']); ?></td>
                    <td><?php echo htmlspecialchars($book['nama_penerbit']); ?></td>
                    <td>
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="action" value="delete_book">
                            <input type="hidden" name="id_buku" value="<?php echo htmlspecialchars($book['id_buku']); ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <form method="POST" action="edit_book.php" style="display:inline;">
                            <input type="hidden" name="id_buku" value="<?php echo htmlspecialchars($book['id_buku']); ?>">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>


    <h2 style="margin-left: 8px;">Manage Publishers</h2>
    <div class="container-md mx-auto ">
        <form class="m-2" method="POST" action="">
            <input type="hidden" name="action" value="add_publisher">
            <input type="text" name="id_penerbit" placeholder="ID Penerbit" required>
            <input type="text" name="nama_penerbit" placeholder="Nama Penerbit" required>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <input type="text" name="kota" placeholder="Kota" required>
            <input type="text" name="telepon" placeholder="Telepon" required>
            <button class="btn btn-primary mt-2" type="submit">Add Penerbit</button>
        </form>
    </div>

    <div class="container">
        <table class="table table-bordered m-2">
        <thead>
            <tr>
                <th class="bg-primary text-light text-center">ID</th>
                <th class="bg-primary text-light text-center">Nama Penerbit</th>
                <th class="bg-primary text-light text-center">Alamat</th>
                <th class="bg-primary text-light text-center">Kota</th>
                <th class="bg-primary text-light text-center">Telepon</th>
                <th class="bg-primary text-light text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($publisher = $publishers2->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($publisher['id_penerbit']); ?></td>
                    <td><?php echo htmlspecialchars($publisher['nama_penerbit']); ?></td>
                    <td><?php echo htmlspecialchars($publisher['alamat']); ?></td>
                    <td><?php echo htmlspecialchars($publisher['kota']); ?></td>
                    <td><?php echo htmlspecialchars($publisher['telepon']); ?></td>
                    <td>
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="action" value="delete_publisher">
                            <input type="hidden" name="id_penerbit" value="<?php echo htmlspecialchars($publisher['id_penerbit']); ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <form method="POST" action="edit_penerbit.php" style="display:inline;">
                            <input type="hidden" name="id_penerbit" value="<?php echo htmlspecialchars($publisher['id_penerbit']); ?>">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

<?php
$conn->close();
?>
