<?php
namespace App\Http\Controllers\Admin;

use App\Income;
use App\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class MonthlyReportsController extends Controller
{
    public function index(Request $r)
    {
        $from    = Carbon::parse(sprintf(
            '%s-%s-01',
            $r->query('y', Carbon::now()->year),
            $r->query('m', Carbon::now()->month),
            $r->query('d', Carbon::now()->day)
        ));
        $to      = clone $from;
        $to->day = $to->daysInMonth;
        $exp_q;
        $inc_q;

        if (Auth::user()->id == 1) {
            # code...
            $exp_q = Expense::with('expense_category','branch')
            ->whereBetween('entry_date', [$from, $to]);

        $inc_q = Income::with('income_category','branch')
            ->whereBetween('entry_date', [$from, $to]);
        } else {
            # code...
            $exp_q = Expense::with('expense_category','branch')->where('branch_id',Auth::user()->id)
            ->whereBetween('entry_date', [$from, $to]);

        $inc_q = Income::with('income_category','branch')->where('branch_id',Auth::user()->id)
            ->whereBetween('entry_date', [$from, $to]);
        }
        

     


        $exp_total = $exp_q->sum('amount');
        $inc_total = $inc_q->sum('amount');
        $exp_group = $exp_q->orderBy('amount', 'desc')->get()->groupBy('expense_category_id');
        $inc_group = $inc_q->orderBy('amount', 'desc')->get()->groupBy('income_category_id');
        $profit    = $inc_total - $exp_total;

        $exp_summary = [];
        foreach ($exp_group as $exp) {
            foreach ($exp as $line) {
                if (! isset($exp_summary[$line->expense_category->name])) {
                    $exp_summary[$line->expense_category->name] = [
                        'name'   => $line->expense_category->name,
                        'amount' => 0,
                    ];
                }
                $exp_summary[$line->expense_category->name]['amount'] += $line->amount;
            }
        }

        $inc_summary = [];
        foreach ($inc_group as $inc) {
            foreach ($inc as $line) {
                if (! isset($inc_summary[$line->income_category->name])) {
                    $inc_summary[$line->income_category->name] = [
                        'name'   => $line->income_category->name,
                        'amount' => 0,
                    ];
                }
                $inc_summary[$line->income_category->name]['amount'] += $line->amount;
            }
        }

        return view('admin.monthly_reports.index', compact(
            'exp_summary',
            'inc_summary',
            'exp_total',
            'inc_total',
            'profit'
        ));
    }
}