<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    public function index()
    {
        $user = User::all();
        return view('users/index', compact('user'));
    }

    public function create()
    {
        $roles = Role::pluck('name')
                    ->all(); 
        return view('users/create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'same:confirm-password'],
            'roles' => 'required'
        ]);
        $allInput = $request->except('_token');
        /* Hash:make es hashing seguro de Bcrypt y Argon2 
        para almacenar contraseñas */
        $allInput['password'] = Hash::make($allInput['password']);
        $user = User::create($allInput);
        //AssignRole proviene de Spatie.
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index');   
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name')->all();
        $userRol = $user->roles->pluck('name')->all();
        return view('users/edit', compact('user', 'roles', 'userRol'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            //Rule::unique()->ignore() ignora el correo electrónico actual del usuario.
            'email' => ['required', 'string', 'email', 'max:255', 
            Rule::unique('users')->ignore($id)],
            'password' => ['same:confirm-password'],
            'roles' => 'required'
        ]);
        $allInput = $request->except('_token');
        /* En caso de que password no esté vacío, se le volverá a asignar
        una contraseña encriptada. De no ser así, se excluirá la password
        del array (sin que afecte al array en sí) */
        if (!empty($allInput['password'])) {
            //Si existe la contraseña, verificar que sea string y tenga mínimo 8 carácteres. 
            $this->validate($request, [
                'password' => ['string', 'min:8', 'max:20']
            ]);
            $allInput['password'] = Hash::make($allInput['password']);       
        }
        else {
            $allInput = Arr::except($allInput, array('password'));
        }
        $user = User::find($id);
        $user->update($allInput);
        
        DB::table('model_has_roles')
        ->where('model_id', $id)
        ->delete(); 
        $user->assignRole($request->input('roles'));    
        //AssignRole proviene de Spatie.  
        return redirect()->route('users.index'); 
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index'); 
    }
}
