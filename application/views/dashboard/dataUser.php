<div class="w-full flex flex-col items-center p-4">
    <div class="card w-full bg-white shadow-md p-6 rounded-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Data User</h2>
        <div class="overflow-x-auto">
            <button class="btn btn-success mb-4 text-white" onclick="add_modal.showModal()">Tambah</button>
            <table id="userTable" class="table w-full">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>No. HP</th>
                        <th>Kelas</th>
                        <th>Role</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userData as $index => $row) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['nama_lengkap'] ?></td>
                            <td><?= $row['no_hp'] ?></td>
                            <td><?= $row['kelas'] ?></td>
                            <td><?= $row['role'] ?></td>
                            <td>
                                <button class="btn btn-sm btn-success mr-1 text-white" onclick="edit_modal_<?= $row['id'] ?>.showModal()"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-sm btn-error text-white" onclick="delete_modal_<?= $row['id'] ?>.showModal()"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Tambah Modal -->
<dialog id="add_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Tambah User</h3>
        <div class="modal-action">
            <form action="<?= base_url('Dashboard/datauser') ?>" method="post" class="card-body">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" name="username" placeholder="Username" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nama Lengkap</span>
                    </label>
                    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">No. HP</span>
                    </label>
                    <input type="text" name="no_hp" placeholder="08xxxxxxxxx" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Kelas</span>
                    </label>
                    <input type="text" name="kelas" placeholder="Kelas" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Role</span>
                    </label>
                    <select class="select select-bordered w-full" name="role">
                        <option disabled selected>Select Role</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
                <?php if ($this->session->flashdata('error')) : ?>
                    <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                <?php endif; ?>
                <div class="form-control mt-6">
                    <button type="submit" name="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</dialog>

<?php foreach ($userData as $index => $row) : ?>
    <dialog id="edit_modal_<?= $row['id'] ?>" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Ganti Pengguna <span class="text-blue-600"><?= $row['nama_lengkap'] ?></span>?</h3>
            <form action="<?= base_url('dashboard/EditDataUser/' . $row['id']) ?>" method="POST">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" name="username" placeholder="Username" value="<?= $row['username'] ?>" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nama Lengkap</span>
                    </label>
                    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= $row['nama_lengkap'] ?>" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">No. HP</span>
                    </label>
                    <input type="text" name="no_hp" placeholder="08xxxxxxxxx" value="<?= $row['no_hp'] ?>" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Kelas</span>
                    </label>
                    <input type="text" name="kelas" placeholder="Kelas" value="<?= $row['kelas'] ?>" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Role</span>
                    </label>
                    <select class="select select-bordered w-full" name="role">
                        <option disabled selected>Select Role</option>
                        <?php for ($i = 1; $i <= 3; $i++) : ?>
                            <option value="<?= $i ?>" <?= $row['role'] == $i ? 'selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="w-full text-end mt-6">
                    <button type="submit" name="submit" class="btn btn-primary w-fit">Edit</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
<?php endforeach; ?>

<?php foreach ($userData as $index => $row) : ?>
    <dialog id="delete_modal_<?= $row['id'] ?>" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Hapus Pengguna <span class="text-blue-600"><?= $row['nama_lengkap'] ?></span>?</h3>
            <form action="<?= base_url('dashboard/DeleteDataUser/' . $row['id']) ?>" method="POST">
                <div class="w-full text-end mt-6">
                    <button type="submit" name="submit" class="btn btn-error text-white w-fit">Hapus</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
<?php endforeach; ?>