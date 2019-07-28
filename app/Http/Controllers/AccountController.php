<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Journal;

class AccountController extends Controller
{

    private $storeValidation = array(
        'account' => 'required|unique:accounts|max:20',
        'type' => 'required'
    );

    public function index()
    {
        $accounts = Account::all();
        return response()->json($accounts);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->storeValidation);
        $account = new Account();
        $account->account = $request->account;
        $account->type = $request->type;
        $account->save();
        return response()->json();
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

    function destroy(Request $request, $id)
    {
        $account = Account::find($id);
        $journals = new journal();
        $debit = $journals->where('debit', $account->id)->get();
        $credit = $journals->where('credit', $account->id)->get();

        if ($debit->count() or $credit->count()) {
            return response()->json('この勘定科目は仕訳で使用されているので削除できません。');
        }
        $account->delete();
        return response()->json();
    }
}
