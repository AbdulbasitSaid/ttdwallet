<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\UserAction;
use App\Income;
use App\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $date)
    {
       
        
        $useractions = \App\UserAction::latest()->limit(10)->get(); 
        $incomes = Income::latest()->limit(30)->get(); 
        $expenses = Expense::latest()->limit(30)->get(); 
        $today = date('Y-m-d');
;
        $format = 'Y-m-d';
        
        $from  = $date->query('d',Carbon::now());
       $d_date = date($format, strtotime($from));;
       

        $exp_q = Expense::with('branch') -> where('entry_date',$d_date);
        $inc_q = Income::with('branch') -> where('entry_date',$d_date);
        $yourIncome = Income::latest()->limit(30)->get()->where('branch_id',Auth::user()->id); 
        $yourExpense =Expense::latest()->limit(30)->get()->where('branch_id',Auth::user()->id); 


        $yourIncomeTotal = $yourIncome->sum('amount');
        $yourExpenseTotal = $yourExpense->sum('amount');

        $yourProfit = $yourIncomeTotal - $yourExpenseTotal;

        $exp_total = $exp_q->sum('amount');
        $inc_total = $inc_q->sum('amount');

        $exp_group = $exp_q->orderBy('amount', 'desc')->get()->groupBy('branch_id');
        $inc_group = $inc_q->orderBy('amount', 'desc')->get()->groupBy('branch_id');

        $profit    = $inc_total - $exp_total;

        $exp_summary = [];

        foreach($exp_group as $exp){
            foreach($exp as $line){
                if(! isset($exp_summary[$line->branch->name])){
                    $exp_summary[$line->branch->name] = [
                        'name' => $line->branch->name,
                        'amount' => 0,
                    ];
                }
                $exp_summary[$line->branch->name]['amount'] += $line->amount;
            }
        }

        $inc_summary = [];
        foreach($inc_group as $income){
            foreach($income as $line){
                if(! isset($inc_summary[$line->branch->name])){
                    $inc_summary[$line->branch->name] = [
                        'name' => $line->branch->name,
                        'amount' => 0,
                    ];
                }
                $inc_summary[$line->branch->name]['amount'] += $line->amount;
            }
        }
       

        return view('home', compact( 'useractions', 'incomes', 'expenses', 'exp_summary',
        'inc_summary',
        'exp_total','yourIncome','yourExpense','yourIncomeTotal','yourExpenseTotal','yourProfit',
        'inc_total','today',
        'profit','from','d_date'));
    }
}
