<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1=Role::create(['name'=>'admin']);
        $role2=Role::create(['name'=>'invitado']);
        $role3=Role::create(['name'=>'estudiante']);

        Permission::create(['name'=>'listar_peliculas'])->syncRoles($role1,$role2,$role3);
        Permission::create(['name'=>'editar_peliculas'])->syncRoles($role1);
        Permission::create(['name'=>'crear_pelicula'])->syncRoles($role1);
        Permission::create(['name'=>'borrar_pelicula'])->syncRoles($role1);

        $users = User::where('name', '!=', 'admin')->get();
        foreach($users as $user){

            $user->assignRole('invitado');
        }
    }
    
}
