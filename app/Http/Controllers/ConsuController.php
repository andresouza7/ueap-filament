<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CommissionedRole;
use App\Models\ConsuAta;
use App\Models\ConsuResolution;
use App\Models\Portaria;
use App\Models\Group;
use App\Models\TransparencyBid;
use App\Models\TransparencyOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsuController extends Controller
{
    #################################
    ## CONSU
    #################################
    public function listOrdinance(Request $request)
    {
        $query = Portaria::where('origin','CONSU')->orderBy('year', 'DESC')->orderBy('number', 'DESC');

        if($request->name){
            $request->validate(['name' => 'string|max:255']);
            $query
            ->where('description', 'ilike', "%$request->name%");
        }

        if($request->number){
            $request->validate(['number' => 'integer']);
            $query->where('number',  $request->number);
        }

        if($request->year){
            $request->validate(['year' => 'integer']);
            $query->where('year',  $request->year);
        }

        $ordinances = $query->paginate(25)->withQueryString();

        return view('site.pages.consu-ordinance-list', compact('ordinances'));
    }

    public function listResolution(Request $request)
    {
        $query = ConsuResolution::orderBy('year', 'DESC')->orderBy('number', 'DESC');

        if($request->name){
            $request->validate(['name' => 'string|max:255']);
            $query->where('name', 'ilike', "%$request->name%");
        }

        if($request->number){
            $request->validate(['number' => 'integer']);
            $query->where('number',  $request->number);
        }

        if($request->year){
            $request->validate(['year' => 'integer']);
            $query->where('year',  $request->year);
        }

        $resolutions = $query->paginate(25)->withQueryString();
        return view('site.pages.resolution-list', compact('resolutions'));
    }

    public function listAta(Request $request)
    {
        $query = ConsuAta::orderBy('issuance_date', 'DESC')->orderBy('id', 'DESC');

        if($request->name){
            $query->where('title', 'ilike', "%$request->name%");
        }

        if($request->issuer){
            $query->where('issuer', 'ilike', "%$request->issuer%");
        }

        $atas = $query->paginate(25)->withQueryString();
        return view('site.pages.ata-list', compact('atas'));
    }
}
