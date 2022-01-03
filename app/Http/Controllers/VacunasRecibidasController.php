<?php

namespace App\Http\Controllers;

use App\VacunasRecibidas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VacunasRecibidasController extends Controller
{
    public function index()
    {
        $vacunas = DB::select("
        SELECT vacunas_recibidas.id,
        nombre_vacuna, numero_lote, fecha_vencimiento, componentes, grupo_especial, cantidad,cantidad_recibida, observacion,  estado, municipio, centro_salud, users.name as usuario_registrador, rol, vacunas_recibidas.created_at
        FROM vacunas_recibidas
        LEFT JOIN tipo_vacunas ON tipo_vacuna_id = tipo_vacunas.id
        LEFT JOIN estados ON estado_id = estados.id
        LEFT JOIN municipios ON municipio_id = municipios.id
        LEFT JOIN centro_salud ON centro_salud_id = centro_salud.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN roles ON users.rol_id = roles.id
        LEFT JOIN grupo_especiales ON grupo_especial_id = grupo_especiales.id
                    ");

        echo json_encode($vacunas); // para pasar en json
    }

    public function ListadoEstadal($estado_id)
    {
        $vacunas = DB::select("
        SELECT vacunas_recibidas.id,
        nombre_vacuna, numero_lote, fecha_vencimiento, componentes, grupo_especial, cantidad,cantidad_recibida, observacion,  estado, municipio, centro_salud, users.name as usuario_registrador, rol, vacunas_recibidas.created_at
        FROM vacunas_recibidas
        LEFT JOIN tipo_vacunas ON tipo_vacuna_id = tipo_vacunas.id
        LEFT JOIN estados ON estado_id = estados.id
        LEFT JOIN municipios ON municipio_id = municipios.id
        LEFT JOIN centro_salud ON centro_salud_id = centro_salud.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN roles ON users.rol_id = roles.id
        LEFT JOIN grupo_especiales ON grupo_especial_id = grupo_especiales.id
        WHERE vacunas_recibidas.estado_id = ?", 
        [$estado_id]);

        echo json_encode($vacunas); // para pasar en json
    }



    public function ListadoCentroSalud($centro_salud_id)
    {
        $vacunas = DB::select("
        SELECT vacunas_recibidas.id,
        nombre_vacuna, numero_lote, fecha_vencimiento, componentes, grupo_especial, cantidad,cantidad_recibida, observacion,  estado, municipio, centro_salud, users.name as usuario_registrador, rol, vacunas_recibidas.created_at
        FROM vacunas_recibidas
        LEFT JOIN tipo_vacunas ON tipo_vacuna_id = tipo_vacunas.id
        LEFT JOIN estados ON estado_id = estados.id
        LEFT JOIN municipios ON municipio_id = municipios.id
        LEFT JOIN centro_salud ON centro_salud_id = centro_salud.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN roles ON users.rol_id = roles.id
        LEFT JOIN grupo_especiales ON grupo_especial_id = grupo_especiales.id
        WHERE vacunas_recibidas.centro_salud_id = ?", 
        [$centro_salud_id]);

        echo json_encode($vacunas); // para pasar en json
    }












    public function listadoExcel()
    {
        $vacunas = DB::select("
        SELECT 
        nombre_vacuna, numero_lote, fecha_vencimiento, componentes, grupo_especial, cantidad, cantidad_recibida, observacion, estado, municipio, centro_salud, users.name as usuario_registrador, rol, vacunas_recibidas.created_at as fecha_registro
        FROM vacunas_recibidas
        LEFT JOIN tipo_vacunas ON tipo_vacuna_id = tipo_vacunas.id
        LEFT JOIN estados ON estado_id = estados.id
        LEFT JOIN municipios ON municipio_id = municipios.id
        LEFT JOIN centro_salud ON centro_salud_id = centro_salud.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN roles ON users.rol_id = roles.id
        LEFT JOIN grupo_especiales ON grupo_especial_id = grupo_especiales.id
                    ");

        echo json_encode($vacunas); // para pasar en json
    }

 
  
    public function store(Request $request)
    {
        $vacunado = new VacunasRecibidas();
        $vacunado->tipo_vacuna_id = $request->input('tipo_vacuna_id');
        $vacunado->numero_lote = $request->input('numero_lote');
        $vacunado->fecha_vencimiento = $request->input('fecha_vencimiento');
        $vacunado->componentes = $request->input('componentes');
        $vacunado->user_id = $request->input('user_id');
        $vacunado->cantidad = $request->input('cantidad');
        $vacunado->estado_id = $request->input('estado_id');
        $vacunado->municipio_id = $request->input('municipio_id');
        $vacunado->centro_salud_id = $request->input('centro_salud_id');
        $vacunado->cantidad_recibida = $request->input('cantidad_recibida');
        $vacunado->observacion = $request->input('observacion');
        $vacunado->grupo_especial_id = $request->input('grupo_especial_id');

        $vacunado->save(); // para guardar en json
        echo json_encode($vacunado); // para pasar en json
    }

 
    public function show($vacuna_id)
    {
        $vacunados =VacunasRecibidas::find($vacuna_id);
        echo json_encode($vacunados);
    }
      

   
    public function update(Request $request, $vacuna_id)
    {
        $vacunado =VacunasRecibidas::find($vacuna_id);
        $vacunado->tipo_vacuna_id = $request->input('tipo_vacuna_id');
        $vacunado->numero_lote = $request->input('numero_lote');
        $vacunado->fecha_vencimiento = $request->input('fecha_vencimiento');
        $vacunado->componentes = $request->input('componentes');
        $vacunado->user_id = $request->input('user_id');
        $vacunado->cantidad = $request->input('cantidad');
        $vacunado->estado_id = $request->input('estado_id');
        $vacunado->municipio_id = $request->input('municipio_id');
        $vacunado->centro_salud_id = $request->input('centro_salud_id');
        $vacunado->cantidad_recibida = $request->input('cantidad_recibida');
        $vacunado->observacion = $request->input('observacion');
        $vacunado->grupo_especial_id = $request->input('grupo_especial_id');

       
      
        $vacunado->save(); // para guardar en json

        echo json_encode($vacunado); // para pasar en json
    }

 
  

   
    public function destroy($vacuna_id)
    {
        $vacunado =VacunasRecibidas::find($vacuna_id);
        $vacunado->delete();
    }
}
