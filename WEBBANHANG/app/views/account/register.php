<?php include 'app/views/shares/header.php'; ?>

<section class="vh-100" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-lg" style="border-radius: 15px; border: none; overflow: hidden;">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold mb-2" style="color: #2c3e50;">Create Account</h2>
                            <p class="text-muted">Fill in your details to register</p>
                            
                            <?php if (isset($errors)): ?>
                                <div class="alert alert-danger mt-3 text-start">
                                    <ul class="mb-0">
                                        <?php foreach ($errors as $err): ?>
                                            <li><?= htmlspecialchars($err) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <form class="user" action="/webbanhang/account/save" method="post">
                            <div class="form-group row mb-4">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <div class="form-floating">
                                        <input type="text" class="form-control form-control-lg" 
                                               id="username" name="username" placeholder="Username"
                                               style="height: 55px;" required>
                                        <label for="username" class="text-muted">Username</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control form-control-lg" 
                                               id="fullname" name="fullname" placeholder="Full Name"
                                               style="height: 55px;" required>
                                        <label for="fullname" class="text-muted">Full Name</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-4">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <div class="form-floating">
                                        <input type="password" class="form-control form-control-lg" 
                                               id="password" name="password" placeholder="Password"
                                               style="height: 55px;" required>
                                        <label for="password" class="text-muted">Password</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control form-control-lg" 
                                               id="confirmpassword" name="confirmpassword" placeholder="Confirm Password"
                                               style="height: 55px;" required>
                                        <label for="confirmpassword" class="text-muted">Confirm Password</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group text-center mt-4">
                                <button class="btn btn-primary btn-lg w-100 py-3" type="submit"
                                        style="background: linear-gradient(to right, #3498db, #2c3e50); border: none; font-weight: 600;">
                                    Register Now
                                </button>
                            </div>
                            
                            <div class="text-center mt-4 pt-3">
                                <p class="mb-0" style="font-size: 0.9rem;">Already have an account? 
                                    <a href="/webbanhang/account/login" class="text-decoration-none fw-bold" style="color: #2c3e50;">Sign In</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>