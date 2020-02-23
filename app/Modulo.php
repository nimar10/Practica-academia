<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $fillable=['nombre', 'horas'];

    // Metodos para la relacion n:n con Alumnos
    public function alumnos(){
       return $this->belongsToMany('App\Alumno')->withPivot('nota')->withTimestamps();
       
    }

    public function scopeAlumno_id($query, $v){
    
        if($v=='%'){
            return $query->where('alumno_id','like', $v)
            ->orWhereNull('alumno_id');
    }

        if($v==-1){
            return $query->whereNull('alumno_id');
        }
        if(!isset($v)){
            return $query->where('alumno_id', 'like','%')
            ->orWhereNull('alumno_id');
        }
        return $query('alumno_id',$v);
    }
}
