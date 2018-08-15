@extends('layouts.app')

@section('content')
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <h3 class="page-title">@lang('quickadmin.charts.title')</h3>
    <div class="row">
    <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">General Income</div>
    
                <div class="panel-body table-responsive">
    <div id="genIncome" style="height: 250px;"></div>
                </div></div>
                <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">General Expense</div>
    <div id="genExpense" style="height: 250px;"></div>
                            </div></div>
                </div>
    {{--  @foreach($chartValue as $val)
        <p>{{$val}}</p>
    @endforeach  --}}
    <script>
        var data ={!!$incomeChart!!};
            new Morris.Line({
                // ID of the element in which to draw the chart.
                element: 'genIncome',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                data:data,
                // The name of the data record attribute that contains x-values.
                xkey: 'entry_date',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['amount'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['entry_date']
              });
//expense
              var data ={!!$expenseChart!!};
              new Morris.Line({
                  // ID of the element in which to draw the chart.
                  element: 'genExpense',
                  // Chart data records -- each entry in this array corresponds to a point on
                  // the chart.
                  data:data,
                  // The name of the data record attribute that contains x-values.
                  xkey: 'entry_date',
                  // A list of names of data record attributes that contain y-values.
                  ykeys: ['amount'],
                  // Labels for the ykeys -- will be displayed when you hover over the
                  // chart.
                  labels: ['entry_date']
                });
    </script>
   
    
    
@stop