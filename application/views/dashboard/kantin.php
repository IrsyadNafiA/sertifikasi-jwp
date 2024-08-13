<div class="w-full flex flex-col p-4">
    <?php if ($user['role'] == '1') : ?>
        <button class="btn btn-success w-fit text-white mb-4" onclick="tambah_kantin.showModal()">Tambah Kantin</button>
    <?php endif ?>
    <div class="w-full grid grid-cols-4 gap-4">
        <?php foreach ($kantin as $row) : ?>
            <div class="card bg-base-100 w-full shadow-md">
                <div class="card-body">
                    <h2 class="card-title"><?= $row['nama'] ?></h2>
                    <p><?= $row['deskripsi'] ?></p>
                    <div class="card-actions justify-end">
                        <a href="<?= base_url('dashboard/detailkantin/' . $row['pemilik']) ?>" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- You can open the modal using ID.showModal() method -->
<dialog id="tambah_kantin" class="modal">
    <div class="modal-box">
        <h3 class="text-xl font-bold">Tambah Kantin!</h3>
        <hr class="my-4">
        <form method="post" action="<?= base_url('dashboard/kantin') ?>">
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Nama Kantin</span>
                </label>
                <input type="text" name="nama" placeholder="Nama Kantin" class="input input-bordered" required />
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Deskripsi</span>
                </label>
                <textarea type="text" name="deskripsi" placeholder="Deskripsi" class="textarea textarea-bordered" required></textarea>
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Pemilik</span>
                </label>
                <select class="select select-bordered w-full" name="pemilik">
                    <option disabled selected>Pilih Pemilik</option>
                    <?php foreach ($pemilik as $row) : ?>
                        <option value="<?= $row['username'] ?>"><?= $row['nama_lengkap'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-control mt-6">
                <button type="submit" name="submit" class="btn btn-primary w-fit">Tambah</button>
            </div>
        </form>
    </div>
</dialog>