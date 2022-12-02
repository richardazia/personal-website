<?php

namespace App\Http\Controllers;

use App\Models\Geography;
use Illuminate\Http\Request;

class GeographyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('geographies.index', [
          'geographies' => Geography::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
          'title' => 'required|string|max:120',
          'content' => 'required|string',
        ]);

        $request->user()->geographies()->create($validated);

        return redirect(route('geographies.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Geography  $geography
     * @return \Illuminate\Http\Response
     */
    public function show(Geography $geography)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Geography  $geography
     * @return \Illuminate\Http\Response
     */
    public function edit(Geography $geography)
    {
        $this->authorize('update', $geography);

        return view('geographies.edit', [
          'geography' => $geography,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Geography  $geography
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Geography $geography)
    {
        $this->authorize('update', $geography);

        $validated = $request->validate([
          'title' => 'required|string|max:120',
          'content' => 'required|string',
        ]);

        $geography->update($validated);

        return redirect(route('geographies.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Geography  $geography
     * @return \Illuminate\Http\Response
     */
    public function destroy(Geography $geography)
    {
        $this->authorize('delete', $geography);

        $geography->delete();

        return redirect(route('geographies.index'));
    }
}
