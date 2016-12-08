<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    public $fillable = ['name','display_name','description'];

}