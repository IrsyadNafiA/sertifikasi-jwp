<div class="w-full flex flex-col p-4">
    <?php if ($user['role'] == '2') : ?>
        <div class="w-full flex justify-between md:justify-start gap-3">
            <button class="btn btn-success w-fit text-white mb-4" onclick="tambah_menu.showModal()">Tambah Menu</button>
            <a href="<?= base_url('dashboard/pesanan') ?>" class="btn btn-primary w-fit text-white mb-4">Pesanan</a>
        </div>
    <?php else : ?>
        <a href="<?= base_url('dashboard/kantin') ?>" class="btn btn-success w-fit text-white mb-4">Back</a>
    <?php endif ?>
    <div class="w-full grid grid-cols-1 md:grid-cols-4 gap-4">
        <?php foreach ($menu as $row) : ?>
            <div class="card bg-base-100 w-full shadow-md">
                <div class="card-body">
                    <h2 class="card-title"><?= $row['nama'] ?></h2>
                    <p><?= $row['deskripsi'] ?></p>
                    <p class="font-bold text-lg text-green-600">Rp. <?= number_format($row['harga'], 0, ',', '.') ?></p>
                    <div class="card-actions justify-end">
                        <?php if ($user['role'] == '2') : ?>
                            <button class="btn btn-success text-white" onclick="edit_modal_<?= $row['id'] ?>.showModal()"><i class="fa-solid fa-pen-to-square"></i></i></button>
                            <button class="btn btn-error text-white" onclick="delete_modal_<?= $row['id'] ?>.showModal()"><i class="fa-solid fa-trash"></i></button>
                        <?php else : ?>
                            <button class="btn btn-primary" onclick="pesan_modal_<?= $row['id'] ?>.showModal()">Pesan</button>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- You can open the modal using ID.showModal() method -->
<dialog id="tambah_menu" class="modal">
    <div class="modal-box">
        <h3 class="text-xl font-bold">Tambah Menu!</h3>
        <hr class="my-4">
        <form method="post" action="<?= base_url('dashboard/detailKantin/' . $kantin['pemilik']) ?>">
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Nama Menu</span>
                </label>
                <input type="text" name="nama" placeholder="Nama Menu" class="input input-bordered" required />
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Deskripsi</span>
                </label>
                <textarea type="text" name="deskripsi" placeholder="Deskripsi" class="textarea textarea-bordered" required></textarea>
            </div>
            <div class="form-control">
                <label class="label">
                    <span class="label-text">Harga</span>
                </label>
                <input type="number" name="harga" placeholder="000000" class="input input-bordered" required />
            </div>
            <div class="form-control mt-6">
                <button type="submit" name="submit" class="btn btn-primary w-fit">Tambah</button>
            </div>
        </form>
    </div>
</dialog>

<!-- edit modal -->
<?php foreach ($menu as $row) : ?>
    <dialog id="edit_modal_<?= $row['id'] ?>" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Apakah yakin ingin mengedit menu <span class="text-blue-600"><?= $row['nama'] ?></span>?</h3>
            <form action="<?= base_url('dashboard/editMenu/' . $row['id']) ?>" method="POST">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nama Menu</span>
                    </label>
                    <input type="text" name="nama" placeholder="Nama Menu" value="<?= $row['nama'] ?>" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Deskripsi</span>
                    </label>
                    <textarea type="text" name="deskripsi" placeholder="Deskripsi" class="textarea textarea-bordered" required><?= $row['deskripsi'] ?></textarea>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Harga</span>
                    </label>
                    <input type="number" name="harga" placeholder="000000" value="<?= $row['harga'] ?>" class="input input-bordered" required />
                </div>
                <div class="form-control mt-6">
                    <button type="submit" name="submit" class="btn btn-primary w-fit">Edit</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
<?php endforeach; ?>

<!-- delete modal -->
<?php foreach ($menu as $row) : ?>
    <dialog id="delete_modal_<?= $row['id'] ?>" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Apakah yakin ingin menghapus menu <span class="text-blue-600"><?= $row['nama'] ?></span>?</h3>
            <form action="<?= base_url('dashboard/deleteMenu/' . $row['id']) ?>" method="POST">
                <button type="submit" class="btn btn-error text-white mr-2">Iya</button>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
<?php endforeach; ?>

<!-- pesan modal -->
<?php foreach ($menu as $row) : ?>
    <dialog id="pesan_modal_<?= $row['id'] ?>" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Pesan menu <span class="text-blue-600"><?= $row['nama'] ?></span>?</h3>
            <form action="<?= base_url('dashboard/pesanMenu/' . $row['id']) ?>" method="POST">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nama Menu</span>
                    </label>
                    <input type="text" name="nama_menu" placeholder="Nama Menu" value="<?= $row['nama'] ?>" class="input input-bordered" required readonly />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Jumlah Pesanan</span>
                    </label>
                    <input type="number" name="jumlah" placeholder="Jumlah" class="input input-bordered" required />
                </div>
                <div class="hidden">
                    <input type="text" name="kantin_id" value="<?= $row['kantin_id'] ?>">
                    <input type="text" name="nama_pemesan" value="<?= $user['nama_lengkap'] ?>">
                    <input type="text" name="username" value="<?= $user['username'] ?>">
                    <input type="text" name="harga" value="<?= $row['harga'] ?>">
                </div>
                <div class="form-control mt-6">
                    <button type="submit" name="submit" class="btn btn-primary w-fit">Pesan</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
<?php endforeach; ?>