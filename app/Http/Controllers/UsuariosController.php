<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Response;


class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $user = Usuarios::where('nombre', 'like', '%'.$request->search.'%')
                    ->orWhere('telefono', $request->search)
                    ->orWhere('apellido', $request->search)
                    ->get();
        }else{
            $user = Usuarios::all();
        }
       
        return $user;
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
        if(Usuarios::where('email', $request->email)->exists()){

           return $response = Response::json($request, 200);
               
        }else{
            $users = Usuarios::create($request->all());
            return $users;
        }
        
     
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users= Usuarios::findOrFail($id);
        return $users;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuarios $usuarios)
    {
        $users= Usuarios::findOrFail($usuarios);
        return $users;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Usuarios $usuarios)
    {
        // $users= Usuarios::findOrFail($usuarios);
        $users=Usuarios::findOrFail($id)->update($request->all());
        return $users;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuarios $usuarios, $id)
    {
        $users=Usuarios::findOrFail($id)->delete();
    }
}
