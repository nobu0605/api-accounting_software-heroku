<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Journal;
use App\Account;

class AmountController extends Controller
{
    public function index()
    {
        $journalsDebit = Journal::leftjoin('accounts','journals.debit','=','accounts.id')
        ->selectRaw('SUM(amount) as total,amount,accounts.*')
        ->groupBy('journals.debit')
        ->get();

        $originJournalsDebit = $journalsDebit;
        $journalsDebit = array_column($journalsDebit->toArray(), null, 'account');

        $journalsCredit = Journal::leftjoin('accounts','journals.credit','=','accounts.id')
        ->selectRaw('SUM(amount) as total,amount,accounts.*')
        ->groupBy('journals.credit')
        ->get();

        $originJournalsCredit = $journalsCredit;
        $journalsCredit = array_column($journalsCredit->toArray(), null, 'account');

        return response()->json([
                'journalsDebit' => $journalsDebit,
                'journalsCredit' => $journalsCredit,
                'originJournalsDebit' => $originJournalsDebit,
                'originJournalsCredit' => $originJournalsCredit
            ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
