<?php

namespace App\Http\Controllers;

use App\Opd;
use App\SubUnitKerja;
use App\UnitKerjaa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class SatuanKerjaController extends Controller
{
    public function api()
    {
        $opd = getWho()['opds'];
        // dd($opd);

        return DataTables::of($opd)
        ->addColumn('unit_kerja', function ($p) {
            $c = $p->unit_kerjas->count();
            return "
            <a   href='".route('unit_kerja.index', $p->id)."' title='Unit Kerja'><i class='fas fa-book mr-1'> ".$c."</i></a>";
        })

            ->addColumn('action', function ($p) {
                $action = "";
                if ($p->created_by == auth()->user()->id) {
                    $action = "
                <a onclick='edit(".$p->id.")'  href='javascript:;' title='Edit Dinas'><i class='fas fa-pencil-alt mr-1'></i></a>
                <a href='#' onclick='remove(".$p->id.")' class='text-danger' title='Hapus Dinas'><i class='fas fa-trash'></i></a>";
                }

                return $action;
            })



            ->rawColumns(['action','unit_kerja'])
            ->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('satker.index');
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
        $request->validate([
            'nama' => 'required',


        ]);

        if (Opd::where('nama', $request->input('nama'))->count() > 0) {
            $err = ['nama' => ["Dinas sudah pernah ditambah"]];
            return response()->json([
                'message' => "Error.",
                'errors'  => $err
            ], 422);
        }

        $input = $request->all();
        Opd::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Data Dinas berhasil tersimpan.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Opd  $opd
     * @return \Illuminate\Http\Response
     */
    public function show(Opd $opd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Opd  $opd
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Opd::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Opd  $opd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',


        ]);


        $opd = Opd::whereid($id)->first();
        $input = $request->all();
        $opd->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Data Dinas berhasil diperbaharui.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Opd  $opd
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $opd = Opd::whereid($id)->first();
        $uker = $opd->unit_kerjas->count();
        if ($uker > 0) {
            return response()->json([
                'message' => "Gagal hapus dinas, masih terdapat ".$uker." unit kerja",

            ], 422);
        }
        $opd->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Dinas berhasil dihapus.'
        ]);
    }



    //Unit Kerja

    public function unitkerja_api($id)
    {
        $uker = UnitKerjaa::whereopd_id($id)->get();
        // dd($uker);

        return DataTables::of($uker)
        ->addColumn('unit_kerja', function ($p) {
            $c = $p->sub_unitkerjas->count();
            return "
            <a   href='".route('subunit_kerja.index', $p->id)."' title='Unit Kerja'><i class='fas fa-book mr-1'> ".$c."</i></a>";
        })

            ->addColumn('action', function ($p) {
                $action = "";
                if ($p->created_by == auth()->user()->id) {
                    $action = "
					<a onclick='edit(".$p->id.")'  href='javascript:;' title='Edit Unit Kerja'><i class='fas fa-pencil-alt mr-1'></i></a>
					<a href='#' onclick='remove(".$p->id.")' class='text-danger' title='Hapus Unit Kerja'><i class='fas fa-trash'></i></a>";
                }

                return $action;
            })



            ->rawColumns(['action','unit_kerja'])
            ->toJson();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unitkerja_index($id)
    {
        $id = Opd::findOrFail($id);

        return view('satker.unitkerja', compact('id'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function unitkerja_store(Request $request)
    {
        $request->validate([
            'nama' => 'required',


        ]);



        $input = $request->all();
        UnitKerjaa::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Data Unit Kerja berhasil tersimpan.'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Opd  $opd
     * @return \Illuminate\Http\Response
     */
    public function unitkerja_edit($id)
    {
        return UnitKerjaa::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Opd  $opd
     * @return \Illuminate\Http\Response
     */
    public function unitkerja_update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',


        ]);

        $uker =  UnitKerjaa::whereid($id)->first();

        $input = $request->all();
        $uker->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Data Unit Kerja berhasil diperbaharui.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Opd  $opd
     * @return \Illuminate\Http\Response
     */
    public function unitkerja_destroy($id)
    {
        $uker = UnitKerjaa::whereid($id)->first();
        $subuker = $uker->sub_unitkerjas->count();
        if ($subuker > 0) {
            return response()->json([
                'message' => "Gagal hapus Unit Kerja, masih terdapat ".$subuker." Sub unit kerja",

            ], 422);
        }
        $uker->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Dinas berhasil dihapus.'
        ]);
    }

    //Sub Unit Kerja
    public function subunitkerja_api($id)
    {
        $uker = SubUnitKerja::whereunit_kerja_id($id)->get();
        // dd($uker);

        return DataTables::of($uker)


            ->addColumn('action', function ($p) {
                $action = "";
                if ($p->created_by == auth()->user()->id) {
                    $action ="
					<a onclick='edit(".$p->id.")'  href='javascript:;' title='Edit Sub Unit Kerja'><i class='fas fa-pencil-alt mr-1'></i></a>
					<a href='#' onclick='remove(".$p->id.")' class='text-danger' title='Hapus Sub Unit Kerja'><i class='fas fa-trash'></i></a>";
                }

                return $action;
            })



            ->rawColumns(['action'])
            ->toJson();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subunitkerja_index($id)
    {
        $id = UnitKerjaa::findOrFail($id);

        return view('satker.subunitkerja', compact('id'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subunitkerja_store(Request $request)
    {
        $request->validate([
            'nama' => 'required',


        ]);



        $input = $request->all();
        SubUnitKerja::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Data Sub Unit Kerja berhasil tersimpan.'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Opd  $opd
     * @return \Illuminate\Http\Response
     */
    public function subunitkerja_edit($id)
    {
        return SubUnitKerja::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Opd  $opd
     * @return \Illuminate\Http\Response
     */
    public function subunitkerja_update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',


        ]);

        $uker =  SubUnitKerja::whereid($id)->first();

        $input = $request->all();
        $uker->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Data Sub Unit Kerja berhasil diperbaharui.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Opd  $opd
     * @return \Illuminate\Http\Response
     */
    public function subunitkerja_destroy($id)
    {
        $subuker = SubUnitKerja::whereid($id)->first();
        $user = $subuker->pi->count();
        if ($user > 0) {
            return response()->json([
                'message' => "Gagal hapus Sub Unit Kerja, masih terdapat ".$user." Sub unit kerja",

            ], 422);
        }
        $subuker->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Dinas berhasil dihapus.'
        ]);
    }
}
