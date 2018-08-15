@extends('layouts.app')

@section('content')
   
   <div class = "row">
        @if( Auth::check() && Auth::user()->role_id == 1)
       <div class="col-md-12">
           <div class="panel panel-default">
               <div class="panel-heading"> <h3>Daily Transactions</h3> </div>
               <div class="panel-body table-responsive">
                <div class="accordion">
                 {{--    --}}
                 {!! Form::open(['method' => 'get']) !!}
                 <div class="row">
                   
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="Date">Date</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                              
                                {!! Form::text('d', old('date'), ['class' => 'form-control', 'placeholder' => 
                                'Select date', 'required' => '','id' =>'Date','autocomplete'=>'off']) !!}
                                {{--  <input type="text" class="form-control" id="Date" autocomplete="off"/>  --}}
                            </div>
                        </div>
                    </div>
                     <div class="col-xs-4">
                         <label class="control-label">&nbsp;</label><br>
                         {!! Form::submit('Select Day',['class' => 'btn btn-primary']) !!}
                     </div>
                 </div>

                 <div class="panel panel-default">
                    <div class="panel-heading">
                        Report for {{$d_date}}
                    </div>
                    {!! Form::close() !!}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Income</th>
                                        <td>{{ number_format($inc_total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Expenses</th>
                                        <td>{{ number_format($exp_total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Profit</th>
                                        <td>{{ number_format($profit, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Income by Branch</th>
                                        <th>{{ number_format($inc_total, 2) }}</th>
                                    </tr>
                                @foreach($inc_summary as $inc)
                                    <tr>
                                        <th>{{ $inc['name'] }}</th>
                                        <td>{{ number_format($inc['amount'], 2) }}</td>
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Expenses by Branch</th>
                                        <th>{{ number_format($exp_total, 2) }}</th>
                                    </tr>
                                @foreach($exp_summary as $inc)
                                    <tr>
                                        <th>{{ $inc['name'] }}</th>
                                        <td>{{ number_format($inc['amount'], 2) }}</td>
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                 {{--    --}}
               </div>
           </div>
       </div>
   </div>
   
    <div class="row">
         <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added useractions</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('quickadmin.user-actions.fields.action')</th> 
                            <th> @lang('quickadmin.user-actions.fields.action-model')</th> 
                            <th> @lang('quickadmin.user-actions.fields.action-id')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($useractions as $useraction)
                            <tr>
                               
                                <td>{{ $useraction->action }} </td> 
                                <td>{{ $useraction->action_model }} </td> 
                                <td>{{ $useraction->action_id }} </td> 
                                <td>



</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>


 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added incomes</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('quickadmin.income.fields.entry-date')</th> 
                            <th> @lang('quickadmin.income.fields.amount')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($incomes as $income)
                            <tr>
                               
                                <td>{{ $income->entry_date }} </td> 
                                <td>{{ $income->amount }} </td> 
                                <td>

                                    @can('income_view')
                                    <a href="{{ route('admin.incomes.show',[$income->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan

                                    @can('income_edit')
                                    <a href="{{ route('admin.incomes.edit',[$income->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan

                                    @can('income_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.incomes.destroy', $income->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added expenses</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('quickadmin.expense.fields.entry-date')</th> 
                            <th> @lang('quickadmin.expense.fields.amount')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($expenses as $expense)
                            <tr>
                               
                                <td>{{ $expense->entry_date }} </td> 
                                <td>{{ $expense->amount }} </td> 
                                <td>

                                    @can('expense_view')
                                    <a href="{{ route('admin.expenses.show',[$expense->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan

                                    @can('expense_edit')
                                    <a href="{{ route('admin.expenses.edit',[$expense->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan

                                    @can('expense_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.expenses.destroy', $expense->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>
@endif
<div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Added Expenses by You</div>

            <div class="panel-body table-responsive">
                <table class="table table-bordered table-striped ajaxTable">
                    <thead>
                    <tr>
                        
                        <th> @lang('quickadmin.expense.fields.entry-date')</th> 
                        <th> @lang('quickadmin.expense.fields.amount')</th> 
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    @foreach($yourExpense as $expense)
                        <tr>
                           
                            <td>{{ $expense->entry_date }} </td> 
                            <td>{{ $expense->amount }} </td> 
                            <td>

                                @can('expense_view')
                                <a href="{{ route('admin.expenses.show',[$expense->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                @endcan

                                @can('expense_edit')
                                <a href="{{ route('admin.expenses.edit',[$expense->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                @endcan

                                @can('expense_delete')
{!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                    'route' => ['admin.expenses.destroy', $expense->id])) !!}
                                {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                                @endcan
                            
</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
</div>


<div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Recently added income by you</div>

            <div class="panel-body table-responsive">
                <table class="table table-bordered table-striped ajaxTable">
                    <thead>
                    <tr>
                        
                        <th> @lang('quickadmin.income.fields.entry-date')</th> 
                        <th> @lang('quickadmin.income.fields.amount')</th> 
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    @foreach($yourIncome as $income)
                        <tr>
                           
                            <td>{{ $income->entry_date }} </td> 
                            <td>{{ $income->amount }} </td> 
                            <td>

                                @can('income_view')
                                <a href="{{ route('admin.incomes.show',[$income->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                @endcan

                                @can('income_edit')
                                <a href="{{ route('admin.incomes.edit',[$income->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                @endcan

                                @can('income_delete')
{!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                    'route' => ['admin.incomes.destroy', $income->id])) !!}
                                {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                {!! Form::close() !!}
                                @endcan
                            
</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
</div>
    </div>

@endsection

