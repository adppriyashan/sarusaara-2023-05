<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Farmer extends Model
{
    use HasFactory;

    public static $status = [1 => 'Active', 2 => 'Inactive', 3 => 'Deleted'];

    protected $fillable = ['name', 'img', 'nic', 'address', 'note', 'status'];

    public static function getData($getActiveOnly = false)
    {
        return self::whereIn('status', ($getActiveOnly) ? [1] : [1, 2]);
    }

    protected function img(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => asset('assets/img/uploads/' . $value),
        );
    }
}
