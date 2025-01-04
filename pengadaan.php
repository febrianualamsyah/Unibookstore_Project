<?php
include('koneksi.php');

$query = "SELECT buku.nama_buku, penerbit.nama_penerbit, buku.stok
          FROM buku
          INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
          WHERE buku.stok = (SELECT MIN(stok) FROM buku)";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kebutuhan Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container my-4">
        <h1 class="my-4">Laporan Kebutuhan Buku yang Perlu Dibeli</h1>
        <table class="table table-striped-columns">
            <thead>
                <tr>
                    <th class="bg-primary text-light">Judul Buku</th>
                    <th class="bg-primary text-light">Nama Penerbit</th>
                    <th class="bg-primary text-light">Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nama_buku']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama_penerbit']); ?></td>
                        <td><?php echo htmlspecialchars($row['stok']); ?></td>
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
