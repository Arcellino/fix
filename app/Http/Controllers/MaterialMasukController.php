<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\exportMaterialMasuk;
use App\Material;
use App\Material_Masuk;
use App\Supplier;
use PDF;
use Yajra\DataTables\DataTables;


class MaterialMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staff');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::orderBy('nama_material','ASC')
            ->get()
            ->pluck('nama_material','id');

        $suppliers = Supplier::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');

        $invoice_data = Material_Masuk::all();
        return view('material_masuk.index', compact('materials','suppliers','invoice_data'));
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
        $this->validate($request, [
            'material_id'     => 'required',
            'supplier_id'    => 'required',
            'total_mat_datang'            => 'required',
            'tanggal'        => 'required'
        ]);

        Material_Masuk::create($request->all());

        $material = Material::findOrFail($request->material_id);
        $material->total_mat_datang += $request->total_mat_datang;
        $material->save();

        return response()->json([
            'success'    => true,
            'message'    => 'materials In Created'
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material_masuk = Material_Masuk::find($id);
        return $material_masuk;
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
            'material_id'     => 'required',
            'supplier_id'    => 'required',
            'total_mat_datang'=> 'required',
            'tanggal'        => 'required'
        ]);

        $material_masuk = Material_Masuk::findOrFail($id);
        $material_masuk->update($request->all());

        $material = Material::findOrFail($request->material_id);
        $material->total_mat_datang += $request->total_mat_datang;
        $material->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Material In Updated'
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
        Material_Masuk::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Materials In Deleted'
        ]);
    }



    public function apiMaterialsIn(){
        $material = Material_Masuk::all();

        return Datatables::of($material)
            ->addColumn('materials_name', function ($material){
                return $material->material->nama_material;
            })
            ->addColumn('supplier_name', function ($material){
                return $material->supplier->nama;
            })
            ->addColumn('action', function($material){
                return '<a href="#" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $material->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $material->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';


            })
            ->rawColumns(['materials_name','supplier_name','action'])->make(true);

    }

    public function exportMaterialMasukAll()
    {
        $material_masuk = Material_Masuk::all();
        $pdf = PDF::loadView('material_masuk.materialMasukAllPDF',compact('material_masuk'));
        return $pdf->download('material_masuk.pdf');
    }

    public function exportMaterialMasuk($id)
    {
        $material_masuk = Material_Masuk::findOrFail($id);
        $pdf = PDF::loadView('material_masuk.materialMasukPDF', compact('material_masuk'));
        return $pdf->download($material_masuk->id.'_material_masuk.pdf');
    }

    public function exportExcel()
    {
        return (new ExportMaterialMasuk)->download('material_masuk.xlsx');
    }
}
