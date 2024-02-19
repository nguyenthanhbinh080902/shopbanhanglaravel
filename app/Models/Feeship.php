<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'fee_matp', 'fee_maqh', 'fee_xaid', 'fee_feeship'
    ];
    protected $primaryKey = 'fee_id';
    protected $table = 'tbl_feeship';

    public function city(){
        return $this->belongsTo(City::class, 'fee_matp');
    }

    public function province(){
        return $this->belongsTo(Province::class, 'fee_maqh');
    }
    
    public function wards(){
        return $this->belongsTo(Wards::class, 'fee_xaid');
    }
}
