<?php require_once 'templates/header.php'?>
<?php require_once 'templates/navbar.php'?>

    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
                    <div class="card-header">
                        <h2>New Order</h2>
                    </div>
                    <div class="card-body">
                        <form id="get_order_data" onsubmit="return false">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" align="right">Order Date</label>
                                <div class="col-sm-6">
                                    <input type="text" id="order_date" name="order_date" readonly class="form-control form-control-sm" value="<?php echo date("Y-d-m"); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" align="right">Customer Name*</label>
                                <div class="col-sm-6">
                                    <input type="text" id="cust_name" name="cust_name"class="form-control form-control-sm" placeholder="Enter Customer Name" required/>
                                </div>
                            </div>


                            <div class="card" style="box-shadow:0 0 15px 0 lightgrey;">
                                <div class="card-body">
                                    <h3>Make a order list</h3>
                                    <table align="center" style="width:800px;">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="text-align:center;">Item Name</th>
                                            <th style="text-align:center;">Total Quantity</th>
                                            <th style="text-align:center;">Quantity</th>
                                            <th style="text-align:center;">Price</th>
                                            <th>Total</th>

                                        </tr>
                                        <hr>
                                        </thead>
                                        <tbody id="invoice_item">
                                        <!--<tr>
                                            <td><b id="number">1</b></td>
                                            <td>
                                                <select name="pid[]" class="form-control form-control-sm" required>
                                                    <option>Washing Machine</option>
                                                </select>
                                            </td>
                                            <td><input name="tqty[]" readonly type="text" class="form-control form-control-sm"></td>
                                            <td><input name="qty[]" type="text" class="form-control form-control-sm" required></td>
                                            <td><input name="price[]" type="text" class="form-control form-control-sm" readonly></td>
                                            <td>Rs.1540</td>
                                        </tr>-->
                                        </tbody>
                                    </table> <!--Table Ends-->
                                    <center style="padding:10px; margin-top: 8px">
                                        <button id="add"  class="btn btn-success btn-sm">Add <i class="fa fa-plus ml-1"></i></button>
                                        <button id="remove" class="btn btn-danger btn-sm">Remove <i class="fa fa-trash-alt ml-1"></i></button>
                                    </center>
                                </div> <!--Crad Body Ends-->
                            </div> <!-- Order List Crad Ends-->

                            <p></p>
                            <div class="form-group row">
                                <label for="sub_total" class="col-sm-3 col-form-label" align="right">Sub Total</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly name="sub_total" class="form-control form-control-sm" id="sub_total" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gst" class="col-sm-3 col-form-label" align="right">GST (10%)</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly name="gst" class="form-control form-control-sm" id="gst" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="discount" class="col-sm-3 col-form-label" align="right">Discount</label>
                                <div class="col-sm-6">
                                    <input type="text" name="discount" class="form-control form-control-sm" id="discount" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly name="net_total" class="form-control form-control-sm" id="net_total" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                                <div class="col-sm-6">
                                    <input type="text" name="paid" class="form-control form-control-sm" id="paid" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="due" class="col-sm-3 col-form-label" align="right">Due</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly name="due" class="form-control form-control-sm" id="due" required/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="payment_type" class="col-sm-3 col-form-label" align="right">Payment Method</label>
                                <div class="col-sm-6">
                                    <select name="payment_type" class="form-control form-control-sm" id="payment_type" required/>
                                    <option>Cash</option>
                                    <option>Card</option>
                                    <option>Draft</option>
                                    <option>Cheque</option>
                                    </select>
                                </div>
                            </div>

                            <center>
                                <input type="submit" id="order_form" style="width:150px;" class="btn btn-info" value="Order">
                                <input type="submit" id="print_invoice" style="width:150px;" class="btn btn-success d-none" value="Print Invoice">
                            </center>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once 'templates/footer.php'?>