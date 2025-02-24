<div class="bg-white rounded-lg shadow-sm p-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Buku</h1>

    <?php
        $id = $_GET['id'];
        if(isset($_POST['submit'])) {
            $id_kategori = $_POST['id_kategori'];
            $judul = $_POST['judul'];
            $penulis = $_POST['penulis'];
            $penerbit= $_POST['penerbit'];
            $tahun_terbit = $_POST['tahun_terbit'];
            $deskripsi = $_POST['deskripsi'];
            $query = mysqli_query($koneksi, "UPDATE buku SET id_kategori='$id_kategori', judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun_terbit', deskripsi='$deskripsi' WHERE id_buku=$id");

            if($query) {
                echo '<script>alert("Ubah data berhasil.");</script>';
            }else{
                echo '<script>alert("Ubah data gagal.");</script>';
            }
        }
        $query = mysqli_query($koneksi, "SELECT*FROM buku WHERE id_buku=$id");
        $data = mysqli_fetch_array($query);
    ?>

    <form method="post" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">Kategori</label>
            <div class="md:col-span-2">
                <select name="id_kategori" class="w-full rounded-lg border-2 p-2 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <?php
                    $kat = mysqli_query($koneksi, "SELECT*FROM kategori");
                    while($kategori = mysqli_fetch_array($kat)) {
                    ?>
                        <option <?php if($kategori['id_kategori'] == $data['id_kategori']) echo 'selected'; ?> 
                                value="<?php echo $kategori['id_kategori']; ?>">
                            <?php echo $kategori['kategori']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">Judul</label>
            <div class="md:col-span-2">
                <input type="text" value="<?php echo $data['judul']; ?>" 
                       class="w-full rounded-lg border-gray-300 border-2 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" 
                       name="judul">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">Penulis</label>
            <div class="md:col-span-2">
                <input type="text" value="<?php echo $data['penulis']; ?>" 
                       class="w-full rounded-lg border-gray-300 border-2 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" 
                       name="penulis">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">Penerbit</label>
            <div class="md:col-span-2">
                <input type="text" value="<?php echo $data['penerbit']; ?>" 
                       class="w-full rounded-lg border-gray-300 border-2 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" 
                       name="penerbit">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
            <label class="text-sm font-medium text-gray-700">Tahun Terbit</label>
            <div class="md:col-span-2">
                <input type="number" value="<?php echo $data['tahun_terbit']; ?>" 
                       class="w-full rounded-lg border-gray-300 border-2 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200" 
                       name="tahun_terbit">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
            <label class="text-sm font-medium text-gray-700">Deskripsi</label>
            <div class="md:col-span-2">
                <textarea name="deskripsi" rows="5" 
                          class="w-full rounded-lg border-gray-300 border-2 p-2 focus:border-blue-500 focus:ring focus:ring-blue-200"><?php echo $data['deskripsi']; ?></textarea>
            </div>
        </div>

        <div class="flex justify-end space-x-4 mt-6">
            <button type="submit" name="submit" value="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Simpan
            </button>
            <button type="reset"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Reset
            </button>
            <a href="?page=buku"
               class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                Kembali
            </a>
        </div>
    </form>
</div>
