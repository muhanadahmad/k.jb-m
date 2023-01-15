<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request=request();

        //$user = User::with('store')->get();
        $user = User::with('store')->Filter($request->query())->latest()->paginate(10);
        return view('admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $store = Store::all();
        $user = new User();
        return view('admin.user.create', compact('store', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        User::create([
            'name' => $request->post('name'),
            'password' => Hash::make('password'),
            'email' => $request->post('email'),
            'store_id' => $request->post('store_id'),
            'status' => $request->post('status'),
        ]);
        return redirect()->route('user.index')->with('success', 'operation accomplished successfully');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $store = Store::all();
        return view('admin.user.edit', compact('user', 'store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->post('name'),
            'password' => Hash::make('password'),
            'email' => $request->post('email'),
            'store_id' => $request->post('store_id'),
            'status' => $request->post('status'),
        ]);
        return redirect()->route('user.index')->with('success', 'operation accomplished successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'operation accomplished successfully');
    }
}
