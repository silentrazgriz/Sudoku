<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
	protected $table = 'scores';
  public $primaryKey = 'id';
  public $fillable = ['name', 'seconds'];
  public $hidden = ['id', 'created_at', 'updated_at'];
	public $timestamps = true;
}
