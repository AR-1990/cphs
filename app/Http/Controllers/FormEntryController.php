<?php

namespace App\Http\Controllers;

use App\Models\form_entry;
use App\Http\Requests\Storeform_entryRequest;
use App\Http\Requests\Updateform_entryRequest;

class FormEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\Storeform_entryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeform_entryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\form_entry  $form_entry
     * @return \Illuminate\Http\Response
     */
    public function show(form_entry $form_entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\form_entry  $form_entry
     * @return \Illuminate\Http\Response
     */
    public function edit(form_entry $form_entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateform_entryRequest  $request
     * @param  \App\Models\form_entry  $form_entry
     * @return \Illuminate\Http\Response
     */
    public function update(Updateform_entryRequest $request, form_entry $form_entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\form_entry  $form_entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(form_entry $form_entry)
    {
        //
    }
}
