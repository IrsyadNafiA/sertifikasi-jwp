<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Kantin | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content flex-col gap-8">
            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold">Register E-Kantin!</h1>
                <!-- <p class="py-6">
                    Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                    quasi. In deleniti eaque aut repudiandae et a id nisi.
                </p> -->
            </div>
            <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
                <form action="<?= base_url('auth/register') ?>" method="post" class="card-body">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Username</span>
                        </label>
                        <input type="text" name="username" placeholder="Username" class="input input-bordered" required />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" name="password" placeholder="Password" class="input input-bordered" required />
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Confirm Password</span>
                        </label>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="input input-bordered" required />
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
                    <?php if ($this->session->flashdata('error')) : ?>
                        <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
                    <?php endif; ?>
                    <div class="form-control mt-6">
                        <button type="submit" name="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>