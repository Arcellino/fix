<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id','nama_material','satuan','tanggal','volume_per_bulan' , 'harga_satuan', 'transportasi_dan_asuransi' , 'no_spb' , 'pabrikan' , 'prk' , 'jenis_material' , 'total_vol_material' , 'total_mat_datang'];

    protected $hidden = ['created_at','updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
