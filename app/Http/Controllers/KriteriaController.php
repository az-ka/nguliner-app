<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kriteria::all();
        return view('kriteria.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $generate = Kriteria::all()->count();
        if ($generate > 0) {
            $generateId = sprintf("K%03s", ++$generate);
        } else if ($generate == 0) {
            $generateId = "K001";
        }

        return view('kriteria.create', compact('generateId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode'      => 'required|unique:kriterias',
            'nama'      => 'required',
            'atribut'   => 'required',
            'bobot'     => 'required'
        ]);

        Kriteria::create($request->all());

        return redirect('/kriteria');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kriteria = Kriteria::find($id);
        return view('kriteria.edit', ['data' => $kriteria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriteria, $id)
    {
        $this->validate($request, [
            'kode'      => 'required',
            'nama'      => 'required',
            'atribut'   => 'required',
            'bobot'     => 'required'
        ]);

        $kriteria = Kriteria::findOrFail($id);

        $kriteria->update([
            'kode'     => $request->kode,
            'nama'     => $request->nama,
            'atribut'     => $request->atribut,
            'bobot'     => $request->bobot,
        ]);
        return redirect()->route('kriteria.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Kriteria::destroy($id);
        return redirect()->route('kriteria.index');
    }
}
