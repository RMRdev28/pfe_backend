<?php

namespace App\Http\Controllers;

use App\Models\Prof;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $profs = Prof::with(['user', 'pfeEncadre'])->get();
        foreach ($profs as $prof) {
            $prof->nbrPfeEncadre = count($prof->pfeEncadre);
            $categories = [];
            $cat = DB::table('prof_categories')->where('idProf', $prof->id)->pluck('idCategory');
            foreach ($cat as $c) {
                $categories[] = DB::table('categories')->where('id', $c)->first();
            }
            $prof->categories = $categories;
        }
        return response()->json($profs);
    }

    public function getProfByType($type)
    {
        $profs = Prof::where('isValidator', $type)->with(['user', 'pfeEncadre'])->get();
        foreach ($profs as $prof) {
            $prof->nbrPfeEncadre = count($prof->pfeEncadre);
            $categories = [];
            $cat = DB::table('prof_categories')->where('idProf', $prof->id)->pluck('idCategory');
            foreach ($cat as $c) {
                $categories[] = DB::table('categories')->where('id', $c)->first();
            }
            $prof->categories = $categories;
        }
        return response()->json($profs);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Prof $prof)
    {
        $prof = Prof::where('id', $prof->id)->with(['user', 'pfeEncadre'])->first();
        $prof->nbrPfeEncadre = count($prof->pfeEncadre);
        $categories = [];
        $cat = DB::table('prof_categories')->where('idProf', $prof->id)->pluck('idCategory');
        foreach ($cat as $c) {
            $categories[] = DB::table('categories')->where('id', $c)->first();
        }
        $prof->categories = $categories;

        return response()->json($prof);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prof $prof)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prof $prof)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prof $prof)
    {
        //
    }
}
