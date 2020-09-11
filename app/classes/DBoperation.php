<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 9/6/2020
 * Time: 2:08 PM
 */

namespace App\classes;
#require_once '../../vendor/autoload.php';
use App\classes\Database;
use App\classes\Helper;
class DBoperation
{
    public static function checkDoubleElements($table,$field,$element){
        $sql = "SELECT * FROM `$table` WHERE  `$field` = '$element'";
        $result = mysqli_query(Database::db(),$sql);
        if($result){
            $row = mysqli_num_rows($result);
            if($row == 0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function getAllData($table,$id,$sort){
        $sql = "SELECT * FROM `$table` ORDER BY`$id` $sort ";
        $res = Database::connect($sql);
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
    public static function getData($table){
        $sql = "SELECT * FROM `$table` ";
        $res = Database::connect($sql);
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

    public static function addCategory($parent,$cat){
        $catname = Helper::filter($cat);
        $status = 1;
        if(self::checkDoubleElements('categories','catname',$catname) == false){
            return "ALREADY_EXISTS";
            die();
        }else {
            $sql = "INSERT INTO `categories`(`catname`, `parent_cat`, `status`) VALUES ('$catname','$parent','$status')";
            $res = Database::connect($sql);
            if($res!=false){
                return "CATEGORY_ADDED";
            }else{
                return "SOMETHING_WRONG";
            }
        }
    }
    public static function addNewBrand($brandname){
        $catname = Helper::filter($brandname);
        $status = 1;
        if(self::checkDoubleElements('brands','brandname',$brandname) == false){
            return "ALREADY_EXISTS";
            die();
        }else {
            $sql = "INSERT INTO `brands`( `brandname`, `status`) VALUES ('$brandname','$status')";
            $res = Database::connect($sql);
            if($res!=false){
                return "BRAND_ADDED";
            }else{
                return "SOMETHING_WRONG";
            }
        }
    }
    public static function addNewProduct($productname,$cid,$bid,$price,$quantity,$date){
        $catname = Helper::filter($productname);
        $status = 1;
        if(self::checkDoubleElements('products','productname',$productname) == false){
            return "ALREADY_EXISTS";
            die();
        }else {

            $sql = "INSERT INTO `products`( `cid`, `bid`, `productname`, `price`, `quantity`, `added_date`, `status`) VALUES ('$cid','$bid','$productname','$price','$quantity','$date','$status')";
            $res = Database::connect($sql);
            if($res!=false){
                return "PRODUCT_ADDED";
            }else{
                return "SOMETHING_WRONG";
            }
        }
    }
}
