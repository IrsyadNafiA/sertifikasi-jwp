<div class="w-full flex flex-col items-center p-4">
    <div class="card w-full bg-white shadow-md p-6 rounded-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Change Password</h2>
        <form action="<?= base_url('auth/changepassword') ?>" method="POST">
            <input type="text" name="username" value="<?= $user['username'] ?>" class="hidden">
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Password Baru</span>
                </label>
                <input type="password" name="password" class="input input-bordered w-full" />
            </div>
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Konfirmasi Password</span>
                </label>
                <input type="password" name="confirm_password" class="input input-bordered w-full" />
            </div>
            <?php if ($this->session->flashdata('error')) : ?>
                <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
            <?php endif; ?>
            <div class="form-control mt-6">
                <button type="submit" name="submit" class="btn btn-primary w-full">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>