<?php

namespace App\Http\Controllers\Back;

use App\DataTables\LangueDataTable;
use App\Models\Langue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LangueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LangueDataTable $dataTable)
    {
        return $dataTable->render('back.shared.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Langue  $langue
     * @return \Illuminate\Http\Response
     */
    public function show(Langue $langue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Langue  $langue
     * @return \Illuminate\Http\Response
     */
    public function edit(Langue $langue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Langue  $langue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Langue $langue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Langue  $langue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Langue $langue)
    {
        //
    }
}
