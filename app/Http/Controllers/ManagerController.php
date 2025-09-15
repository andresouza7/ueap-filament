<?php

namespace App\Http\Controllers;

use App\Models\CalendarOccurrence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function frequencyPrint(Request $request)
    {
        // dd($request->all());

        if ($request->uuid) {
            $user = User::where('uuid', $request->uuid)->first();
        } else {
            $user = auth()->user();
        }


        if (isset($request->type) and ($request->type == 'effective_role' or $request->type == 'commissioned_role')) {
            $type = $request->type;
        } else {
            $type = 'effective_role';
        }

        if (isset($request->month)) {
            if (is_numeric($request->month) and $request->month >= 1 and $request->month <= 12) {
                $month = $request->month;
                if ($request->year) {
                    $year = $request->year;
                } else {
                    $year = date("Y");
                }
            } else {
            }
        } else {
            $month = date("m");
            $year = date("Y");
        }

        $occurrences = CalendarOccurrence::where('type', 3)->where('user_id', $user->id)->orWhere('type', 1)->get();
        $occurrences_user = CalendarOccurrence::where('type', 2)->where('user_id', $user->id)->get();

        // Quebrando o nome de usuário em nome e sobrenome
        $parts = explode(".", $user->login);
        $firstName = $parts[0];
        $lastName = $parts[1];

        // Formatando o nome do arquivo
        $filename = "fp_" . $month . "_{$year}_{$firstName}_{$lastName}";

        return view('manager.frequency-print', compact('user', 'month', 'year', 'type', 'occurrences', 'occurrences_user', 'filename'));
    }

    public function completeTutorial(Request $request) {
        $user = $request->user();

        $user->skip_tutorial = true;
        $user->save();
    }
}
