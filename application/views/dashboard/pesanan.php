<div class="w-full flex flex-col items-center p-4">
    <div class="card w-full bg-white shadow-md p-6 rounded-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Pesanan</h2>
        <div class="overflow-x-auto">
            <!-- <button class="btn btn-success mb-4 text-white" onclick="add_modal.showModal()">Tambah</button> -->
            <table id="userTable" class="table w-full">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Menu</th>
                        <th>Pemesan</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                        <th>Informasi</th>
                        <th width="10%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pesanan as $index => $row) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $row['nama_menu'] ?></td>
                            <td><?= $row['nama_pemesan'] ?></td>
                            <td><?= $row['jumlah'] ?></td>
                            <td><?= $row['harga'] ?></td>
                            <td><?= $row['tanggal_pemesanan'] ?></td>
                            <td><?= $row['informasi'] ?></td>
                            <td>
                                <?php if ($user['role'] == 2) : ?>
                                    <?php if ($row['status'] == 'waiting') : ?>
                                        <button class="btn btn-sm btn-warning mr-1" onclick="approval_modal_<?= $row['id'] ?>.showModal()"><i class="fa-solid fa-stopwatch"></i></button>
                                    <?php elseif ($row['status'] == 'approved') : ?>
                                        <button class="btn btn-sm btn-success mr-1 text-white" onclick="confirm_modal_<?= $row['id'] ?>.showModal()">Approved</button>
                                    <?php else : ?>
                                        <span class="btn btn-sm <?= $row['status'] == 'done' ? 'btn-success' : 'btn-error' ?> capitalize"><?= $row['status'] ?></span>
                                    <?php endif ?>
                                <?php else : ?>
                                    <span class="btn btn-sm <?= $row['status'] == 'done' ? 'btn-success' : ($row['status'] == 'waiting' ? 'btn-warning' : ($row['status'] == 'approved' ? 'btn-success' : 'btn-error')) ?> capitalize"><?= $row['status'] ?></span>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- pesan modal -->
<?php foreach ($pesanan as $row) : ?>
    <dialog id="approval_modal_<?= $row['id'] ?>" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Approval pesanan <span class="text-blue-600"><?= $row['nama_pemesan'] ?></span>?</h3>
            <form action="<?= base_url('dashboard/approvalPesanan/' . $row['id']) ?>" method="POST">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Nama Menu</span>
                    </label>
                    <input type="text" name="nama_menu" placeholder="Nama Menu" value="<?= $row['nama_menu'] ?>" class="input input-bordered" required readonly />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Informasi</span>
                    </label>
                    <textarea name="informasi" class="textarea textarea-bordered" required></textarea>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Status</span>
                    </label>
                    <select name="status" class="select select-bordered w-full">
                        <option value="approved">Terima</option>
                        <option value="rejected">Tolak</option>
                    </select>
                </div>
                <div class="form-control mt-6">
                    <button type="submit" name="submit" class="btn btn-primary w-fit">Submit</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
<?php endforeach; ?>

<!-- pesan modal -->
<?php foreach ($pesanan as $row) : ?>
    <dialog id="confirm_modal_<?= $row['id'] ?>" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">Konfirmasi pesanan <span class="text-blue-600"><?= $row['nama_pemesan'] ?></span>?</h3>
            <form action="<?= base_url('dashboard/approvalPesanan/' . $row['id']) ?>" method="POST">
                <div class="hidden">
                    <input type="text" name="status" value="done">
                    <input type="text" name="informasi" value="done">
                </div>
                <div class="form-control mt-6">
                    <button type="submit" name="submit" class="btn btn-primary w-fit">Iya</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
<?php endforeach; ?>