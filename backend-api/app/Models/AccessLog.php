<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    use HasFactory;

    // Определувај ја табелата (ако не е "access_logs")
    protected $table = 'access_logs';

    // Определувај кои колони се дозволени за масовно пополнување
    protected $fillable = [
        'user_id',
        'access_granted'
    ];

    // Дефинирај ја релацијата со User (многу-до-едно)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
