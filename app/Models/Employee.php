<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Static Configuration
    |--------------------------------------------------------------------------
    */
    protected $table = 'employees';
    protected $primaryKey = 'id';
    public $timestamps = false;
    /*
    |--------------------------------------------------------------------------
    | Attribute
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'name',
        'salary'
    ];

    public function Overtime()
    {
        return $this->hasMany(Overtime::class, 'employee_id', 'id');
    }
}
