@extends('layouts.app')
@section('title', 'Todos')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success">
                        {!! session('success') !!}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header text-right">
                        <a href="{!! route('todos.create') !!}" class="btn btn-primary btn-sm">New Todo</a>
                    </div>
                    <div class="card-body card">

                        <table class="table table-bordered">
                            <tr>
                                <th width="20%">User</th>
                                <th>Details</th>
                                <th width="18%">Created At</th>
                                <th width="20%">Actions</th>
                            </tr>

                            @forelse($todos as $todo)
                                <tr>
                                    <td>{!! $todo->user->name !!}</td>
                                    <td>{!! $todo->details !!}</td>
                                    <td>{!! $todo->created_at !!}</td>
                                    <td>
                                        <a href="{!! route('todos.edit', $todo->id) !!}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{!! route('todos.destroy', $todo->id) !!}" method="POST" style="display: inline;">
                                            {!! csrf_field() . method_field('DELETE') !!}
                                            <input type="submit" value="Remove" class="btn btn-danger btn-sm">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No Todo List Yet</td>
                                </tr>
                            @endforelse

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop