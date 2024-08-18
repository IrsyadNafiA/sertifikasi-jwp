</div>
<div class="drawer-side">
    <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
    <ul class="menu bg-base-200 min-h-full w-80 p-4">
        <!-- Sidebar content here -->
        <li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
        <?php if ($user['role'] !== '2') : ?>
            <li><a href="<?= base_url('dashboard/kantin') ?>">Kantin</a></li>
            <li><a href="<?= base_url('dashboard/pesanan') ?>">Pesanan Saya</a></li>
        <?php endif ?>
        <?php if ($user['role'] == '2') : ?>
            <li><a href="<?= base_url('dashboard/detailkantin/') . $user['username'] ?>">Kantin Saya</a></li>
        <?php endif ?>
        <?php if ($user['role'] == '1') : ?>
            <li><a href="<?= base_url('dashboard/datauser') ?>">Data User</a></li>
        <?php endif ?>
        <li><a href="<?= base_url('dashboard/editprofil') ?>">Edit Profil</a></li>
        <li><a href="<?= base_url('auth/logout') ?>">Logout</a></li>
    </ul>
</div>
</div> <!-- Sidebar -->

<?php if (isset($customJs)) : ?>
    <?php if (gettype($customJs) == 'array') : ?>
        <?php foreach ($customJs as $index => $row) : ?>
            <?php $this->load->view('templates/custom/' . $row) ?>
        <?php endforeach ?>
    <?php elseif (gettype($customJs) == 'string') : ?>
        <?php $this->load->view('templates/custom/' . $customJs) ?>
    <?php endif ?>
<?php endif ?>
</body>

</html>