@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.expense.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.expenses.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('expense_category_id', trans('quickadmin.expense.fields.expense-category').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('expense_category_id', $expense_categories, old('expense_category_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('expense_category_id'))
                        <p class="help-block">
                            {{ $errors->first('expense_category_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('entry_date', trans('quickadmin.expense.fields.entry-date').'*', ['class' => 'control-label']) !!}
                    <h3>{{$displayDate}}</h3>
                    {!! Form::hidden('entry_date',$todaysDate, old('entry_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('entry_date'))
                        <p class="help-block">
                            {{ $errors->first('entry_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('amount', trans('quickadmin.expense.fields.amount').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('amount', old('amount'), ['class' => 'form-control', 'placeholder' => 'Please Enter Numberic Values only', 'required' => '','min'=>'0','step'=>'0.01']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('amount'))
                        <p class="help-block">
                            {{ $errors->first('amount') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('branch_id', trans('quickadmin.expense.fields.branch').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('branch_id', $branches->id, old('branch_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">{{$branches->name}}</p>
                    @if($errors->has('branch_id'))
                        <p class="help-block">
                            {{ $errors->first('branch_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop