<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('users');
        Storage::makeDirectory('/public/users');
        chmod(base_path().'/storage/app/public/users', 0777);

        $superAdmin = Role::create(['name' => 'Super Administrador', 'display_name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Administrador','display_name'=>'Admin']);
        $teacher = Role::create(['name' => 'Profesor','display_name'=>'Teacher']);
        $student = Role::create(['name' => 'Alumno','display_name'=>'Student']);

        $createRolePermission = Permission::create(['name' => 'Crear roles']);
        $updateRolePermission = Permission::create(['name' => 'Editar roles']);
        $deleteRolePermission = Permission::create(['name' => 'Borrar roles']);

        $viewUserPermission = Permission::create(['name' => 'Ver usuarios']);
        $createUserPermission = Permission::create(['name' => 'Crear usuarios']);
        $updateUserPermission = Permission::create(['name' => 'Editar usuarios']);
        $deleteUserPermission = Permission::create(['name' => 'Borrar usuarios']);

        $viewPhotographiesPermission = Permission::create(['name' => 'Ver fotografias']);
        $createPhotographiesPermission = Permission::create(['name' => 'Crear fotografias']);
        $updatePhotographiesPermission = Permission::create(['name' => 'Editar fotografias']);
        $deletePhotographiesPermission = Permission::create(['name' => 'Borrar fotografias']);

        $viewVideosPermission = Permission::create(['name' => 'Ver videos']);
        $createVideosPermission = Permission::create(['name' => 'Crear videos']);
        $updateVideosPermission = Permission::create(['name' => 'Editar videos']);
        $deleteVideosPermission = Permission::create(['name' => 'Borrar videos']);

        $viewPointsOfInterestPermission = Permission::create(['name' => 'Ver puntos de interes']);
        $createPointsOfInterestPermission = Permission::create(['name' => 'Crear puntos de interes']);
        $updatePointsOfInterestPermission = Permission::create(['name' => 'Editar puntos de interes']);
        $deletePointsOfInterestPermission = Permission::create(['name' => 'Borrar puntos de interes']);

        $viewPlacesPermission = Permission::create(['name' => 'Ver lugares']);
        $createPlacesPermission = Permission::create(['name' => 'Crear lugares']);
        $updatePlacesPermission = Permission::create(['name' => 'Editar lugares']);
        $deletePlacesPermission = Permission::create(['name' => 'Borrar lugares']);

        $viewThematicAreasPermission = Permission::create(['name' => 'Ver areas tematicas']);
        $createThematicAreasPermission = Permission::create(['name' => 'Crear areas tematicas']);
        $updateThematicAreasPermission = Permission::create(['name' => 'Editar areas tematicas']);
        $deleteThematicAreasPermission = Permission::create(['name' => 'Borrar areas tematicas']);

        $charRankingtPermission=Permission::create(['name'=>'Ver ranking de puntos de intereses']);
        $chartVisitsPermission=Permission::create(['name'=>'Ver gráfico de visitas']);
        $chartPointOfInterestPermission=Permission::create(['name'=>'Ver gráfico de creaciones de puntos de intereses']);
        $chartNewsRegistrationPermission=Permission::create(['name'=>'Ver contador de nuevos registros']);
        $chartCountPhotosAndVideosPermission=Permission::create(['name'=>'Ver contador de fotos y vídeos registrados']);


        $student->givePermissionTo([$createPhotographiesPermission, $updatePhotographiesPermission, $createVideosPermission,$updateVideosPermission,
            $chartCountPhotosAndVideosPermission,$charRankingtPermission]);
        $teacher->givePermissionTo([$viewPhotographiesPermission,$updatePhotographiesPermission,$deletePhotographiesPermission,
            $viewVideosPermission,$updateVideosPermission,$deleteVideosPermission,
            $viewPointsOfInterestPermission,$createPointsOfInterestPermission,$updatePointsOfInterestPermission,
            $viewPlacesPermission,$createPlacesPermission,$updatePlacesPermission,
            $viewThematicAreasPermission, $createThematicAreasPermission,$updateThematicAreasPermission,
            $chartCountPhotosAndVideosPermission,$charRankingtPermission
            ]);

        $user = new User;
        $user->login = 'director';
        $user->name = 'Jose Antonio';
        $user->surnames = 'Alcázar Torres';
        $user->password = '30010978';
        $user->email = 'iescierva@gmail.com';
        $user->save();

        $user->assignRole($admin);

        $user = new User;
        $user->login = 'fran9614';
        $user->name = 'Fran';
        $user->surnames = 'Arce Codina';
        $user->email = 'franarcecodina96@gmail.com';
        $user->password = 'daw_2019';
        $user->save();

        $user->assignRole($admin);

        $user = new User;
        $user->login = 'jorgicoor1998@gmail.com';
        $user->login = 'jorgicoor1998';
        $user->name = 'Jorge';
        $user->surnames = 'Orenes Rubio';
        $user->email = 'jorgicoor1998@gmail.com';
        $user->password = 'pokemon12';
        $user->save();

        $user->assignRole($admin);

        $user = new User;
        $user->login = 'fulgen_daw2020';
        $user->name = 'Fulgencio';
        $user->surnames = 'Valera Alonso';
        $user->password = '654321';
        $user->email = 'fulgencio.valera@gmail.com';
        $user->save();
        $user->assignRole($superAdmin);
        $user->assignRole($admin);

        $users = factory(User::class,10)->make();

        $users->each(function($u) use($teacher) {
            $u->save();
            $u->assignRole($teacher);
        });
    }
}
