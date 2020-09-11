<?php require_once 'templates/header.php';?>
<?php require_once 'templates/navbar.php';?>
<?php
use App\classes\Session;
?>
<?php
if(!isset( $_SESSION['loginSuccess'])){
    header('location:login.php');
}
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <img class="card-img-top mx-auto" src="images/user.png" alt="Card image cap" style="width: 60%;">
                <div class="card-body">
                    <h5 class="card-title">Profile</h5>
                    <p class="card-text"><i class="fa fa-user"></i> <?= Session::get('UserName')?></p>
                    <p class="card-text"><i class="fa fa-user"></i> <?= Session::get('UserType')?></p>
                    <p class="card-text"><i class="fa fa-clock"></i> Last login - <?= Session::get('UserTime')?></p>
                    <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt mr-1"></i>Edit Profile</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="jumbotron" style="height: 100%;">
                <h1>Welcome</h1>
                <p>Have a nice day ,</p>
                <div class="row">
                    <div class="col-md-6">
                        <iframe src="http://free.timeanddate.com/clock/i7g347a5/n1940/szw160/szh160/hoc444/cf100/hnceee" frameborder="0" width="160" height="160"></iframe>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Orders</h5>
                                <p class="card-text">Some quick exampl of the card's content.</p>
                                <a href="newOrder.php" class="btn btn-primary"> <i class="fa fa-plus mr-1"></i> New Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Category</h5>
                    <p class="card-text">Some quick exthe card's content.</p>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#categoryModal"> <i class="fa fa-plus mr-1"></i>Add Category</a>
                    <a href="managecategory.php" class="btn btn-info" >Manage Category</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Brand</h5>
                    <p class="card-text">Some quick exthe card's content.</p>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#brandModal"> <i class="fa fa-plus mr-1"></i>Add Brand</a>
                    <a href="manageBrand.php" class="btn btn-info">Manage Brand</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product</h5>
                    <p class="card-text">Some quick exthe card's content.</p>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#productModal"> <i class="fa fa-plus mr-1"></i>Add Product</a>
                    <a href="manageProduct.php" class="btn btn-info">Manage Product</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'templates/categoryModal.php';?>
<?php require_once 'templates/brandModal.php';?>
<?php require_once 'templates/productModal.php';?>
<?php require_once 'templates/footer.php';?>


