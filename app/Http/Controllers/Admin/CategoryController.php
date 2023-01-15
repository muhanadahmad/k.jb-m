<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = Category::whereNull('parent_id')->get();
        //dd($users);


        $request=request();
        $category = Category::with(['parent'])->Filter($request->query())->latest()->paginate(22);
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent = Category::all();
        $category = new Category();
        return view('admin.category.create', compact('parent', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');
        if ($request->hasFile('image')) { //check isset image
            $file = $request->file('image'); //return object
            $path = $file->store('uploads', ['disk' => 'public']);
            $data['image'] = $path;
        }
        Category::create($data);
        return redirect()->route('category.index')->with('success', 'operation accomplished successfully');
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
        $category = Category::findOrFail($id);
        $parent = Category::where('id', '<>', $id)->where(
            function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            }
        )->get();
        return view('admin.category.edit', compact('category', 'parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {

        $category = Category::findOrFail($id);

        $old_image = $category->image;
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', ['disk' => 'public']);
            $data['image'] = $path;
        }
        if ($old_image && isset($data['image'])) {
            Storage::disk('public')->delete($old_image);
        }
        $category->update($data);
        return redirect()->route('category.index')->with('success', 'operation accomplished successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if($category->image){
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('category.index')->with('success', 'operation accomplished successfully');
    }

}
