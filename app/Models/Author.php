<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Author extends User
{
    use HasFactory;
    public $auloc;
    public $auwebs;
    public $auimgfr;
    public $aupermal;
    public $autitle;
    public $audesc;
    public $audonl;
    private $auid;
    public function insertion(){
        $this->auid = $this->genId();
        
        if(DB::insert('insert into tb_author values(?,?,?,?,?,?,?,?)',[$this->auid,$this->auloc,$this->auimgfr,$this->audesc,$this->auwebs,$this->audonl,$this->aupermal,$this->usid]) == 1){
            return DB::insert('insert into author_title values(?,?)',[$this->auid,$this->autitle]);
        }

    }
    public static function getDataById($id){
        $selQuery = 'SELECT * FROM tb_author WHERE auidus = ?';
        $select = DB::select($selQuery,[$id]);
        return $select[0];
    }
}
