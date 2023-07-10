<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Alternatif::all();
        return view('alternatif.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $generate = Alternatif::all()->count();
        if ($generate > 0) {
            $generateId = sprintf("A%03s", ++$generate);
        } else if ($generate == 0) {
            $generateId = "A001";
        }

        return view('alternatif.create', compact('generateId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'kode_alternatif'      => 'required',
            'nama_alternatif'      => 'required',
        ]);

        $saveAlternatif = Alternatif::create($request->all())->id;

        if (!$saveAlternatif) {
            return back();
        }
        return redirect()->route('nilai.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alternatif $alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $alternatif = Alternatif::find($id);
        return view('alternatif.edit', ['alternatif' => $alternatif]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kode_alternatif'      => 'required',
            'nama_alternatif'      => 'required',
        ]);

        $updateAlternatif = Alternatif::where('id', $id)
            ->update($request->except(['_token', '_method']));
        if (!$updateAlternatif) {
            return back();
        }
        return redirect()->route('alternatif.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Alternatif::destroy($id);
        return redirect()->route('alternatif.index');
    }
}
