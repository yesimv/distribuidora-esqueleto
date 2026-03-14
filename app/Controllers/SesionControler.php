<?php
namespace App\Controllers;

use App\Model\extras\Departamento;
use App\Model\extras\Empleado;
use App\Model\Usuario;
use Core\Auth;
use Core\Base\Controller;
use Core\Traits\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SesionController extends Controller{
    use ApiResponse;
    protected $model = Usuario::class;
    
    public function getSesion(Request $request, Response $response)
    {
        $datos = $request->getParsedBody();
        $email = $datos['email'];
        $password = $datos['password'];

        $usuario = $this->setSesion($email, $password);

        if ($usuario) {
            return $response
                ->withHeader('Location', '/index')
                ->withStatus(302);
        }

        return $response
            ->withHeader('Location', '/signin')
            ->withStatus(302);
    }

    public function cerrarSesion(Request $request, Response $response){
        
        Auth::closeSession();
        

    }



    public function setSesion($username,$password){
        
        foreach(Usuario::all() as $index => $valor){
            
            if($valor['email'] === $username && $valor['pwd'] === $password){
                if($valor['is_activo']==1){
                    if (!isset($_SESSION['sesion'])){
                        $_SESSION['sesion'] = [];
                    }

                }
                $empleado = Empleado::find($valor['id_entidad']);
                $nombre = $empleado['nombre'].' ' .$empleado['apellido_paterno'];
                $departamento = Departamento::find($empleado['id_departamento']);
                if($departamento['id_responsable'] == $empleado['id_empleado'] || $valor['is_superuser'] == 1){
                    $isAdmin = 1;
                }else{
                    $isAdmin = 0;
                }
                $_SESSION['sesion'] = [
                    'id_usuario' => $valor['id_user'],
                    'id_empleado' => $empleado['id_empleado'],
                    'id_departamento' => $empleado['id_departamento'],
                    'id_estacion' => $empleado['id_estacion'],
                    'email' => $valor['email'],
                    'nombre' => $nombre,
                    'isAdmin' => $isAdmin
                ];
                //debug($isAdmin);
                
                return Usuario::find($valor['id_user']);
            }

        }
        if (!isset($_SESSION['sesion'])){
            return 'Credenciales no validas, intente otra vez.';
        }
    }

    
 
}