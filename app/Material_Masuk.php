<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material_Masuk extends Model
{
    protected $table = 'material_masuk';

    protected $fillable = ['material_id','supplier_id','total_mat_datang','tanggal'];

    protected $hidden = ['created_at','updated_at'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
