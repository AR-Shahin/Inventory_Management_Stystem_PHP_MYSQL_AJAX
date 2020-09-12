<?php require_once 'templates/header.php';?>
<?php require_once 'templates/navbar.php';?>
<?php
use App\classes\Manage;

?>
<?php
if(isset($_POST['duebtn'])){
    $invid = $_POST['invId'];
    $amt = $_POST['paydue'];
    $obm = new Manage();
    $rtn = $obm->updateDuePayment($invid,$amt);
    if($rtn == "SUCCESS"){ ?>
        <script>alert("Due pay successfully!!")</script>
    <?php  }else{ ?>
        <script>alert("Something Wrong!!")</script>
    <?php  }
}
?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">All Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Due Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <hr>
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>Sub Total</th>
                                <th>GST</th>
                                <th>Discount</th>
                                <th>Net Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Payment Type</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody id="get_order">
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
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <table  id="example" class="ui celled table" style="width:100%"" >
                        <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Customer Name</th>
                            <th>Order Date</th>
                            <th>Net Total</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Pay Due </th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $ob = new Manage();
                        $row = $ob->getAllDueOrder();
                        $i=0;
                        while ($data = $row->fetch_assoc()){ ?>
                            <tr style="justify-content: center;align-items: center">
                                <td><?= ++$i?></td>
                                <td><?= $data['customer_name']?> <?= $data['invoice_no']?>
                                </td>
                                <td><?= $data['order_date']?></td>
                                <td><?= $data['net_total']?></td>
                                <td><?= $data['paid']?></td>
                                <td><?= $data['due']?></td>

                                <td class="text-center">
                                    <form action="" class="duePayFrom" method="post">
                                        <input type="hidden" value="<?= $data['invoice_no'] ?>" name="invId" id="invId">
                                        <input type="text" class="form-control w-75 mx-auto" placeholder="Pay due" id="payDue" name="paydue" required>
                                        <input type="submit" value="Pay" id="payDueBtn" class="btn btn-success w-75 mt-1" name="duebtn">
                                    </form></td>
                                <td><?php
                                    if($data['due'] == 0){
                                        echo '<span><a href="" class="btn btn-success">Paid</a></span>';
                                    }else{
                                        echo '<span><a href="" class="btn btn-danger">Due</a></span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php  } ?>

                        </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                </div>
            </div>
        </div>
    </div>
<?php require_once 'templates/footer.php';?>