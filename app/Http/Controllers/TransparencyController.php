<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\CommissionedRole;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Group;
use App\Models\Orcamento;
use App\Models\TransparencyBid;
use App\Models\TransparencyOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransparencyController extends Controller
{


    #################################
    ## INFORMAÇÔES
    #################################

    public function home()
    {
        return view('transparency.pages.home');
    }


    public function navigation()
    {
        return view('transparency.pages.navigation');
    }




    #########################################
    ## Institucional
    ##########################################

    public function institutional()
    {
        return view('transparency.pages.institutional');
    }

    public function organization()
    {
        $groups = Group::with('users')
            ->where('group_parent_id', '<', 1)->orWhere('group_parent_id', null)
            ->where('description', '<>', '-')->orderBy('description')->get();

        return view('transparency.pages.organization', compact('groups'));
    }


    public function listEffectiveRoles()
    {
        $groups = Group::with('users')->where('description', '<>', '-')->orderBy('description')->paginate(10);

        return view('transparency.pages.effective-roles-list', compact('groups'));
    }

    public function listCommissionedRoles()
    {
        $commisioned_roles = CommissionedRole::orderBy('position')->paginate(25);
        return view('transparency.pages.commissioned-roles-list', compact('commisioned_roles'));
    }

    #########################################
    ## Execução Orçamentária e Finanças
    ##########################################
    public function listOrder($type)
    {
        if ($type == 'income' or $type == 'expense' or $type == 'expense_details') {
            $orders = TransparencyOrder::where('type', $type)->paginate(25)->withQueryString();
            return view('transparency.pages.order-list', compact('type', 'orders'));
        }
        return redirect()->route('transparency.home');
    }

    public function listQuadroDespesas()
    {
        $type = 'qdd';
        $years = Orcamento::where('type', $type)
            ->select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        return view('transparency.pages.quadro-despesas.list', compact('years', 'type'));
    }

    public function showQuadroDespesasMes($ano)
    {
        $type = 'qdd';
        $orders = Orcamento::where('type', $type)->where('year', $ano)
            ->orderBy('month')->paginate(25)->withQueryString();
        return view('transparency.pages.quadro-despesas.show', compact('orders', 'type', 'ano'));
    }

    public function listDotacoes()
    {
        $type = 'dotacao';
        $years = Orcamento::where('type', $type)
            ->selectRaw('year, SUM(value) as total')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
        return view('transparency.pages.dotacoes-orcamentarias.list', compact('years', 'type'));
    }

    public function showDotacoes($ano)
    {
        $type = 'dotacao';
        $orders = Orcamento::where('type', $type)->paginate(25)->withQueryString();
        return view('transparency.pages.dotacoes-orcamentarias.show', compact('orders', 'type', 'ano'));
    }

    public function listPayRoll()
    {
        return view('transparency.pages.payroll-list');
    }

    public function listAgreement()
    {
        return view('transparency.pages.agreement-list');
    }

    public function listStudentAssistance()
    {
        return view('transparency.pages.student-assistance-list');
    }



    public function audit()
    {
        return view('transparency.pages.audit');
    }


    #################################
    ## DOCUMENTOS
    #################################
    public function documentList(Request $request, $type)
    {
        $year = $request->year;

        $category = DocumentCategory::where('slug', $type)->first();

        $check = new DocumentController();

        if ($check->checkType($type)) {
            $documents = Document::where('type', $type)
                ->when($year, function ($query, $year) {
                    return $query->where('year', $year);
                })
                ->orderBy('year', 'DESC')
                ->paginate(25)
                ->withQueryString();
            
            if ($type === 'ppa') {
                return view('transparency.pages.ppa-list', compact('documents', 'type', 'year', 'category'));
            }

            return view('transparency.pages.document-list', compact('documents', 'type', 'year', 'category'));
        }

        return redirect()->route('transparency.home');
    }

    #################################
    ## LICITAÇÃO E CONTRATO
    #################################

    public function listBid()
    {
        $bids = TransparencyBid::where('type', 'licitacao')->latest('year')->latest('number')->paginate(25)->withQueryString();
        return view('transparency.pages.bid-list', compact('bids'));
    }

    public function showBid($uuid)
    {
        $bid = TransparencyBid::where('type', 'licitacao')->where('uuid', $uuid)->first();
        return view('transparency.pages.bid-show', compact('bid'));
    }

    public function listContract($person, Request $request)
    {

        if ($request->year) {

            $year = $request->year;
        } else {
            $year = date('Y');
        }

        $bids = TransparencyBid::where('type', 'contrato')->where('person_type', $person)->where('year', $year)->orderByDesc('year')->orderByDesc('number')->paginate(25)->withQueryString();
        return view('transparency.pages.contract-list', compact('year', 'bids'));
    }

    public function showContract($uuid)
    {
        $bid = TransparencyBid::where('type', 'contrato')->where('uuid', $uuid)->first();
        return view('transparency.pages.contract-show', compact('bid'));
    }


    public function listPriceRecord()
    {

        $bids = TransparencyBid::where('type', 'ata')->paginate(25)->withQueryString();
        return view('transparency.pages.price-record-list', compact('bids'));
    }


    public function showPriceRecord($uuid)
    {
        $bid = TransparencyBid::where('type', 'ata')->where('uuid', $uuid)->first();
        return view('transparency.pages.price-record-show', compact('bid'));
    }

    #################################
    ## CONSU
    #################################
    public function listCalendar()
    {
        return view('transparency.pages.calendar-list');
    }

    public function listResolution()
    {
        return view('transparency.pages.resolution-list');
    }

    public function listAta()
    {
        return view('transparency.pages.ata-list');
    }
}
