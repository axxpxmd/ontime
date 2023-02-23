<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    protected $table="opd";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
    ];

    public function unit_kerjas(){
    return $this->hasMany(UnitKerjaa::class);
    }



}
