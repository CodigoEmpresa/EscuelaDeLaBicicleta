<?php

namespace App\Http\Controllers;

use App\Modulos\Escuela\Usuario;
use Illuminate\Http\Request;
use App\Http\Requests\GenerarCertificado;
use PDF;

class CertificadoController extends Controller
{
    public function index()
    {
        $data = [
            'titulo' => 'Certificados',
            'seccion' => 'Certificados',
            'status' => session('status')
        ];

        return view('idrd.certificados.index', $data);
    }

    public function generar(GenerarCertificado $request)
    {
        $persona = Usuario::whereHas('jornadas', function($query){
            $query->where('Tipo', 'Ciclo expedición');
        })->where('Documento_Usuario', $request->input('documento'))->orderBy('Id_Usuario', 'desc')->first();

        if ($persona) {
            $pdf = PDF::loadView('idrd.certificados.diploma', ['nombre' => $persona->Nombre_Usuario]);
            $pdf->setPaper('a4', 'landscape')->setWarnings(false);

            return $pdf->download('diploma.pdf');
        } else {
            return redirect('/certificado')->with('status', 'sin terminar');
        }

    }
}
