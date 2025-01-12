<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol1 = Role::create(['name' => 'Admin']);
        $rol2 = Role::create(['name' => 'Colaborador']);



       
         Permission::create(['name' => 'admin.create', 'description' => 'Crear publicacion'])->syncRoles([$rol1, $rol2]);
         Permission::create(['name' => 'admin.store', 'description' => 'Guardar publicacion'])->syncRoles([$rol1,$rol2]);
         Permission::create(['name' => 'admin.edit', 'description' => 'Editar publicacion'])->syncRoles([$rol1,$rol2]);
         Permission::create(['name' => 'admin.update', 'description' => 'Actualiar publicacion'])->syncRoles([$rol1,$rol2]);
         Permission::create(['name' => 'admin.destroy', 'description' => 'Eliminar publicacion'])->syncRoles([$rol1,$rol2]);
         Permission::create(['name' => 'admin.create.colaborador', 'description' => 'Ver mis publicaciones'])->syncRoles([$rol1, $rol2]);
         Permission::create(['name' => 'admin.top.index', 'description' => 'Top - Ver'])->syncRoles([$rol1, $rol2]);
         Permission::create(['name' => 'admin.top.store', 'description' => 'Top - Guardar'])->syncRoles([$rol1, $rol2]);
         Permission::create(['name' => 'admin.top.update', 'description' => 'Top - Actualizar'])->syncRoles([$rol1, $rol2]);
         Permission::create(['name' => 'admin.top.destroy', 'description' => 'Top - Eliminar'])->syncRoles([$rol1, $rol2]);
         Permission::create(['name' => 'admin.destroy.top.all', 'description' => 'Top - Eliminar Todo'])->syncRoles([$rol1, $rol2]);


         Permission::create(['name' => 'admin.index', 'description' => 'Ver Todas las publicaciones'])->syncRoles([$rol1]);
         Permission::create(['name' => 'admin.roles', 'description' => 'Ver Roles'])->syncRoles([$rol1]);
         Permission::create(['name' => 'admin.users', 'description' => 'Ver Usuario'])->syncRoles([$rol1]);
        
    }
}
