<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request=Request();
        $store = Store::Filter($request->query())->latest()->paginate(22);
        return view('admin.store.index', compact('store'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $store = new Store();
        return view('admin.store.create', compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
          $data = $request->except(['logo_image','cover_image']);
        if ($request->hasFile('logo_image')) { //check isset image
            $file = $request->file('logo_image'); //return object
            $path = $file->store('uploads', ['disk' => 'public']);
            $data['logo_image'] = $path;
        }
        if ($request->hasFile('cover_image')) { //check isset image
            $file = $request->file('cover_image'); //return object
            $path = $file->store('uploads', ['disk' => 'public']);
            $data['cover_image'] = $path;
        }

        Store::create($data);
        return redirect()->route('store.index')->with('success', 'operation accomplished successfully');
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
        $store = Store::findOrFail($id);
        return view('admin.store.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {

        $store = Store::findOrFail($id);

        $old_logo_image = $store->logo_image;
        $old_cover_image = $store->cover_image;

        $data = $request->except(['logo_image','cover_image']);
        if ($request->hasFile('logo_image')) {
            $file = $request->file('logo_image');
            $path = $file->store('uploads', ['disk' => 'public']);
            $data['logo_image'] = $path;
        }
        if ($old_logo_image && isset($data['logo_image'])) {
            Storage::disk('public')->delete($old_logo_image);
        }
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $path = $file->store('uploads', ['disk' => 'public']);
            $data['cover_image'] = $path;
        }
        if ($old_cover_image && isset($data['cover_image'])) {
            Storage::disk('public')->delete($old_cover_image);
        }

        $store->update($data);
        return redirect()->route('store.index')->with('success', 'operation accomplished successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
        if($store->logo_image){
            Storage::disk('public')->delete($store->logo_image);
        }
        if($store->cover_image){
            Storage::disk('public')->delete($store->cover_image);
        }
        return redirect()->route('store.index')->with('success', 'operation accomplished successfully');
    }
   }
