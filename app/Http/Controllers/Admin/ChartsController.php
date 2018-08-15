<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Income;
use App\Expense;
use Illuminate\Support\Facades\Auth;
class ChartsController extends Controller
{
    public function index()
    {
        if (! Gate::allows('chart_access')) {
            return abort(401);
        }


        $incomeChart = Income::select('amount','entry_date')->get();
        $expenseChart = Expense::select('amount','entry_date')->get();

        $yourIncome = Income::select('amount','entry_date')->where('branch_id',Auth::user()->id)->get(); 
        $yourExpense =Expense::select('amount','entry_date')->where('branch_id',Auth::user()->id)->get();

        return view('admin.charts.index',compact(
            'yourIncome','yourExpense',
            'incomeChart','expenseChart'));
    }
}
