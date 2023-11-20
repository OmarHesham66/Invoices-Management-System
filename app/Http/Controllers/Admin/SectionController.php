<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::with('User')->paginate(COUNTER);
        return view('Site.Sections.sections', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sections,name|max:20|min:4',
        ]);
        $request['Created_By'] = auth()->id();
        Section::create($request->except('_token'));
        session()->flash('success', __('Created Section'));
        return redirect()->route('sections.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $id = $section->id;
        $request->validate([
            'name' => "required|unique:sections,name,$id|max:20|min:4",
        ]);
        $section->update($request->all());
        session()->flash('update', __('Update Section'));
        return redirect()->route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        //
    }
}
