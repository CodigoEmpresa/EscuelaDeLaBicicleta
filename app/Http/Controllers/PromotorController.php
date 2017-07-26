<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GuardarPromotor;
use App\Http\Controllers\Controller;
use App\Modulos\Promotores\Promotores;
use App\Modulos\Persona\Persona;
use App\Modulos\Escuela\Promotor;
use Idrd\Usuarios\Repo\Documento;
use Idrd\Usuarios\Repo\Pais;
use Idrd\Usuarios\Repo\Etnia;
use Idrd\Parques\Repo\Localidad;
use Idrd\Usuarios\Repo\PersonaInterface;

class PromotorController extends Controller {

	protected $repositorio_personas;

	public function __construct(PersonaInterface $repositorio_personas)
	{
		$this->repositorio_personas = $repositorio_personas;
	}

	public function index()
	{
		$elementos = Persona::has('promotor')
							->with('promotor')
							->orderBy('Cedula', 'ASC')
							->get();

		$lista = [
	        'elementos' => $elementos,
	        'status' => session('status')
		];

		$datos = [
			'seccion' => 'Promotores',
			'titulo' => 'Promotores',
			'lista'	=> view('idrd.promotores.lista', $lista)
		];

		return view('list', $datos);
	}

	public function crear()
	{
		return $this->cargarFormulario(null);
	}

	public function editar(Request $request, $id)
	{
		$persona = $this->repositorio_personas->obtener($id);
		$promotor = Persona::with('promotor')
						->where('Id_Persona', $persona->Id_Persona)
						->first();

		return $this->cargarFormulario($promotor);
	}

    public function reporte()
    {
        $datos = [
            'titulo' => 'Reporte',
            'seccion' => 'Reporte',
            'formulario' => ''
        ];


        return view('reporte',$datos);


    }

	public function procesar(GuardarPromotor $request)
	{
        if ($request->input('Id_Persona') == '0')
        	$persona = $this->repositorio_personas->guardar($request->all());
        else
        	$persona = $this->repositorio_personas->actualizar($request->all());

        $profesor = Persona::with('promotor', 'tipoDocumento')
			->where('Id_Persona', $persona->Id_Persona)
			->first();

		$promotor = Promotor::where('Id_Persona', $persona->Id_Persona)
								->first();

		if ($promotor)
		{
			if($promotor->trashed())
				$promotor->restore();

			$promotor->save();
		} else {
			$promotor = new Promotor;

			$profesor->promotor()->save($promotor);
		}

        return redirect('/promotores/'.$persona['Id_Persona'].'/editar')->with(['status' => 'success']);
	}

	private function cargarFormulario($persona)
	{
		$formulario = [
			'persona' => $persona,
			'documentos' => Documento::all(),
	        'paises' => Pais::all(),
	        'etnias' => Etnia::all(),
	        'localidades' => Localidad::all(),
	        'status' => session('status')
		];

		$datos = [
			'titulo' => 'Crear ó editar promotores',
			'seccion' => 'Promotores',
			'formulario' => view('idrd.promotores.formulario', $formulario)
		];

		return view('form', $datos);
	}
}
