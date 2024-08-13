<div class="drawer">
    <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col">
        <!-- Navbar -->
        <div class="navbar bg-white shadow-md w-full">
            <div class="flex-none lg:hidden">
                <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-6 w-6 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </label>
            </div>
            <div class="mx-2 flex-1 px-2 font-bold text-xl">E-Kantin</div>
            <div class="hidden flex-none lg:block">
                <ul class="menu menu-horizontal">
                    <!-- Navbar menu content here -->
                    <li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                    <?php if ($user['role'] !== '2') : ?>
                        <li><a href="<?= base_url('dashboard/kantin') ?>">Kantin</a></li>
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
        </div>