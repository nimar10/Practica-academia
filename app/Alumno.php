<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Modulo;
class Alumno extends Model
{
    protected $fillable=['nombre', 'apellidos', 'mail', 'logo'];


    // Metodos para la relacion n:n con Modulos
    public function modulos(){
        return $this->belongsToMany('App\Modulo')->withPivot('nota')->withTimestamps();
    }

    public function modulosOut(){
         // esto me devuelve los ids de los modulos que tiene ese alumno
         $modulos1=$this->modulos()->pluck('modulos.id');
         //esto me devuelve los ids de modulos 1 en el caso de tenerlo o que le faltan
         $modulos2=Modulo::whereNotIn('id', $modulos1)->get();

         return $modulos2;
    }

    public function notaMedia(){
        $suma=0;
        $total=$this->modulos->count();
        if($total>0){
            foreach($this->modulos as $modulo){
                $nota=$modulo->pivot->nota;
                if($nota)$suma+=$nota;
            }
            return round(($suma/$total), 2);
        }
        return "Sin modulos";
        
    }
}

//     public function scope_Modulo($query, $v){

//         if($v=='%'){
//             return $query->where('modulo_nombre','like', $v)
//             ->orwhereNull('modulo_nombre');
//     }
// }
