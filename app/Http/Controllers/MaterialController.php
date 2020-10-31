<?php

namespace App\Http\Controllers;

use App\Category;
use App\Material;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MaterialController extends Controller
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
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $materials = Material::all();
        return view('materials.index', compact('category'));
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
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $this->validate($request , [
            'nama_material'          => 'required|string',
            'satuan'         => 'required',
            'tanggal'           => 'required',
            'volume_per_bulan'         => 'required',
            'harga_satuan'         => 'required',
            'transportasi_dan_asuransi'         => 'required',
            'no_spb'         => 'required',
            'pabrikan'         => 'required',
            'prk'         => 'required',
            'jenis_material'         => 'required',
            'total_vol_material'         => 'required',
            'total_mat_datang'         => 'required',
            'category_id'   => 'required',
        ]);

        $input = $request->all();
        $input['image'] = null;

        if ($request->hasFile('image')){
            $input['image'] = '/upload/materials/'.str_slug($input['nama'], '-').'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/materials/'), $input['image']);
        }

        Material::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Materials Created'
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
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        $material = Material::find($id);
        return $material;
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
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $this->validate($request , [
            'nama_material'          => 'required|string',
            'satuan'         => 'required',
            'tanggal'           => 'required',
            'volume_per_bulan'         => 'required',
            'harga_satuan'         => 'required',
            'transportasi_dan_asuransi'         => 'required',
            'no_spb'         => 'required',
            'pabrikan'         => 'required',
            'prk'         => 'required',
            'jenis_material'         => 'required',
            'total_vol_material'         => 'required',
            'total_mat_datang'         => 'required',
            'category_id'   => 'required',
        ]);

        $input = $request->all();
        $material = Material::findOrFail($id);

       

        $material->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Materials Update'
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
        
        

        Material::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Materials Deleted'
        ]);
    }

    public function apiMaterials(){
        $material = Material::all();

        return Datatables::of($material)
            ->addColumn('category_name', function ($material){
                return $material->category->name;
            })
 
            ->addColumn('action', function($material){
                return 
                    '<a onclick="editForm('. $material->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $material->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['category_name','action'])->make(true);

    }
}
