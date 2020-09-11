<?php

namespace App\classes;

use App\classes\Database;
use App\classes\Helper;
use App\classes\Session;
Session::init();

class User
{
    public static function doubleMailCheck($email){
        $sql = "SELECT * FROM `user` WHERE  `email` = '$email'";
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
    public static function createUserAccount($username,$email,$password,$usertype){
        if(self::doubleMailCheck($email) == false) {
            return "EMAIL_ALREADY_EXISTS";
        }else{
            #$pass_hash = password_hash($password,PASSWORD_DEFAULT);
            $pass_hash = md5($password);
            $date = date("Y-m-d");
            $notes = "";
            $username = Helper::filter($username);
            $email = Helper::filter($email);
            $sql = "INSERT INTO `user`(`username`, `email`, `password`, `usertype`, `reg-date`, `last-login`, `notes`) VALUES ('$username','$email','$pass_hash','$usertype','$date','$date','$notes')";
            $result = Database::connect($sql);
            if ($result) {
                return "INSERTED";
            }else{
                return "SOME_ERROR";
            }
        }
    }

    public static function userLogin($email,$password){
        $email = Helper::filter($email);
        $password = Helper::filter($password);
        $sql = "SELECT * FROM `user` WHERE `email` = '$email'";
        $res = Database::connect($sql);
        if($res != false){
            $row = mysqli_num_rows($res);
            if($row == 0)
            {
                return "NOT_REGISTERD";
            }else{
                $data = $res->fetch_assoc();
                $pass =  $data['password'];
                #echo  $pass_hash = password_hash($password,PASSWORD_DEFAULT);
                $pass_hash = md5($password);
                if($pass_hash == $pass){
                    $uid = $data['id'];
                    $uname = $data['username'];
                    $role = $data['usertype'];
                    $last_login= $data['last-login'];
                    Session::set('UserId',$uid);
                    Session::set('UserTime',$last_login);
                    Session::set('UserName',"$uname");
                    Session::set('UserType',"$role");
                    $_SESSION['loginSuccess'] = true;
                    date_default_timezone_set('Asia/Dhaka');
                    $date =  date("Y-m-d h:i:s");
                    self::changeLoginTime($date,$uid);
                    return "REGISTERD";
                }else{
                    return "PASSWORD_NOT_MATCHED";
                }
            }
        }else{
            return 'SOMETHING_WRONG';
        }
    }
    public static function changeLoginTime($date,$id){
        $sql = "UPDATE `user` SET `last-login` = '$date' WHERE `id` = '$id' ";
        $res = Database::connect($sql);
    }
}
