<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material_Keluar extends Model
{
    //
    protected $table = 'material_keluar';

    protected $fillable = ['material_id','customer_id','total_mat_datang','tanggal'];

    protected $hidden = ['created_at','updated_at'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
