<?php require_once 'templates/header.php';?>
<?php
use App\classes\Session;
?>
<?php
if(isset( $_SESSION['loginSuccess'])){
    header('location:index.php');
}
?>
<div class="container">
    <?php
    if (isset($_GET["msg"]) AND !empty($_GET["msg"])) {
        ?>
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <?= $_GET["msg"]; ?>
            <?= \App\classes\Session::get('UserId') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-12">
            <div class="login-box">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="images/login.png" alt="">
                    </div>
                    <div class="card-body" style="margin-bottom: 0px;padding-bottom: 0px">
                        <form action="" id="login_form" onsubmit="return false" autocomplete="off">
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email address">
                                <small id="e_error" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="password">Password :</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password"><small id="p_error" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100" name="login"id="login">
                                    <i class="fa fa-lock mr-2"></i>
                                    Log In
                                </button>

                            </div>
                        </form>
                        <div class="form-group">
                            <a href="registration.php" class="btn btn-info w-100"> <i class="fa fa-user mr-2"></i>Registration</a>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-link"> <i class="fa fa-key mr-2"></i>Forgot Password ?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'templates/footer.php';?>


