<?php require_once 'templates/header.php';?>


<div class="container mt-5">
    <div class="card mx-auto" style="width: 30rem;">
        <div class="card-header text-center p-2"><h3>Register Form</h3></div>
        <div class="card-body">
            <form id="register_form" onsubmit="return false" autocomplete="off">
                <div class="form-group">
                    <label for="username">Full Name</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
                    <small id="u_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="e_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="password1">Password</label>
                    <input type="password" name="password1" class="form-control"  id="password1" placeholder="Password">
                    <small id="p1_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="password2">Re-enter Password</label>
                    <input type="password" name="password2" class="form-control"  id="password2" placeholder="Password">
                    <small id="p2_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="usertype">Usertype</label>
                    <select name="usertype" class="form-control" id="usertype">
                        <option value="">Choose User Type</option>
                        <option value="Admin">Admin</option>
                        <option value="Other">Other</option>
                    </select>
                    <small id="t_error" class="form-text text-muted"></small>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button type="submit" name="user_register" class="btn btn-primary btn-block"><span class="fa fa-user"></span>&nbsp;Register</button>
                    </div>
                    <div class="col-6">
                        <span><a href="login.php" class="btn btn-info btn-block"><i class="fa fa-user mr-2"></i> Login</a></span>
                    </div>

                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'templates/footer.php';?>


