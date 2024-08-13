<div class="w-full flex flex-col items-center p-4">
    <div class="card w-full bg-white shadow-md p-6 rounded-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Edit Profil</h2>
        <form action="<?= base_url('dashboard/editprofil') ?>" method="POST">
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Nama Lengkap</span>
                </label>
                <input type="text" name="nama_lengkap" value="<?= $user['nama_lengkap'] ?>" class="input input-bordered w-full" />
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">No. HP</span>
                </label>
                <input type="text" name="no_hp" value="<?= $user['no_hp'] ?>" class="input input-bordered w-full" />
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Kelas</span>
                </label>
                <input type="text" name="kelas" value="<?= $user['kelas'] ?>" class="input input-bordered w-full" />
            </div>
            <div class="form-control mt-6">
                <button type="submit" name="submit" class="btn btn-primary w-full">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>