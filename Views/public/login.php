<!-- ini bagian toast notifikasi -->
<?php include 'layouts/_toast.php';?>

<div class="d-flex align-items-center py-5 my-5">
    <main class="form-signin w-100 m-auto">
        <form action="/verifylogin" method="POST">
        <img class="mb-4" src="assets/images/logo/CustomArt Logo.png" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="jhon@smith.com">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="form-floating text-start my-3">
                <h6>Belum memiliki akun ?</h6>
                <a href="/register"><strong>klik disini untuk registrasi</strong></a>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
        </form>
    </main>
</div>