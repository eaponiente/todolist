@extends('layouts.app')
@section('title', isset($edit) ? 'Edit Todo' : 'Create Todo')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1>
                            {!! isset($edit) ? 'Edit Todo' : 'Create Todo' !!}
                        </h1>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{!! isset($edit) ? route('todos.update', $edit->id) : route('todos.store') !!}">
                            {!! method_field( isset($edit) ? 'PUT' : 'POST' ) !!}
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="exampleInputPassword1">Details</label>
                                <textarea name="details" class="form-control" cols="30" rows="10">{!! isset($edit) ? $edit->details : old('details') !!}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop