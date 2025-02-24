<?php
if (!isset($_SESSION['user']['id_user'])) {
    echo '<script>alert("Anda belum login!"); window.location.href="login.php";</script>';
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id == 0) {
    echo '<script>alert("ID tidak valid."); window.location.href="?page=peminjaman";</script>';
    exit;
}

if (isset($_POST['submit'])) {
    $id_buku = $_POST['id_buku'];
    $id_user = $_SESSION['user']['id_user'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
    $status_peminjaman = $_POST['status_peminjaman'];

    $stmt = mysqli_prepare($koneksi, "UPDATE peminjaman SET id_buku=?, tanggal_peminjaman=?, tanggal_pengembalian=?, status_peminjaman=? WHERE id_peminjaman=?");
    mysqli_stmt_bind_param($stmt, "isssi", $id_buku, $tanggal_peminjaman, $tanggal_pengembalian, $status_peminjaman, $id);
    $query = mysqli_stmt_execute($stmt);

    if ($query) {
        echo '<script>alert("Ubah data berhasil."); window.location.href="?page=peminjaman";</script>';
    } else {
        echo '<script>alert("Ubah data gagal.");</script>';
    }
}

$query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_peminjaman=$id");
$data = mysqli_fetch_array($query);
?>

<div class="bg-white p-6 rounded-lg shadow-sm">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Ubah Peminjaman Buku</h1>
    
    <form method="post" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">Buku</label>
            <div class="md:col-span-2">
                <select name="id_buku" class="w-full border-2 p-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    <option value="">-- Pilih Buku --</option>
                    <?php
                    $buk = mysqli_query($koneksi, "SELECT * FROM buku");
                    while ($buku = mysqli_fetch_array($buk)) {
                        $selected = ($buku['id_buku'] == $data['id_buku']) ? 'selected' : '';
                        echo '<option value="' . $buku['id_buku'] . '" ' . $selected . '>' . htmlspecialchars($buku['judul']) . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">Tanggal Peminjaman</label>
            <div class="md:col-span-2">
                <input type="date" class="w-full border-2 p-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                    value="<?php echo $data['tanggal_peminjaman']; ?>" name="tanggal_peminjaman">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">Tanggal Pengembalian</label>
            <div class="md:col-span-2">
                <input type="date" class="w-full border-2 p-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                    value="<?php echo $data['tanggal_pengembalian']; ?>" name="tanggal_pengembalian">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">Status Peminjaman</label>
            <div class="md:col-span-2">
                <select name="status_peminjaman" class="w-full rounded-lg border-2 p-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="dipinjam" <?php if($data['status_peminjaman'] == 'dipinjam') echo 'selected'; ?>>Dipinjam</option>
                    <option value="dikembalikan" <?php if($data['status_peminjaman'] == 'dikembalikan') echo 'selected'; ?>>Dikembalikan</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-6">
            <button type="submit" name="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                Simpan
            </button>
            <button type="reset" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-200">
                Reset
            </button>
            <a href="?page=peminjaman" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200">
                Kembali
            </a>
        </div>
    </form>
</div>
