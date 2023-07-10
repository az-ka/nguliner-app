<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiAlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::with('crip')->get();

        return view('nilai.index', compact('kriteria', 'alternatif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriteria = Kriteria::all();
        return view('nilai.create', compact('kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $data = array_values($request->except('_token'));
        $alternatif = Alternatif::find($id);
        $alternatif->crip()->sync($data);

        return redirect('alternatif.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(NilaiAlternatif $nilaiAlternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $selectedCrip = DB::table('nilai_alternatifs')
            ->select('crip_id')
            ->where('alternatif_id', $id)
            ->get();
        $kriteria = Kriteria::with('crip')->get();

        $arrayCrip = [];
        foreach ($selectedCrip as $a) {
            $arrayCrip[] = $a->crip_id;
        }
        return view('nilai.edit', [
            'master_kriteria'   => $kriteria,
            'selected_crip'     => $arrayCrip,
            'nilai_id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $data = array_values($request->except('_token', '_method'));
        $alternatif = Alternatif::find($id);
        $alternatif->crip()->sync($data);

        return redirect()->route('nilai.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NilaiAlternatif $nilaiAlternatif)
    {
        //
    }
}
