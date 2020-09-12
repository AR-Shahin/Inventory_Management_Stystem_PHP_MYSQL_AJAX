$(document).ready(function () {

    $('#register_form').on("submit",function () {
        var DOMAIN = "http://localhost/inventory";
        var name = $('#username');
        var email = $('#email');
        var pass1  = $('#password1');
        var pass2 = $('#password2');
        var type = $('#usertype');
        var status = false;
        var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);

        if(name.val() == ''){
            name.addClass('border-danger');
            $('#u_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            if(name.val().length <6){
                name.addClass('border-danger');
                $('#u_error').html("<span class='text-danger'>Name should be more than 6 character!!</span>");
            }else {
                name.removeClass('border-danger');
                $('#u_error').html('');
                status = true;
            }
        }

        if(email.val() == ''){
            email.addClass('border-danger');
            $('#e_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            if (!e_patt.test(email.val())) {
                email.addClass('border-danger');
                $('#e_error').html("<span class='text-danger'>Please enter valid email!!</span>");
            } else {
                email.removeClass('border-danger');
                $('#e_error').html('');
                status = true;
            }
        }

        if(pass1.val() == "" || pass1.val().length < 6){
            pass1.addClass("border-danger");
            $("#p1_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
            status = false;
        }else{
            pass1.removeClass("border-danger");
            $("#p1_error").html("");
            status = true;
        }
        if(pass2.val() == "" || pass2.val().length < 6){
            pass2.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
            status = false;
        }else{
            pass2.removeClass("border-danger");
            $("#p2_error").html("");
            status = true;
        }
        if(type.val() == ""){
            type.addClass("border-danger");
            $("#t_error").html("<span class='text-danger'>Field must not be empty!!</span>");
            status = false;
        }else{
            type.removeClass("border-danger");
            $("#t_error").html("");
            status = true;
        }

        if ((pass1.val() == pass2.val()) && status == true) {
            $(".overlay").show();
            $.ajax({
                url : "./inc/process.php",
                method : "POST",
                data : $("#register_form").serialize(),
                success : function(data){
                    if (data == "EMAIL_ALREADY_EXISTS") {
                        $(".overlay").hide();
                        alert("It seems like you email is already used");
                    }else if(data == "SOME_ERROR"){
                        $(".overlay").hide();
                        alert("Something Wrong");
                    }else{
                        $(".overlay").hide();
                        window.location.href = encodeURI("./login.php?msg=You are registered Now you can login");
                    }
                }

            })
        }else{
            pass2.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Password not Match!!!</span>");
            status = false;
        }
    });

    /*login */

    $('#login_form').on("submit",function () {
        var email = $('#email');
        var pass = $('#password');
        var status = false;
        var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);

        if(email.val() == ''){
            email.addClass('border-danger');
            $('#e_error').html("<span class='text-danger'>Field must not be empty!!</span>");
        }else {
            if (!e_patt.test(email.val())) {
                email.addClass('border-danger');
                $('#e_error').html("<span class='text-danger'>Please enter valid email!!</span>");
            } else {
                email.removeClass('border-danger');
                $('#e_error').html('');
                status = true;
            }
        }

        if(pass.val() == ""){
            pass.addClass("border-danger");
            $("#p_error").html("<span class='text-danger'>Field must not be empty!!</span>");
            status = false;
        }else{
            pass.removeClass("border-danger");
            $("#p_error").html("");
            status = true;
        }

        if(status){
            $(".overlay").show();
            $.ajax({
                url : "./inc/process.php",
                method : "POST",
                data : $("#login_form").serialize(),
                success : function(data){
                    if (data == "NOT_REGISTERD") {
                        $(".overlay").hide();
                        email.addClass("border-danger");
                        $("#e_error").html("<span class='text-danger'>It seems like you are not registered</span>");
                    }else if(data == "PASSWORD_NOT_MATCHED"){
                        $(".overlay").hide();
                        pass.addClass("border-danger");
                        $("#p_error").html("<span class='text-danger'>Please Enter Correct Password</span>");
                        status = false;
                    }else if(data == "REGISTERD"){
                        $(".overlay").hide();
                        console.log(data);
                        window.location.href = "./index.php";
                    }
                }

            })
        }
    });
    //Fetch category
    fetch_category();
    function fetch_category(){
        $.ajax({
            url : "./inc/process.php",
            method : "POST",
            data : {getCategory:1},
            success : function(data){

                var root = "<option value='0'>Root</option>";
                var choose = "<option value=''>Choose Category</option>";
                $("#parent_cat").html(root+data);
                $("#select_cat").html(choose+data);
            }
        })
    }
    //Add Category
    $("#category_form").on("submit",function(){
        if ($("#catname").val() == "") {
            $("#catname").addClass("border-danger");
            $("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
        }else {
            $.ajax({
                url : "./inc/process.php",
                method : "POST",
                data  : $("#category_form").serialize(),
                success : function(data){
                    if (data == "CATEGORY_ADDED") {
                        $("#catname").removeClass("border-danger");
                        $("#cat_error").html("<span class='text-success'>New Category Added Successfully..!</span>");
                        $("#catname").val("");
                        fetch_category();
                    }else if(data == "ALREADY_EXISTS"){
                        alert("It seems like you Category is already used");
                    }
                    else{
                        alert(data);
                    }
                }
            })
        }
    });
    //fetch brand
    fetch_brand();
    function fetch_brand() {
        $.ajax({
            url : "./inc/process.php",
            method : "POST",
            data : {getBrand:1},
            success : function(data){
                var choose = "<option value=''>Choose Brand</option>";
                $("#select_brand").html(choose+data);
            }
        })
    }

    //Add Brand
    $("#brand_form").on("submit",function(){
        if ($("#brandname").val() == "") {
            $("#brandname").addClass("border-danger");
            $("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
        }else{
            $.ajax({
                url : "./inc/process.php",
                method : "POST",
                data : $("#brand_form").serialize(),
                success : function(data){
                    if (data == "BRAND_ADDED") {
                        $("#brandname").removeClass("border-danger");
                        $("#brand_error").html("<span class='text-success'>New Brand Added Successfully..!</span>");
                        $("#brandname").val("");
                        fetch_brand();
                    }else if(data == "ALREADY_EXISTS"){
                        $("#brandname").addClass("border-danger");
                        alert("It seems like you Brand is already used");

                    }

                }
            })
        }
    })

//add product
    $("#product_form").on("submit",function(){
        $.ajax({
            url : "./inc/process.php",
            method : "POST",
            data : $("#product_form").serialize(),
            success : function(data){
                if (data == "PRODUCT_ADDED") {
                    alert("New Product Added Successfully..!");
                    $("#productname").val("");
                    $("#select_cat").val("");
                    $("#select_brand").val("");
                    $("#price").val("");
                    $("#productquantity").val("");

                }else if(data == "ALREADY_EXISTS"){
                    alert("It seems like you Product is already used");
                    $("#productname").val("");
                    $("#select_cat").val("");
                    $("#select_brand").val("");
                    $("#price").val("");
                    $("#productquantity").val("");
                }
                else{
                    console.log(data);
                    alert(data);
                }

            }
        })
    });

    //----------------------------------Manage Category------------------------
    manageCategory(1);
    function manageCategory(pn){
        $.ajax({
            url : "./inc/process.php",
            method : "POST",
            data : {manageCategory:1,pageno:pn},
            success : function(data){
                $("#get_category").html(data);
            }
        })
    }

    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageCategory(pn);
    });

//DELETE CAT

    $("body").delegate(".del_cat","click",function(){
        var did = $(this).attr("did");
        if (confirm("Are you sure ? You want to delete..!")) {
            $.ajax({
                url : "./inc/process.php",
                method : "POST",
                data : {deleteCategory:1,id:did},
                success : function(data){
                    if (data == "DEPENDENT_CATEGORY") {
                        alert("Sorry ! this Category is dependent on other sub categories");
                    }else if(data == "CATEGORY_DELETED"){
                        alert("Category Deleted Successfully..! happy");
                        manageCategory(1);
                    }else if(data == "DELETED"){
                        alert("Deleted Successfully");
                    }else{
                        alert(data);
                    }

                }
            })
        }else{

        }
    });

    //Update Category
    $("body").delegate(".edit_cat","click",function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url : "./inc/process.php",
            method : "POST",
            dataType : "json",
            data : {updateCategory:1,id:eid},
            success : function(data){
                console.log(data);
                $("#cid").val(data["cid"]);
                $("#update_category").val(data["catname"]);
                $("#parent_cat").val(data["parent_cat"]);
            }
        })
    });

    $("#update_category_form").on("submit",function(){
        if ($("#update_category").val() == "") {
            $("#update_category").addClass("border-danger");
            $("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
        }else{
            $.ajax({
                url : "./inc/process.php",
                method : "POST",
                data  : $("#update_category_form").serialize(),
                success : function(data){
                    window.location.href = "";
                }
            })
        }
    });

    //----------------------------------Manage Brand------------------------
    manageBrand(1);
    function manageBrand(pn){
        $.ajax({
            url : "./inc/process.php",
            method : "POST",
            data : {manageBrand:1,pageno:pn},
            success : function(data){
                $("#get_brand").html(data);
            }
        })
    }

    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageBrand(pn);
    });

//DELETE Brand

    $("body").delegate(".del_brand","click",function(){
        var did = $(this).attr("did");
        if (confirm("Are you sure ? You want to delete..!")) {
            $.ajax({
                url : "./inc/process.php",
                method : "POST",
                data : {deleteBrand:1,id:did},
                success : function(data){
                    if (data == "DELETED") {
                        alert("Brand is deleted");
                        manageBrand(1);
                    }else{
                        alert(data);
                    }
                }
            })
        }
    });

    //Update Brand
    $("body").delegate(".edit_brand","click",function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url : "./inc/process.php",
            method : "POST",
            dataType : "json",
            data : {updateBrand:1,id:eid},
            success : function(data){
                console.log(data);
                $("#bid").val(data["bid"]);
                $("#update_brand").val(data["brandname"]);
            }
        })
    });

    $("#update_brand_form").on("submit",function(){
        if ($("#update_brand").val() == "") {
            $("#update_brand").addClass("border-danger");
            $("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
        }else{
            $.ajax({
                url : "./inc/process.php",
                method : "POST",
                data  : $("#update_brand_form").serialize(),
                success : function(data){
                    if(data == "UPDATED"){
                        alert("Updated Successfully!!");
                        window.location.href = "";
                    }else{
                        alert(data);
                    }
                }
            })
        }
    });

    //--------------------------Product---------------------------
    manageProduct(1);
    function manageProduct(pn){
        $.ajax({
            url : "./inc/process.php",
            method : "POST",
            data : {manageProduct:1,pageno:pn},
            success : function(data){
                $("#get_product").html(data);
            }
        })
    };

    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageProduct(pn);
    });

//DELETE Product

    $("body").delegate(".del_product","click",function(){
        var did = $(this).attr("did");
        if (confirm("Are you sure ? You want to delete..!")) {
            $.ajax({
                url : "./inc/process.php",
                method : "POST",
                data : {deleteProduct:1,id:did},
                success : function(data){
                    if (data == "DELETED") {
                        alert("Product is deleted");
                        manageProduct(1);
                    }else{
                        alert(data);
                    }
                }
            })
        }
    });

    //Update Product
    $("body").delegate(".edit_product","click",function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url : "./inc/process.php",
            method : "POST",
            dataType : "json",
            data : {updateProduct:1,id:eid},
            success : function(data){
                console.log(data);
                $("#pid").val(data["pid"]);
                $("#update_product").val(data["productname"]);
                $("#select_cat").val(data["cid"]);
                $("#select_brand").val(data["bid"]);
                $("#product_price").val(data["price"]);
                $("#product_qty").val(data["quantity"]);

            }
        })
    })

    $("#update_product_form").on("submit",function(){
        $.ajax({
            url : "./inc/process.php",
            method : "POST",
            data : $("#update_product_form").serialize(),
            success : function(data){
                if (data == "UPDATED") {
                    alert("Product Updated Successfully..!");
                    window.location.href = "";
                }else{
                    alert(data);
                }
            }
        })
    });

//----------------------------ORDER-------------------------
    addNewRow();

    $("#add").click(function(){
        addNewRow();
    })
    function addNewRow(){
        $.ajax({
            url : "./inc/process.php",
            method : "POST",
            data : {getNewOrderItem:1},
            success : function(data){
                $("#invoice_item").append(data);
                var n = 0;
                $(".number").each(function(){
                    $(this).html(++n);
                })
            }
        })
    };

    $("#remove").click(function(){
        $("#invoice_item").children("tr:last").remove();
        calculate(0,0);
    });
    $("#invoice_item").delegate(".pid","change",function(){
        var pid = $(this).val();
        var tr = $(this).parent().parent();
        $.ajax({
            url : "./inc/process.php",
            method : "POST",
            dataType : "json",
            data : {getPriceAndQty:1,id:pid},
            success : function(data){
                tr.find(".tqty").val(data["quantity"]);
                tr.find(".pro_name").val(data["productname"]);
                tr.find(".qty").val(1);
                tr.find(".price").val(data["price"]);
                tr.find(".amt").html( tr.find(".qty").val() * tr.find(".price").val() );
                calculate(0,0);
            }
        })
    })



    $('#invoice_item').delegate(".qty","keyup",function () {
        var qty = $(this);
        var tr = $(this).parent().parent();
        if(isNaN(qty.val())){
            alert("Please enter a valid Quantity");
            qty.val(1);
        }else {
            if ((qty.val() - 0) > (tr.find(".tqty").val()-0)) {
                alert("Sorry ! This much of quantity is not available");
                qty.val(1);
            }else {
                tr.find(".amt").html(qty.val() * tr.find(".price").val());
                calculate(0,0);
            }
        }

    });

    function calculate(dis,paid){
        var sub_total = 0;
        var gst = 0;
        var net_total = 0;
        var discount = dis;
        var paid_amt = paid;
        var due = 0;
        $(".amt").each(function(){
            sub_total = sub_total + ($(this).html() * 1);
        })
        gst = 0.18 * sub_total;

        net_total = gst + sub_total;
        net_total = net_total - discount;
//net_total = net_total.toFixed(2);
        due = net_total - paid_amt;
       // due = due.toFixed(2);
        $("#gst").val(gst);
        $("#sub_total").val(sub_total);

        $("#discount").val(discount);
        $("#net_total").val(net_total);
        //$("#paid")
        $("#due").val(due);
        if(due<0){
            alert("Negative number");
        }

    }

    $("#discount").keyup(function(){
        var discount = $(this).val();
        calculate(discount,0);
    })

    $("#paid").keyup(function(){
        var paid = $(this).val();
        var discount = $("#discount").val();
        calculate(discount,paid);
    });
    /*Order Accepting*/

    $("#order_form").click(function(){

        var invoice = $("#get_order_data").serialize();
        if ($("#cust_name").val() === "") {
            alert("Plaese enter customer name");
        }else if($("#paid").val() === ""){
            alert("Plaese eneter paid amount");
        }else{
            $.ajax({
                url : "./inc/process.php",
                method : "POST",
                data : $("#get_order_data").serialize(),
                success : function(data){

                    if (data < 0) {
                        alert(data);
                    }else{
                        $("#get_order_data").trigger("reset");

                        if (confirm("Do u want to print invoice ?")) {
                            window.location.href = "./inc/invoice_bill.php?invoice_no="+data+"&"+invoice;
                        }else{
                            alert("Ooder Completed Done!!");
                        }

                    }

                }
            });
        }

    });

    var table = $('#example').DataTable( {
        fixedHeader: true
    } );

//manage order
    manageOrder(1);
    function manageOrder(pn){
        $.ajax({
            url : "./inc/process.php",
            method : "POST",
            data : {manageOrder:1,pageno:pn},
            success : function(data){
                $("#get_order").html(data);
            }
        })
    }

    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageOrder(pn);
    });


//----------------------------


});

