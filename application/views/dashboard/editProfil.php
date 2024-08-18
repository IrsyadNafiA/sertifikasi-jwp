<div class="w-full flex flex-col items-center p-4">
    <div class="card w-full bg-white shadow-md p-6 rounded-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Edit Profil</h2>
        <div class="w-full py-2 flex flex-col items-center justify-center">
            <?= form_open_multipart('dashboard/editPicture') ?>
            <input type="text" name="username" value="<?= $user['username'] ?>" class="hidden">
            <div id="changeProfile" class="changeProfile sm:w-64 sm:h-64 w-40 h-40 relative bg-primary rounded-full">
                <img class="rounded-full object-cover w-full h-full" src="<?= base_url('assets/img/profile_picture/') . $user['profile_picture'] ?>" alt="User" />
                <label for="profile_picture" class="cursor-pointer">
                    <div class="content w-full h-full rounded-full absolute top-0 font-medium text-white leading-tight flex flex-col justify-center items-center">
                        <span class="w-8 h-8">
                            <i class="fa-solid fa-camera fa-2xl"></i>
                        </span>
                        <span class="text-center">Change<br />Profile</span>
                    </div>
                    <span class="w-8 h-8 bg-gray-200 stroke-white p-1 rounded-full absolute bottom-0 sm:right-12 right-4 flex items-center justify-center">
                        <i class="fa-solid fa-camera fa-md"></i>
                    </span>
                </label>
            </div>
            <input type="file" class="hidden" id="profile_picture" name="profile_picture" accept="image/*" onchange="displaySelectedFile()">
            <p id="selectedFile" class="text-red-500 mt-2"></p>
            <button id="pictureButton" type="submit" class=" bg-primary gap-1 text-white p-2 rounded-md text-sm justify-center stroke-white hover:bg-secondary w-fit hidden mt-2">
                Change Picture
            </button>
            <?= form_close() ?>
        </div>
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