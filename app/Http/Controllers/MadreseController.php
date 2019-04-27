<?php

namespace App\Http\Controllers;

use App\Madrese;
use Illuminate\Http\Request;

class MadreseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Madrese::get();
    }

    public function view()
    {
        return view('madrese.view');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Madrese $madrese
     * @return \Illuminate\Http\Response
     */
    public function show(Madrese $madrese)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Madrese $madrese
     * @return \Illuminate\Http\Response
     */
    public function edit(Madrese $madrese)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Madrese $madrese
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Madrese $madrese)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Madrese $madrese
     * @return \Illuminate\Http\Response
     */
    public function destroy(Madrese $madrese)
    {
        //
    }
}
