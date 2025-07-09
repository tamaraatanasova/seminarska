<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AccessLog;

class AccessControlController extends Controller
{
    public function checkAccess(Request $request)
    {
        // Проверка на RFID ID од барање
        $rfidId = $request->input('rfid_id');

        // Проверка дали RFID ID-то е во базата
        $user = User::where('rfid_id', $rfidId)->first();

        if ($user) {
            // Запишување на лог за пристап
            AccessLog::create([
                'user_id' => $user->id,
                'access_granted' => true
            ]);
            
            // Испрати email или SMS известување
            // send_email($user->email, "Access granted", "You have been granted access.");
            return response()->json(['status' => 'Access granted'], 200);
        } else {
            // Запишување на неуспешен обид
            AccessLog::create([
                'rfid_id' => $rfidId,
                'access_granted' => false
            ]);
            
            // Испрати известување за неважечка картичка
            // send_email('admin_email@example.com', 'Invalid RFID Access Attempt', "RFID ID: $rfidId");
            return response()->json(['status' => 'Access denied'], 403);
        }
    }
}

