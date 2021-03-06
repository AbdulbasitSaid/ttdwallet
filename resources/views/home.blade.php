@extends('layouts.app')

@section('content')
   <div class="row">
      <div class = "col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Branch Activity</h3>
            </div>
                <div class="panel-body table-responsive">
                    <div class="accordion">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Select Branch</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" id = "branchsearch" class="form-control" placeholder="Branch Name">
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">
                               <div class="row">
                                   <div class="col-md-12">
                                       <label></label>
                                       <table class="table table-active table-striped">
                                           <tr>
                                               <th>Income</th>
                                               <th>Expense</th>
                                               <th>Date</th>
                                               <th>Profit</th>
                                           </tr>
                                
                                       </table>
                                   </div>
                            
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

      </div>
   </div>
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
                                    <tr id="profit">
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

@if(Auth::user()->id!=1)
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
                         <div class="col-md-12">
                             <table class="table table-bordered table-striped">
                                 <tr>
                                     <th>Income</th>
                                     <td>{{ number_format($branchIncomeTotal, 2) }}</td>
                                 </tr>
                                 <tr>
                                     <th>Expenses</th>
                                     <td>{{ number_format($branchExpenseTotal, 2) }}</td>
                                 </tr>
                                 <tr id="profit">
                                     <th>Profit</th>
                                     <td>{{ number_format($branchProfit, 2) }}</td>
                                 </tr>
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
    <div class="col-md-6">
        <a href="https://drive.google.com/file/d/1s_diXwrrOWnbvJzZpShCGKxhKx4n-qUO/view?usp=sharing" download>Download  Android App</a>
        <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
        <script>
            var profit = {!!$profit!!};
            $(document).ready(
                function(){
                   if(profit < 0){
                       //alert('Lost');
                       $('#profit').css('background-color','#FF6347');
                   }else{
                      // alert('Profit');
                      $('#profit').css('background-color','#00FF7F');
                   }
                   $("#branchsearch").change(
                    function(){
                        $.get(
                            "/admin/home",function(data,status){
                               // alert("DATA: "+ data+"\n Status" + status);
                               console.log("DAta :" + data +" :"+ status);
                            }
                        );

                    }
                );
                }
            );
               

        </script>
        <script>
              
        </script>
    </div>

    
@endsection

