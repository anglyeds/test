<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public $fillable = ['name','display_name','description'];

}