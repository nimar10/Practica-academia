<?php

namespace App\Http\Controllers;

use App\Alumno;
use Illuminate\Http\Request;
use App\Modulo;
use App\Http\Requests\AlumnoRequest;
use Illuminate\Support\Facades\Storage;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        // $miModulo=$request->get('modulo_nombre');
        $alumnos=Alumno::orderBy('apellidos')
        // ->modulo_nombre($miModulo)
        ->paginate(5);
        return view('alumnos.index', compact('alumnos'));
    }

    public function fmatricula(Alumno $alumno){
        $modulos2=$alumno->modulosOut();
        //compruebo si ya los tiene todos
        if($modulos2->count()==0){
            return redirect()->route('alumnos.show', $alumno)
            ->with('mensaje', 'Este alumno ya esta matriculado de todos los modulos!!!');
        }
        //cargamos el formulario matricular alumno le mando el alumno y los modulos que le faltan
        return view('alumnos.fmatricula', compact('alumno', 'modulos2'));
    }

    public function matricular(Request $request){
        $id=$request->alumno_id;
        //me traigo el alumno de codigo id
        $alumno=Alumno::find($id);
        if(isset($request->modulo_id)){
            foreach($request->modulo_id as $item){
                $alumno->modulos()->attach($item); // attach para meterle el modulo
            }
            return redirect()->route('alumnos.show', $alumno)->with('mensaje', 'Alumno matriculado!!');
        }
        return redirect()->route('alumnos.show', $alumno)->with('mensaje', 'Ningun modulo seleccionado!!');
    }

    public function fcalificar(Alumno $alumno){
        $modulos=$alumno->modulos()->get(); //traer los modulos del alumno
        if($modulos->count()==0){
            return redirect()->route('alumnos.show', $alumno)->with('mensaje', 'Alumno sin cursos!!!');
        }
        return view('alumnos.fcalificar', compact('alumno'));
    }

    public function calificar(Request $request){
       $alumno=Alumno::find($request->id_al);

       foreach($request->modulos as $k=>$v){
           $alumno->modulos()->updateExistingPivot($k, ['nota'=>$v]);
       }
       return redirect()->route('alumnos.show', $alumno)->with('mensaje', 'Calificaciones Guardadas con exito!!!');
    }

    /**
     * Show the form for creating a new resource. QUEEEE??
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlumnoRequest $request ) {
        //validaciones genericas
      $datos=$request->validated();
      
        // dd($datos);
        //cojo los datos por que voy a modificar el request
        //voy a poner nomy ape la primera letra en mayusculas
        $alumno=new Alumno();

        $alumno->nombre=ucwords($datos['nombre']);
        $alumno->apellidos=ucwords($datos['apellidos']);
        $alumno->mail=$datos['mail'];
        

        //Compr0obamos si hemos subido un logo
        if($datos['logo']!=null){
            
            $file=$datos['logo']; //metemos foto en una variable (yo me entiendo)
            
            $nom='logo/'.time()."_".$file->getClientOriginalName(); //importante
            Storage::disk('public')->put($nom, \File::get($file));

            $alumno->logo="img/$nom";
            
        }
            $alumno->save(); //Guardamos el archivo
            return redirect()->route('alumnos.index')->with('mensaje', 'Alumnado creado con exito!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        return view('alumnos.detalle', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumno $alumno)
    {
         //validaciones genericas
         $request->validate([
            'nombre'=>['required'],
            'apellidos'=>['required'],
            'mail'=>['required', 'unique:alumnos,mail, '.$alumno->id]
        ]);

        $alumno->nombre=ucwords($request->nombre);
        $alumno->apellidos=ucwords($request->apellidos);
        $alumno->mail=$request->mail;
       
        if($request->has('logo')){
            $request->validate([
                'logo'=>['image']
            ]);

            $file=$request->file('logo'); //metemos foto en una variable (yo me entiendo)
            $nom='logo/'.time()."_".$file->getClientOriginalName(); //importante
            Storage::disk('public')->put($nom, \File::get($file));
            
            
            $antigua=$alumno->logo;
            if(basename($antigua)!="default.jpg"){
                unlink($antigua);
            }
            $alumno->logo="img/$nom";
        }   
        $alumno->update();
            return redirect()->route('alumnos.index')->with('mensaje', 'Alumno Modificado con exito!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        //tener cuidado de borrar las imagenes salvo la de por defecto.
        $logo=$alumno->logo;
        if(basename($logo)!="default.jpg"){
            unlink($logo);
        }
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('mensaje', 'Alumno borrado con exito!!!');
    }
}
