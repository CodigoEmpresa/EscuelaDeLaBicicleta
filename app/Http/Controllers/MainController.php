<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Idrd\Usuarios\Repo\PersonaInterface;
use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Session;

class MainController extends Controller {

	protected $Usuario;
	protected $repositorio_personas;

	public function __construct(PersonaInterface $repositorio_personas)
	{
		if (isset($_SESSION['Usuario']))
			$this->Usuario = $_SESSION['Usuario'];

		$this->repositorio_personas = $repositorio_personas;
	}

	public function welcome()
	{
		$data = [
			'titulo' => 'Inicio',
			'seccion' => 'Inicio'
		];

		return view('welcome', $data);
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

    public function fecha_reporte(Request $request){

       return Datatables::of(DB::table('vista_reporte')->whereBetween('Fecha',[$request[0]['value'],$request[1]['value']]))->make(true);

    }

    public function index(Request $request)
	{
		//$fake_permissions = ['71766', '1', '1', '1'];
		$fake_permissions = null;

		if ($request->has('vector_modulo') || $fake_permissions)
		{	
			$vector = $request->has('vector_modulo') ? urldecode($request->input('vector_modulo')) : $fake_permissions;
			$user_array = is_array($vector) ? $vector : unserialize($vector);
			$permissions_array = $user_array;

			$permisos = [
				'administrar_promotores' => array_key_exists(1, $permissions_array) ? intval($permissions_array[1]) : 0,
				'administrar_jornadas' => array_key_exists(2, $permissions_array) ? intval($permissions_array[2]) : 0,
				'administrar_reportes' => array_key_exists(3, $permissions_array) ? intval($permissions_array[3]) : 0
			];

			$_SESSION['Usuario'] = $user_array;
            $persona = $this->repositorio_personas->obtener($_SESSION['Usuario'][0]);

			$_SESSION['Usuario']['Roles'] = [];
			$_SESSION['Usuario']['Persona'] = $persona;
			$_SESSION['Usuario']['Permisos'] = $permisos;
			$this->Usuario = $_SESSION['Usuario'];
		} else {
			if (!isset($_SESSION['Usuario']))
				$_SESSION['Usuario'] = '';
		}

		if ($_SESSION['Usuario'] == '')
			return redirect()->away('http://www.idrd.gov.co/SIM/Presentacion/');

		return redirect('/welcome');
	}

	public function logout()
	{
		$_SESSION['Usuario'] = '';
		Session::set('Usuario', ''); 

		return redirect()->to('/');
	}
}