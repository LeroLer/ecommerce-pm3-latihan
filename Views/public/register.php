<!-- ini bagian toast notifikasi -->
<?php include 'layouts/_toast.php';?>

<div class="d-flex align-items-center py-5 my-5">
    <main class="form-signin w-100 m-auto">
        <form action="/registerUser" method="POST">
        <img class="mb-4" src="assets/images/logo/CustomArt Logo.png" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Register Akun</h1>
            <div class="form-floating">
                <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="mail@example.com">
                <label for="floatingEmail">Email</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Username">
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Register</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
        </form>
    </main>
</div>
