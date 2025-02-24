<?php
// Memastikan ada koneksi ke database
include 'koneksi.php';

// Query untuk menghitung total user berdasarkan level
$query_admin = mysqli_query($koneksi, "SELECT COUNT(*) as total_admin FROM user WHERE level='admin'");
$query_petugas = mysqli_query($koneksi, "SELECT COUNT(*) as total_petugas FROM user WHERE level='petugas'");
$query_peminjam = mysqli_query($koneksi, "SELECT COUNT(*) as total_peminjam FROM user WHERE level='peminjam'");

// Mengambil hasil query
$admin = mysqli_fetch_assoc($query_admin);
$petugas = mysqli_fetch_assoc($query_petugas);
$peminjam = mysqli_fetch_assoc($query_peminjam);

// Total semua user
$total_user = $admin['total_admin'] + $petugas['total_petugas'] + $peminjam['total_peminjam'];

// Query untuk mengambil semua data user
$query_users = mysqli_query($koneksi, "SELECT * FROM user ORDER BY level");
?>

<!-- Cards Section -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
        <div class="flex items-center">
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-700">Total Admin</h3>
                <p class="text-2xl font-bold text-blue-600"><?php echo $admin['total_admin']; ?></p>
            </div>
            <div class="text-blue-500">
                <i class="fas fa-user-shield text-3xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
        <div class="flex items-center">
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-700">Total Petugas</h3>
                <p class="text-2xl font-bold text-green-600"><?php echo $petugas['total_petugas']; ?></p>
            </div>
            <div class="text-green-500">
                <i class="fas fa-user-tie text-3xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
        <div class="flex items-center">
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-700">Total Peminjam</h3>
                <p class="text-2xl font-bold text-purple-600"><?php echo $peminjam['total_peminjam']; ?></p>
            </div>
            <div class="text-purple-500">
                <i class="fas fa-users text-3xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
        <div class="flex items-center">
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-700">Total User</h3>
                <p class="text-2xl font-bold text-yellow-600"><?php echo $total_user; ?></p>
            </div>
            <div class="text-yellow-500">
                <i class="fas fa-user-friends text-3xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Table Section -->
<div class="bg-white rounded-lg shadow">
    <div class="p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Daftar User</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php 
                    $no = 1;
                    while($user = mysqli_fetch_assoc($query_users)) { 
                    ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $no++; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($user['username']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($user['email']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($user['nama']); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                <?php 
                                switch($user['level']) {
                                    case 'admin':
                                        echo 'bg-blue-100 text-blue-800';
                                        break;
                                    case 'petugas':
                                        echo 'bg-green-100 text-green-800';
                                        break;
                                    default:
                                        echo 'bg-purple-100 text-purple-800';
                                }
                                ?>">
                                <?php echo ucfirst($user['level']); ?>
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
