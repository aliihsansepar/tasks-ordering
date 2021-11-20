<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Amount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable= ['task_id', 'currency', 'amount'];
    protected $table = 'amounts';
    public $timestamps = true;
}
