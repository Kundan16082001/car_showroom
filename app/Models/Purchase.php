<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'car_id',
        'test_drive_id',
        'purchase_date',
        'amount',
        'payment_status',
    ];


    //add relationship realated to car users and testdrives model

    public function user()
    {
        return $this ->belongsTo(User::class);
    }

    public function car()
    {
        return $this ->belongsTo(Car::class);
    }

    public function testdrives()
    {
        return $this ->belongsTo(TestDrive::class);
    }
}
