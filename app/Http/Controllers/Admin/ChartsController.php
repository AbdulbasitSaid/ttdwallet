<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Income;
class ChartsController extends Controller
{
    public function index()
    {
        if (! Gate::allows('chart_access')) {
            return abort(401);
        }
        $chartValue = Income::select('amount','entry_date')->get();
        return view('admin.charts.index',compact('chartValue'));
    }
}
