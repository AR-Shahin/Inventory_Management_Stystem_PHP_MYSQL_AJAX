<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 9/7/2020
 * Time: 8:20 PM
 */

namespace App\classes;
#require_once '../../vendor/autoload.php';
use App\classes\Database;
include 'Database.php';

class Manage
{
    private $con;

    function __construct()
    {
        $db = new Database();
        $this->con = $db->db();
    }
    public function manageRecordWithPagination($table,$pno){
        # $a = self::pagination($this->con,$table,$pno,5);
        $a = $this->pagination($table,$pno,10);
        if ($table == "categories") {
            $sql = "SELECT p.cid,p.catname as category, c.catname as parent, p.status FROM categories p LEFT JOIN categories c ON p.parent_cat=c.cid ORDER BY cid DESC ".$a["limit"];
        }else if($table == "products"){
            $sql = "SELECT p.pid,p.productname,c.catname,b.brandname,p.price,p.quantity,p.added_date,p.status FROM products p,brands b,categories c WHERE p.bid = b.bid AND p.cid = c.cid ".$a["limit"];
        }else{
            $sql = "SELECT * FROM ".$table."  "."ORDER BY bid DESC". "  ".$a["limit"];
        }
        #$result = Database::connect($sql);
        $result = $this->con->query($sql) or die($this->con->error);
        $rows = array();
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return ["rows"=>$rows,"pagination"=>$a["pagination"]];
    }

    public function pagination($table,$pno,$n){
        $sql = "SELECT COUNT(*) as 'rows' FROM $table";
        $query = Database::connect($sql);
        # $query = $con->query("SELECT COUNT(*) as rows FROM ".$table);
        $row = mysqli_fetch_assoc($query);
        //$totalRecords = 100000;
        $pageno = $pno;
        $numberOfRecordsPerPage = $n;

        $last = ceil($row["rows"]/$numberOfRecordsPerPage);

        $pagination = "<ul class='pagination'>";

        if ($last != 1) {
            if ($pageno > 1) {
                $previous = "";
                $previous = $pageno - 1;
                $pagination .= "<li class='page-item'><a class='page-link' pn='".$previous."' href='#' style='color:#333;'> Previous </a></li></li>";
            }
            for($i=$pageno - 5;$i< $pageno ;$i++){
                if ($i > 0) {
                    $pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
                }

            }
            $pagination .= "<li class='page-item'><a class='page-link' pn='".$pageno."' href='#' style='color:#333;'> $pageno </a></li>";
            for ($i=$pageno + 1; $i <= $last; $i++) {
                $pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
                if ($i > $pageno + 4) {
                    break;
                }
            }
            if ($last > $pageno) {
                $next = $pageno + 1;
                $pagination .= "<li class='page-item'><a class='page-link' pn='".$next."' href='#' style='color:#333;'> Next </a></li></ul>";
            }
        }
        //LIMIT 0,10
        //LIMIT 20,10
        $limit = "LIMIT ".($pageno - 1) * $numberOfRecordsPerPage.",".$numberOfRecordsPerPage;

        return ["pagination"=>$pagination,"limit"=>$limit];
    }

    public  function getAllData($table,$id,$sort){
        $sql = "SELECT * FROM `$table` ORDER BY`$id` $sort ";
        # $res = Database::connect($sql);
        $res = $this->con->query($sql);
        if($res != false){
            $count = mysqli_num_rows($res);
            if($count == 0){
                return "NO_DATA_FOUNDED";
            }else{
                $rows = array();
                while($row = $res->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
        }

    }

    public function deleteRecord($table,$pk,$id){
        if($table == "categories"){

           # $pre_stmt = $this->con->prepare("SELECT ".$id." FROM categories WHERE parent_cat = ?");
          #  $pre_stmt->bind_param("i",$id);
          #  $pre_stmt->execute();
          #  $result = $pre_stmt->get_result() or die($this->con->error);
            $sql = "SELECT ".$id." FROM categories WHERE parent_cat = ".$id ."";
            $result = $this->con->query($sql);
            if ($result->num_rows > 0) {
                return "DEPENDENT_CATEGORY";
            }else{
                $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
                $pre_stmt->bind_param("i",$id);
                $result = $pre_stmt->execute() or die($this->con->error);
                if ($result) {
                    return "CATEGORY_DELETED";
                }
            }
        }else{
            $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
            $pre_stmt->bind_param("i",$id);
            $result = $pre_stmt->execute() or die($this->con->error);
            if ($result) {
                return "DELETED";
            }
        }
    }

    public function getSingleData($table,$pk,$id){
        $sql = "SELECT * FROM $table WHERE $pk = $id";
        $res = $this->con->query($sql);
        if($res->num_rows == 1){
            $row = $res->fetch_assoc();
        }
        return $row;
    }
    public function update_record($table,$where,$fields){
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            // id = '5' AND m_name = 'something'
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        foreach ($fields as $key => $value) {
            //UPDATE table SET m_name = '' , qty = '' WHERE id = '';
            $sql .= $key . "='".$value."', ";
        }
        $sql = substr($sql, 0,-2);
        $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
        if(mysqli_query($this->con,$sql)){
            return "UPDATED";
        }else{
            return "NOT UPDATED";
        }
    }

    public function storeCustomerOrderInvoice($orderdate,$cust_name,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type){
        $pre_stmt = $this->con->prepare("INSERT INTO 
			`invoice`(`customer_name`, `order_date`, `sub_total`,
			 `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`) VALUES (?,?,?,?,?,?,?,?,?)");
        $pre_stmt->bind_param("ssdddddds",$cust_name,$orderdate,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);
        $pre_stmt->execute() or die($this->con->error);
        $invoice_no = $pre_stmt->insert_id;
        if ($invoice_no != null) {
            for ($i=0; $i < count($ar_price) ; $i++) {

                //Here we are finding the remaing quantity after giving customer
                $rem_qty = $ar_tqty[$i] - $ar_qty[$i];
                if ($rem_qty < 0) {
                    return "ORDER_FAIL_TO_COMPLETE";
                }else{
                    //Update Product stock
                    $sql = "UPDATE products SET quantity = '$rem_qty' WHERE productname = '".$ar_pro_name[$i]."'";
                    $this->con->query($sql);
                }


                $insert_product = $this->con->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`)
				 VALUES (?,?,?,?)");
                $insert_product->bind_param("isdd",$invoice_no,$ar_pro_name[$i],$ar_price[$i],$ar_qty[$i]);
                $insert_product->execute() or die($this->con->error);
            }

            return $invoice_no;
        }



    }
}
//$obj = new Manage();
////echo $obj->deleteRecord("categories","cid",3);
//print_r($obj->getSingleData('categories','cid',2));