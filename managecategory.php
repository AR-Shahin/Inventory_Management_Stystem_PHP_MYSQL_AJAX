<?php require_once 'templates/header.php';?>
<?php require_once 'templates/navbar.php';?>
<?php
use App\classes\Manage;
?>
<?php
use App\classes\Session;
?>
<?php
if(!isset( $_SESSION['loginSuccess'])){
    header('location:login.php');
}
?>

<div class="container">
    <h2 class="mt-4 pt-4">Manage Category</h2>
    <hr>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Category</th>
            <th>Parent</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="get_category">
        <!--<tr>
          <td>1</td>
          <td>Electronics</td>
          <td>Root</td>
          <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
          <td>
              <a href="#" class="btn btn-danger btn-sm">Delete</a>
              <a href="#" class="btn btn-info btn-sm">Edit</a>
          </td>
        </tr>-->
        </tbody>
    </table>
</div>
<?php require_once 'templates/updateCategory.php';?>
<?php require_once 'templates/footer.php';?>

