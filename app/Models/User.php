<?php

namespace App\Models;
use DB;
use DateTime;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public $usname;
    public $usmail;
    public $usnamepro;
    public $usimgpro;
    public $algo;
    public $cost;
    private $hash;
    private $usid;

    public function genId($size=12)
    {
        $id = "";
        $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsetSize = strlen($charset);
        for ($i=0; $i < $size; $i++) { 
            $id .= $charset[rand(0, $charsetSize - 1)];
        }
        return $id;
    }
    public function isDuplicated(){
        $count = DB::select('select count(*) as total from tb_user where usmail = ? or usname = ?',[$this->usmail,$this->usname]);
        if($count[0]->total>0){
            return true;
        }
        return false;
    }
    public function login($psswd){
        $info = [0,array()];
        $count = DB::select('select count(*) as total from tb_user where usmail = ? or usname = ?',[$this->usmail,$this->usname]);
        if($count[0]->total==1){
            $select = DB::select('select * from tb_user where usmail = ? or usname = ?',[$this->usmail,$this->usname]);
            if(Hash::check($psswd,$select[0]->hash)) {
                $info[1] = $select[0];
                $info[0] = $select[0]->ustype;
            }
        }
        return $info;
    }
    static public function follow($to,$from){
        $insert = 0;
        $count = DB::select('select count(*) as total from follow where toUser = ? and fromUser = ?',[$to,$from]);
        if($count[0]->total==0){
            $now = new DateTime();
            $insert = DB::insert('insert into follow values(?,?,?)',[$to,$from,$now]);
        }
        return $insert;
    }
}
