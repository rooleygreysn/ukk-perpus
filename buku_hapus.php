<?php
$id = $_GET['id'];

// Ambil nama file gambar sebelum menghapus data
$query_gambar = mysqli_query($koneksi, "SELECT gambar FROM buku WHERE id_buku=$id");
$data_gambar = mysqli_fetch_array($query_gambar);

// Hapus data dari database
$query = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku=$id");

if($query) {
    // Hapus file gambar jika ada
    if($data_gambar['gambar'] && file_exists('assets/uploads/' . $data_gambar['gambar'])) {
        unlink('assets/uploads/' . $data_gambar['gambar']);
    }
    
    echo '<script>
        alert("Hapus data berhasil");
        location.href = "index.php?page=buku";
    </script>';
} else {
    echo '<script>
        alert("Hapus data gagal");
        location.href = "index.php?page=buku";
    </script>';
}
?>