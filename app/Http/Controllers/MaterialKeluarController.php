<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Customer;
use App\Exports\ExportMaterialKeluar;
use App\Material;
use App\Material_Keluar;
use Yajra\DataTables\DataTables;
use PDF;


class MaterialKeluarController extends Controller
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

        $customers = Customer::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');

        $invoice_data = Material_Keluar::all();
        return view('material_keluar.index', compact('materials','customers', 'invoice_data'));
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
           'customer_id'    => 'required',
           'total_mat_datang'            => 'required',
           'tanggal'           => 'required'
        ]);

        Material_Keluar::create($request->all());

        $material = Material::findOrFail($request->material_id);
        $material->total_mat_datang -= $request->total_mat_datang;
        $material->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Materials Out Created'
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
        $material_keluar = Material_Keluar::find($id);
        return $material_keluar;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $material_keluar = Material_Keluar::find($id);
        return $material_keluar;
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
            'customer_id'    => 'required',
            'total_mat_datang'            => 'required',
            'tanggal'           => 'required'
        ]);

        $material_keluar = Material_Keluar::findOrFail($id);
        $material_keluar->update($request->all());

        $material = Material::findOrFail($request->material_id);
        $material->total_mat_datang -= $request->total_mat_datang;
        $material->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Material Out Updated'
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
        Material_Keluar::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Materials Delete Deleted'
        ]);
    }



    public function apiMaterialsOut(){
        $material = Material_Keluar::all();

        return Datatables::of($material)
            ->addColumn('materials_name', function ($material){
                return $material->material->nama_material;
            })
            ->addColumn('customer_name', function ($material){
                return $material->customer->nama;
            })
            ->addColumn('action', function($material){
                return 
                    '<a onclick="showForm('. $material->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-eye-open"></i> Show</a> ' .
                    '<a onclick="editForm('. $material->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $material->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['materials_name','customer_name','action'])->make(true);

    }

    public function exportMaterialKeluarAll()
    {
        $material_keluar = Material_Keluar::all();
        $pdf = PDF::loadView('material_keluar.materialKeluarAllPDF',compact('material_keluar'));
        return $pdf->download('material_keluar.pdf');
    }

    public function exportMaterialKeluar($id)
    {
        $material_keluar = Material_Keluar::findOrFail($id);
        $pdf = PDF::loadView('material_keluar.materialKeluarPDF', compact('material_keluar'));
        return $pdf->download($material_keluar->id.'_material_keluar.pdf');
    }

    public function exportExcel()
    {
        return (new ExportMaterialKeluar)->download('material_keluar.xlsx');
    }
}
