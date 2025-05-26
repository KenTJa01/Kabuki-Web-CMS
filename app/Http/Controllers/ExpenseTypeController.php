<?php

namespace App\Http\Controllers;

use App\Models\expense_type;
use App\Http\Requests\Storeexpense_typeRequest;
use App\Http\Requests\Updateexpense_typeRequest;

class ExpenseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Storeexpense_typeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(expense_type $expense_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(expense_type $expense_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateexpense_typeRequest $request, expense_type $expense_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(expense_type $expense_type)
    {
        //
    }
}
