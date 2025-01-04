<?php
include('koneksi.php');

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$sql = "SELECT buku.*, penerbit.nama_penerbit FROM buku INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit";
if ($search) {
    $sql .= " WHERE nama_buku LIKE '%" . $conn->real_escape_string($search) . "%'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIBOOKSTORE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary d-flex align-items-center">
        <h1 class="navbar-brand p-2 text-light">UNIBOOKSTORE</h1>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="nav navbar-nav p-2">
                <a class="nav-item nav-link text-light" href="admin.php">Admin</a>
                <a class="nav-item nav-link text-light" href="pengadaan.php">Pengadaan</a>
            </ul>
        </div>
    </nav>

    <form method="GET" action="">
        <div class="input-group mb-3 mt-3 w-50 m-auto">
            <input type="text" class="form-control" placeholder="Search Book" aria-label="Recipent's username" aria-describedby="basic-addon2" name="search" value="<?php echo htmlspecialchars($search); ?>">
            <button class="input-group-text btn btn-primary" id="basic-addon2" type="submit">Search</button>
        </div>
    
    </form>

    <div class="container ">
        <table class="table table-bordered border-primary m-2">
        <thead class="table table-bordered border-primary m-2">
            <tr>
                <th class="bg-primary text-light text-center">ID</th>
                <th class="bg-primary text-light text-center">Kategori</th>
                <th class="bg-primary text-light text-center">Nama Buku</th>
                <th class="bg-primary text-light text-center">Harga</th>
                <th class="bg-primary text-light text-center">Stok</th>
                <th class="bg-primary text-light text-center">Penerbit</th>
            </tr>
        </thead>
        <tbody class="table table-bordered border-primary m-2">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id_buku'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['kategori']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama_buku']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['harga']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['stok']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama_penerbit']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No books found</td></tr>";
            }
            ?>
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
