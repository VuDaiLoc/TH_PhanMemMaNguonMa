<?php include 'app/views/shares/header.php'; ?>

<section class="vh-100" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-lg" style="border-radius: 15px; border: none; overflow: hidden;">
                    <div class="card-body p-5">
                        <div class="text-center mb-5">
                            <h2 class="fw-bold mb-2" style="color: #2c3e50;">Welcome Back</h2>
                            <p class="text-muted">Sign in to continue to your account</p>
                        </div>
                        
                        <form action="/webbanhang/account/checklogin" method="post">
                            <div class="form-floating mb-4">
                                <input type="text" name="username" class="form-control form-control-lg" id="username" 
                                       placeholder="Username" style="height: 55px;" required>
                                <label for="username" class="text-muted">Username</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control form-control-lg" id="password" 
                                       placeholder="Password" style="height: 55px;" required>
                                <label for="password" class="text-muted">Password</label>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" style="width: 1.1em; height: 1.1em;">
                                    <label class="form-check-label" for="remember" style="font-size: 0.9rem;">Remember me</label>
                                </div>
                                <a href="#!" class="text-decoration-none" style="font-size: 0.9rem; color: #3498db;">Forgot password?</a>
                            </div>
                            
                            <button class="btn btn-primary btn-lg w-100 py-3 mb-4" type="submit" 
                                    style="background: linear-gradient(to right, #3498db, #2c3e50); border: none; font-weight: 600;">
                                Login
                            </button>
                            
                            <div class="text-center mt-4 pt-3">
                                <p class="mb-0" style="font-size: 0.9rem;">Don't have an account? 
                                    <a href="/webbanhang/account/register" class="text-decoration-none fw-bold" style="color: #2c3e50;">Sign Up</a>
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