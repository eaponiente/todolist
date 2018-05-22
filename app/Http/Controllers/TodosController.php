<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::oldest()->get();

        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.crud');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'details' => 'required'
        ]);

        auth()->user()->todos()->save(new Todo($request->all()));

        return redirect()->route('todos.index')->with('success', 'Todo created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $edit = Todo::find($id);

        if(auth()->user()->cannot('update', $edit)) {
            return redirect()->route('todos.index')->with('fail', 'Not allowed to access');
        }

        return view('todos.crud', compact('edit'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'details' => 'required'
        ]);

        $edit = Todo::find($id);

        $this->authorize('update', $edit);

        $edit->update($request->all());

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $edit = Todo::find($id);

        if(auth()->user()->cannot('delete', $edit)) {
            return redirect()->route('todos.index')->with('fail', 'Not allowed to access');
        }

        $edit->delete();

        return redirect()->route('todos.index')->with('success', 'Todo deleted successfully');
    }
}
