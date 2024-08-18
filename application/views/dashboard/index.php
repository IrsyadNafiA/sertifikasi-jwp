<div class="w-full flex flex-col items-start p-4 gap-4">
    <div class="w-full bg-slate-500 text-white p-4 rounded-md text-center">
        <h1 class="text-3xl font-bold">SELAMAT DATANG DI APLIKASI E-KANTIN</h1>
    </div>
    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-8 py-8">
        <div class="w-full p-8 flex justify-center bg-white shadow-md rounded-lg gap-4 border border-slate-100">
            <div class="w-60 h-full hidden lg:block">
                <img src="<?= base_url('assets/img/profile_picture/') . $user['profile_picture'] ?>" alt="User" class="object-cover w-full h-full" />
            </div>
            <div class="text-center w-full">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr class="text-center text-lg">
                            <th colspan="2">DATA DIRI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr>
                            <td>Nama</td>
                            <td>: <?= $user['nama_lengkap'] ?></td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>: <?= $user['kelas'] ?></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>: <?= $user['username'] ?></td>
                        </tr>
                        <tr>
                            <td>No. HP</td>
                            <td>: <?= $user['no_hp'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if ($user['role'] !== '1') : ?>
            <div class="w-full p-8 flex justify-center bg-white shadow-md rounded-lg gap-4 border border-slate-100">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr class="text-center text-lg">
                            <th colspan="3">RIWAYAT PEMESANAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <?php foreach ($pesanan as $index => $row) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $row['nama_menu'] ?></td>
                                <td><span class="badge <?= $row['status'] == 'done' ? 'badge-success' : ($row['status'] == 'waiting' ? 'badge-warning' : ($row['status'] == 'approved' ? 'badge-success' : 'badge-error')) ?> capitalize"><?= $row['status'] ?></span></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        <?php endif ?>

        <?php if ($user['role'] == '1') : ?>
            <div class="w-full p-8 flex flex-col items-center bg-white shadow-md rounded-lg gap-4 border border-slate-100">
                <h3 class="text-lg font-bold text-gray-500 mb-6">JUMLAH KANTIN</h3>
                <div class="flex justify-center w-full gap-8">
                    <i class="fa-solid fa-shop fa-6x"></i>
                    <p id="typed-output" class="text-8xl font-bold">3</p>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>