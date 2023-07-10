<?php

namespace App\Http\Controllers;

use App\Models\Crip;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class CripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria   = Kriteria::all();
        $crips      = collect([]);
        if ($request->k) {
            $crips = Kriteria::find($request->k)->crip;
        }

        return view('crip.index', compact('kriteria', 'crips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriteria = Kriteria::all();
        return view('crip.create', compact('kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kriteria'      => 'required',
            'nama_crip'     => 'required',
            'nilai_crip'    => 'required'
        ]);

        $kriteria = Kriteria::find($request->kriteria);
        $saveCrip = $kriteria->crip()->create($request->except(['_token', 'kriteria']));
        if (!$saveCrip) {
            return back();
        }
        return redirect(route('crip.index') . "?k=" . $request->kriteria);
    }

    /**
     * Display the specified resource.
     */
    public function show(Crip $crip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kriteria   = Kriteria::all();
        $crip       = Crip::find($id);
        return view('crip.edit', compact('kriteria', 'crip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $krit = Kriteria::find((int) $request->kriteria);
        $crip = Crip::find($id);
        $updated = $crip->update($request->except(['_token', 'kriteria']));
        if ($updated) {
            $crip->kriteria()->associate($krit)->save();
            return redirect(route('crip.index') . "?k=" . $request->kriteria);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Crip::destroy($id);
        return back();
    }
}
