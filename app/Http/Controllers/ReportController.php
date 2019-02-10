<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Journal;
use App\Account;

class ReportController extends Controller
{
    public function index()
    {
        // 各区分の合計金額を集計
        function getAmount($selectYear,$type,$debitCredit){
            $amount = 0;
            $amount =
            (int)Journal::leftjoin('accounts',$debitCredit,'=','accounts.id')
            ->select('accounts.*','amount')
            ->where('type', $type)
            ->where('date','LIKE', "%{$selectYear}%")
            ->sum("amount");
            return $amount;
        }

        // 資産の部
        $currentAssets = getAmount('','流動資産','journals.debit');
        $fixedAssets = getAmount('','固定資産','journals.debit');

        $AssetsAllAmount = $currentAssets + $fixedAssets;
        $CAPercent = $currentAssets / $AssetsAllAmount;
        $FAPercent = $fixedAssets / $AssetsAllAmount;

        // 負債、純資産の部
        $currentLiabilities = getAmount('','流動負債','journals.credit');
        $fixedLiabilities = getAmount('','固定負債','journals.credit');
        $equity = getAmount('','純資産','journals.credit');

        $allAmount = $currentLiabilities + $fixedLiabilities + $equity;
        $CLPercent = $currentLiabilities / $allAmount;
        $FLPercent = $fixedLiabilities / $allAmount;
        $EPercent = $equity / $allAmount;

        // 損益
        function PLAmountGet($year = ""){
            $sales = getAmount($year,'売上高','journals.credit');
            $costOfSales = getAmount($year,'売上原価','journals.debit');
            $salesAdminExpense = getAmount($year,'販管費','journals.debit');
            $otherIncome = getAmount($year,'営業外収益','journals.credit');
            $otherExpenses = getAmount($year,'営業外費用','journals.debit');
            $extraIncome = getAmount($year,'特別利益','journals.credit');
            $extraLoss = getAmount($year,'特別損失','journals.debit');
            $corporateTax = getAmount($year,'法人税等','journals.debit');

            $salesProfit = $sales - $costOfSales - $salesAdminExpense;
            $SPPercent = $salesProfit / ($sales == 0 ? 1 : $sales);
            $COSPercent = $costOfSales / ($sales == 0 ? 1 : $sales);
            $SAEPercent = $salesAdminExpense / ($sales == 0 ? 1 : $sales);

            $amountArray = [
                $sales,
                $costOfSales,
                $salesAdminExpense,
                $salesProfit,
                $SPPercent,
                $COSPercent,
                $SAEPercent,
                $extraIncome,
                $extraLoss,
                $corporateTax,
                $otherIncome,
                $otherExpenses
            ];
            return $amountArray;
        }

        list(
            $sales,
            $costOfSales,
            $salesAdminExpense,
            ,
            $SPPercent,
            $COSPercent,
            $SAEPercent,
            $extraIncome,
            $extraLoss,
            $corporateTax,
            $otherIncome,
            $otherExpenses
        ) = PLAmountGet();

        list(
            $sales2015,
            $costOfSales2015,
            $salesAdminExpense2015,
            $salesProfit2015
        ) = PLAmountGet(2015);

        list(
            $sales2016,
            $costOfSales2016,
            $salesAdminExpense2016,
            $salesProfit2016
        ) = PLAmountGet(2016);

        list(
            $sales2017,
            $costOfSales2017,
            $salesAdminExpense2017,
            $salesProfit2017
        ) = PLAmountGet(2017);

        list(
            $sales2018,
            $costOfSales2018,
            $salesAdminExpense2018,
            $salesProfit2018
        ) = PLAmountGet(2018);

        return response()->json([
                'CLPercent' => $CLPercent,
                'FLPercent' => $FLPercent,
                'EPercent' => $EPercent,
                'CAPercent' => $CAPercent,
                'FAPercent' => $FAPercent,
                'SPPercent' => $SPPercent,
                'COSPercent' => $COSPercent,
                'SAEPercent' => $SAEPercent,
                'sales2015' => $sales2015,
                'costOfSales2015' => $costOfSales2015,
                'salesAdminExpense2015' => $salesAdminExpense2015,
                'salesProfit2015' => $salesProfit2015,
                'sales2016' => $sales2016,
                'costOfSales2016' => $costOfSales2016,
                'salesAdminExpense2016' => $salesAdminExpense2016,
                'salesProfit2016' => $salesProfit2016,
                'sales2017' => $sales2017,
                'costOfSales2017' => $costOfSales2017,
                'salesAdminExpense2017' => $salesAdminExpense2017,
                'salesProfit2017' => $salesProfit2017,
                'sales2018' => $sales2018,
                'costOfSales2018' => $costOfSales2018,
                'salesAdminExpense2018' => $salesAdminExpense2018,
                'salesProfit2018' => $salesProfit2018,
                'sales' => $sales,
                'costOfSales' => $costOfSales,
                'salesAdminExpense' => $salesAdminExpense,
                'extraIncome' => $extraIncome,
                'extraLoss' => $extraLoss,
                'corporateTax' => $corporateTax,
                'otherIncome' => $otherIncome,
                'otherExpenses' => $otherExpenses
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
