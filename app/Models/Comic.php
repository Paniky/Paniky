<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;
    public $id = "";
    public $title = "";
    public $state = 0;
    public $description = "";
    public $emitionType = 0;
    public $emitionKind = 0;
    public $nextDate = "";
    public $authors = array();
    public function genId($size=12){
        $id = "";
        $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsetSize = strlen($charset);
        for ($i=0; $i < $size; $i++) { 
            $id .= $charset[rand(0, $charsetSize - 1)];
        }
        return $id;
    }
}
