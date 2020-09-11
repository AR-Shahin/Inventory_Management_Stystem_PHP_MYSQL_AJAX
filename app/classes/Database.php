<?php


namespace App\classes;
class Database
{
    public static function db()
    {
        $link = mysqli_connect('localhost:3307','root','','inventory');
        return $link;
    }
    public static function connect($sql){
        $res = mysqli_query(self::db(),$sql);
        if($res){
            return $res;
        }else{
            return false;
        }
    }
    public static function select($sql){
        $res = mysqli_query(self::db(),$sql);
        if($res){
            $row = mysqli_num_rows($res);
            if($row == 0)
            {
                return 0;
            }else{
                return $row;
            }
        }else{
            return false;
        }
    }
public static function test(){
        echo 'test';
}
}