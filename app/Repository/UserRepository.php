<?

namespace App\Repository;

use App\Contracts\Repository;
use App\Contracts\RepositoryWithSoftDelete;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements RepositoryWithSoftDelete {

    function registrar(array $datos): Model{
        $usuario= new User();
        $usuario->name=$datos["name"];
        $usuario->email=$datos["email"];
        $usuario->save();
        return $usuario;
    }

    function actualizar(array $datos): Model
    {
        $usuario= $this->consultarPorId($datos["id"]);
        $usuario->name=$datos["name"];
        $usuario->email=$datos["email"];
        $usuario->save();
        return $usuario;
    }

    function actualizarClave(array $datos): Model
    {
        $usuario= $this->consultarPorId($datos["id"]);
        $usuario->password=Hash::make($datos["password"]);
        $usuario->save();
        return $usuario;
    }

    function actualizarPin(array $datos): void
    {
        $usuario= $this->consultarPorId($datos["id"]);
        $usuario->pin=$datos["pin"];
        $usuario->save();
    }

    function actualizarVerificarEmail(array $datos): void
    {
        $usuario= $this->consultarPorId($datos["id"]);
        $usuario->email_verified_at=$datos["email_verified_at"];
        $usuario->save();
    }

    function consultarPorId(int $id): Model | null
    {
        return User::find($id);
    }

    function consultarTodo(): Collection
    {
        return User::all();
    }

    function eliminar(int $id): void
    {
        $usuario=$this->consultarPorId($id);
        $usuario->delete();
    }

    function consultarTodoDeLaPapelera(): Collection
    {
        return User::onlyTrashed()->get();
    }

    function consultarPorIdEnLaPapelera($id): Model | null
    {
        return User::onlyTrashed()->find($id);
    }

    function recuperarDeLaPapeleraPorId(int $id): Model | null
    {
        User::onlyTrashed()->find($id)->restore();
        return $this->consultarPorId($id);
    }

    function eliminarDeLaPapelera(int $id): void
    {
        User::onlyTrashed()->find($id)->forceDelete();
    }

}

?>
