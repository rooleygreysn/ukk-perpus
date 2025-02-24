<div class="bg-white p-6 rounded-lg shadow-sm">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Peminjaman Buku</h1>

    <div class="max-w-3xl">
        <form method="post">
            <?php
            if(isset($_POST['submit'])) {
                $id_buku = $_POST['id_buku'];
                $id_user = $_SESSION['user']['id_user'];
                $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
                $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
                $status_peminjaman = 'dipinjam';

                // Cek apakah user masih meminjam buku yang sama dan belum dikembalikan
                $cek_peminjaman = mysqli_query($koneksi, 
                    "SELECT * FROM peminjaman 
                    WHERE id_user = $id_user 
                    AND id_buku = $id_buku 
                    AND status_peminjaman = 'dipinjam'"
                );

                if(mysqli_num_rows($cek_peminjaman) > 0) {
                    echo "<script>
                        alert('Anda masih meminjam buku yang sama dan belum dikembalikan!');
                        location.href = '?page=peminjaman';
                    </script>";
                } else {
                    // Jika tidak ada peminjaman yang sama dan aktif, lanjutkan proses peminjaman
                    $query = mysqli_query($koneksi, "INSERT INTO peminjaman(id_buku, id_user, tanggal_peminjaman, tanggal_pengembalian, status_peminjaman) VALUES('$id_buku', '$id_user', '$tanggal_peminjaman', '$tanggal_pengembalian', '$status_peminjaman')");

                    if($query) {
                        echo "<script>
                            alert('Peminjaman berhasil ditambahkan');
                            location.href = '?page=peminjaman';
                        </script>";
                    } else {
                        echo "<script>
                            alert('Peminjaman gagal ditambahkan');
                            location.href = '?page=peminjaman';
                        </script>";
                    }
                }
            }
            ?>
            
            <div class="space-y-6">
                <!-- Buku Selection -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label class="text-sm font-medium text-gray-700">Buku</label>
                    <div class="md:col-span-3">
                        <select name="id_buku" class="w-full p-2 border-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">-- Pilih Buku --</option>
                            <?php
                            $buk = mysqli_query($koneksi, "SELECT * FROM buku");
                            while($buku = mysqli_fetch_array($buk)) {
                                echo '<option value="' . $buku['id_buku'] . '">' . htmlspecialchars($buku['judul']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Tanggal Peminjaman -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label class="text-sm font-medium text-gray-700">Tanggal Peminjaman</label>
                    <div class="md:col-span-3">
                        <input type="date" class="w-full border-2 p-2 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="tanggal_peminjaman" required>
                    </div>
                </div>

                <!-- Tanggal Pengembalian -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label class="text-sm font-medium text-gray-700">Tanggal Pengembalian</label>
                    <div class="md:col-span-3">
                        <input type="date" class="w-full rounded-lg border-2 p-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" name="tanggal_pengembalian" required>
                    </div>
                </div>

                <!-- Status Peminjaman -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <label class="text-sm font-medium text-gray-700">Status Peminjaman</label>
                    <div class="md:col-span-3">
                        <select name="status_peminjaman" class="w-full rounded-lg border-2 p-2 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="dipinjam">Dipinjam</option>
                            <option value="dikembalikan">Dikembalikan</option>
                        </select>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                    <div></div>
                    <div class="md:col-span-3 flex space-x-3">
                        <button type="submit" name="submit" value="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Simpan
                        </button>
                        <button type="reset" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            Reset
                        </button>
                        <a href="?page=peminjaman" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
