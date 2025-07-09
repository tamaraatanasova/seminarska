<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // Определувај ја табелата (ако не е "users")
    protected $table = 'users';

    // Определувај кои колони се дозволени за масовно пополнување (mass assignment)
    protected $fillable = [
        'rfid_id',
        'email',
        'phone_number'
    ];

    // Дефинирај ја релацијата со AccessLog (1-до-многу)
    public function accessLogs()
    {
        return $this->hasMany(AccessLog::class);
    }
}
