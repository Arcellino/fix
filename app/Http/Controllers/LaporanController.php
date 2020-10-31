<?php

namespace App\Http\Controllers;

use App\Exports\ExportLaporans;
use App\Imports\LaporansImport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Laporan;
use App\Category;
use App\Material;
use Excel;
use PDF;
use DB;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::all();
        $categories = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $invoice_data = Laporan::all();
        return view('laporans.index', compact('materials','categories','invoice_data'));
    }

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
        $this->validate($request, [
           'name'   => 'required|string|min:2'
        ]);

       Laporan::create($request->all());

        return response()->json([
           'success'    => true,
           'message'    => 'Categories Created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laporan = Laporan::find($id);
        return $laporan;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $laporan = Laporan::find($id);
        return $laporan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'   => 'required|string|min:2'
        ]);

        $laporan = Laporan::findOrFail($id);

        $laporan->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Categories Update'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Laporan::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Categories Delete'
        ]);
    }


    public function apiLaporan(){
        $material = Laporan::all();

        return Datatables::of($material)
            ->addColumn('materials_name', function ($material){
                return $material->material->nama_material;
            })
            ->addColumn('categories_name', function ($material){
                return $material->category->name;
            })
            ->addColumn('action', function($material){
                return 
                    '<a onclick="editForm('. $material->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $material->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';


            })
            ->rawColumns(['materials_name','categories_name','action'])->make(true);

    }

    public function exportLaporanAll()
    {
        $laporan = Laporan::all();
        $pdf = PDF::loadView('laporans.laporanAllPDF',compact('laporan'));
        return $pdf->download('laporan.pdf');
    }

    public function exportLaporan($id)
    {
        
        $laporan = Laporan::findOrFail($id);
        $material = Material:: all();
        $data = $material-> where('category_id', $id);
        $pdf = PDF::loadView('laporans.laporanPDF', compact('laporan','material','data'))->setPaper('a4','landscape');
        return $pdf->download($laporan->id.'_laporan.pdf');
    }
    public function exportExcel()
    {
        return (new ExportLaporan)->download('laporan.xlsx');
    }

    public function filter_data(Request $request)
    {
       
    }
}
		