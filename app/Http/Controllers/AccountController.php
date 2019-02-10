<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

class AccountController extends Controller
{
    private $validation = array(
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
        $this->validate($request, $this->validation);
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

    function destroy(Request $request, $id){
        $account = Account::find($id);
        $account->delete();
        return response()->json();
    }
}
