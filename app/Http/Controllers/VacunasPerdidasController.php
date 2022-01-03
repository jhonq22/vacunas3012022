<?php

namespace App\Http\Controllers;

use App\VacunasPerdidas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class VacunasPerdidasController extends Controller
{
    public function index()
    {
        $vacunas = DB::select("SELECT vacunas_perdidas.id, nombre_vacuna, numero_lote, causa_perdida ,fecha_vencimiento, numero_dosis_perdidas, users.name, estados.estado, centro_salud.centro_salud ,  vacunas_perdidas.created_at, vacunas_perdidas.updated_at
        FROM vacunas_perdidas
        LEFT JOIN tipo_vacunas on tipo_vacuna_id = tipo_vacunas.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN estados ON users.estado_id = estados.id
        LEFT JOIN centro_salud ON users.centro_salud_id = centro_salud.id
        ORDER BY vacunas_perdidas.id DESC");

        echo json_encode($vacunas); // para pasar en json
    }



    public function vacunasPerdidasApiMpps()
    {
        $vacunas = DB::select("SELECT vacunas_perdidas.id, tipo_vacuna_id , nombre_vacuna, causa_perdida , numero_lote, fecha_vencimiento, numero_dosis_perdidas, users.name, estados.estado, centro_salud.centro_salud ,  vacunas_perdidas.created_at, vacunas_perdidas.updated_at
        FROM vacunas_perdidas
        LEFT JOIN tipo_vacunas on tipo_vacuna_id = tipo_vacunas.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN estados ON users.estado_id = estados.id
        LEFT JOIN centro_salud ON users.centro_salud_id = centro_salud.id
        ORDER BY vacunas_perdidas.id DESC");

        echo json_encode($vacunas); // para pasar en json
    }


    public function ExcelVacunasPerdidas()
    {
        $vacunas = DB::select("SELECT estados.estado, centro_salud.centro_salud , nombre_vacuna, numero_dosis_perdidas, numero_lote,  fecha_vencimiento, causa_perdida , users.name AS nombre_vacunador
        FROM vacunas_perdidas
        LEFT JOIN tipo_vacunas on tipo_vacuna_id = tipo_vacunas.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN estados ON users.estado_id = estados.id
        LEFT JOIN centro_salud ON users.centro_salud_id = centro_salud.id
        ORDER BY vacunas_perdidas.id DESC");

        echo json_encode($vacunas); // para pasar en json
    }
      


    //ROL PARA ESTADAL //

    public function VacunasPerdidasEstado($estado_id)
    {
        $vacunas = DB::select("SELECT vacunas_perdidas.id, nombre_vacuna, numero_lote, causa_perdida, fecha_vencimiento, numero_dosis_perdidas, users.name, estados.estado, centro_salud.centro_salud ,  vacunas_perdidas.created_at, vacunas_perdidas.updated_at
        FROM vacunas_perdidas
        LEFT JOIN tipo_vacunas on tipo_vacuna_id = tipo_vacunas.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN estados ON users.estado_id = estados.id
        LEFT JOIN centro_salud ON users.centro_salud_id = centro_salud.id
        WHERE users.estado_id = ?
        ORDER BY vacunas_perdidas.id DESC", [$estado_id]);

        echo json_encode($vacunas); // para pasar en json
    }


    public function VacunasPerdidasEstadoExcel($estado_id)
    {
        $vacunas = DB::select("SELECT nombre_vacuna, numero_lote, fecha_vencimiento, causa_perdida, numero_dosis_perdidas, users.name, estados.estado, centro_salud.centro_salud ,  vacunas_perdidas.created_at, vacunas_perdidas.updated_at
        FROM vacunas_perdidas
        LEFT JOIN tipo_vacunas on tipo_vacuna_id = tipo_vacunas.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN estados ON users.estado_id = estados.id
        LEFT JOIN centro_salud ON users.centro_salud_id = centro_salud.id
        WHERE users.estado_id = ?
        ORDER BY vacunas_perdidas.id DESC", [$estado_id]);

        echo json_encode($vacunas); // para pasar en json
    }
























        // ROL CENTRO SALUD 

    public function VacunasPerdidasCentroSalud($centro_salud_id)
    {
        $vacunas = DB::select("SELECT vacunas_perdidas.id, nombre_vacuna, numero_lote, causa_perdida, fecha_vencimiento, numero_dosis_perdidas, users.name, estados.estado, centro_salud.centro_salud ,  vacunas_perdidas.created_at, vacunas_perdidas.updated_at
        FROM vacunas_perdidas
        LEFT JOIN tipo_vacunas on tipo_vacuna_id = tipo_vacunas.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN estados ON users.estado_id = estados.id
        LEFT JOIN centro_salud ON users.centro_salud_id = centro_salud.id
        WHERE users.centro_salud_id = ?
        ORDER BY vacunas_perdidas.id DESC", [$centro_salud_id]);

        echo json_encode($vacunas); // para pasar en json
    }


    public function VacunasPerdidasCentroSaludExcel($centro_salud_id)
    {
        $vacunas = DB::select("SELECT nombre_vacuna, numero_lote, fecha_vencimiento, causa_perdida, numero_dosis_perdidas, users.name, estados.estado, centro_salud.centro_salud ,  vacunas_perdidas.created_at, vacunas_perdidas.updated_at
        FROM vacunas_perdidas
        LEFT JOIN tipo_vacunas on tipo_vacuna_id = tipo_vacunas.id
        LEFT JOIN users ON user_id = users.id
        LEFT JOIN estados ON users.estado_id = estados.id
        LEFT JOIN centro_salud ON users.centro_salud_id = centro_salud.id
        WHERE users.centro_salud_id = ?
        ORDER BY vacunas_perdidas.id DESC", [$centro_salud_id]);

        echo json_encode($vacunas); // para pasar en json
    }











        
     public function store(Request $request)
    {
        $vacunado = new VacunasPerdidas();
        $vacunado->tipo_vacuna_id = $request->input('tipo_vacuna_id');
        $vacunado->numero_lote = $request->input('numero_lote');
        $vacunado->fecha_vencimiento = $request->input('fecha_vencimiento');
        $vacunado->numero_dosis_perdidas = $request->input('numero_dosis_perdidas');
        $vacunado->user_id = $request->input('user_id');
        $vacunado->causa_perdida = $request->input('causa_perdida');


        $vacunado->save(); // para guardar en json

        echo json_encode($vacunado); // para pasar en json
    }

   

    public function show($vacunado_id)
    {
        $vacunados =VacunasPerdidas::find($vacunado_id);
        echo json_encode($vacunados);
    }
      

   
    public function update(Request $request, $vacunado_id)
    {
        $vacunado =VacunasPerdidas::find($vacunado_id);
        $vacunado->tipo_vacuna_id = $request->input('tipo_vacuna_id');
        $vacunado->numero_lote = $request->input('numero_lote');
        $vacunado->fecha_vencimiento = $request->input('fecha_vencimiento');
        $vacunado->numero_dosis_perdidas = $request->input('numero_dosis_perdidas');
        $vacunado->user_id = $request->input('user_id');
        $vacunado->causa_perdida = $request->input('causa_perdida');

      
        $vacunado->save(); // para guardar en json

        echo json_encode($vacunado); // para pasar en json
    }



    
  
    public function destroy($vacunado_id)
    {
        $vacunado =VacunasPerdidas::find($vacunado_id);
        $vacunado->delete();
    }
}
