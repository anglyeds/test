<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    public $fillable = ['name','display_name','description'];

}