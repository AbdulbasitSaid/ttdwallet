@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.internal-notifications.title')</h3>
    
    {!! Form::model($internal_notification, ['method' => 'PUT', 'route' => ['admin.internal_notifications.update', $internal_notification->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('text', trans('quickadmin.internal-notifications.fields.text').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('text', old('text'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('text'))
                        <p class="help-block">
                            {{ $errors->first('text') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('link', trans('quickadmin.internal-notifications.fields.link').'', ['class' => 'control-label']) !!}
                    {!! Form::text('link', old('link'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('link'))
                        <p class="help-block">
                            {{ $errors->first('link') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('users', trans('quickadmin.internal-notifications.fields.users').'*', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-users">
                        {{ trans('quickadmin.qa_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-users">
                        {{ trans('quickadmin.qa_deselect_all') }}
                    </button>
                    {!! Form::select('users[]', $users, old('users') ? old('users') : $internal_notification->users->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-users' , 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('users'))
                        <p class="help-block">
                            {{ $errors->first('users') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script>
        $("#selectbtn-users").click(function(){
            $("#selectall-users > option").prop("selected","selected");
            $("#selectall-users").trigger("change");
        });
        $("#deselectbtn-users").click(function(){
            $("#selectall-users > option").prop("selected","");
            $("#selectall-users").trigger("change");
        });
    </script>
@stop