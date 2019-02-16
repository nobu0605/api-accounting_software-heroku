<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Journal;


class JournalController extends Controller
{
    private $validation = array(
        'date' => 'required',
        'debit' => 'required|max:20',
        'debit_sub_account' => 'max:20',
        'credit' => 'required|max:20',
        'credit_sub_account' => 'max:20',
        'amount' => 'required',
        'remark' => 'max:20',
        'user_id' => 'required',
    );

    private function requestData($journal,$request){
        $journal->date = $request->date;
        $journal->debit = $request->debit;
        $journal->debit_sub_account = $request->debit_sub_account;
        $journal->credit = $request->credit;
        $journal->credit_sub_account = $request->credit_sub_account;
        $journal->amount = $request->amount;
        $journal->remark = $request->remark;
        $journal->user_id = $request->user_id;
        return $journal;
    }

    function index(){
        $journals = Journal::all();
        return response()->json($journals);
    }

    function exportCSV()
    {
        $journals = Journal::all();
        $csvExporter = new \Laracsv\Export();

        $headers = array(
            'Content-Type' => 'text/csv'
        );
        $name = "users.csv";
        return response($csvExporter->build($journals, ['id', 'date', 'debit', 'debit_sub_account', 'credit', 'credit_sub_account', 'amount', 'remark', 'user_id', 'created_at', 'updated_at'])->getCsv());
    }

    function store(Request $request){
        $this->validate($request, $this->validation);
        $journal = new Journal();
        $this->requestData($journal,$request);
        $journal->save();
        return response()->json();
    }

    function show(Request $request, $id){
        $journal = Journal::find($id);
        return response()->json($journal);
    }

    function update(Request $request, $id){
        $this->validate($request, $this->validation);
        $journal = Journal::find($id);
        $this->requestData($journal,$request);
        $journal->save();
        return response()->json();
    }

    function destroy(Request $request, $id){
        $journal = Journal::find($id);
        $journal->delete();
        return response()->json();
    }

}
