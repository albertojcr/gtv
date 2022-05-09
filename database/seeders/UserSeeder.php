<?php

namespace Database\Seeders;

use App\Models\ThematicArea;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('users');
        Storage::makeDirectory('/public/users');
        chmod(base_path().'/storage/app/public/users', 0777);

        $superAdminRole = Role::create(['name' => 'Super Administrador', 'display_name' => 'Super Admin']);
        $adminRole = Role::create(['name' => 'Administrador','display_name'=>'Admin']);
        $teacherRole = Role::create(['name' => 'Profesor','display_name'=>'Teacher']);
        $studentRole = Role::create(['name' => 'Alumno','display_name'=>'Student']);

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

        $charRankingtPermission = Permission::create(['name'=>'Ver ranking de puntos de intereses']);
        $chartVisitsPermission = Permission::create(['name'=>'Ver gráfico de visitas']);
        $chartPointOfInterestPermission = Permission::create(['name'=>'Ver gráfico de creaciones de puntos de intereses']);
        $chartNewsRegistrationPermission = Permission::create(['name'=>'Ver contador de nuevos registros']);
        $chartCountPhotosAndVideosPermission = Permission::create(['name'=>'Ver contador de fotos y vídeos registrados']);


        $studentRole->givePermissionTo([$createPhotographiesPermission, $updatePhotographiesPermission, $createVideosPermission,$updateVideosPermission,
            $chartCountPhotosAndVideosPermission,$charRankingtPermission]);
        $teacherRole->givePermissionTo([$viewPhotographiesPermission,$updatePhotographiesPermission,$deletePhotographiesPermission,
            $viewVideosPermission,$updateVideosPermission,$deleteVideosPermission,
            $viewPointsOfInterestPermission,$createPointsOfInterestPermission,$updatePointsOfInterestPermission,
            $viewPlacesPermission,$createPlacesPermission,$updatePlacesPermission,
            $viewThematicAreasPermission, $createThematicAreasPermission,$updateThematicAreasPermission,
            $chartCountPhotosAndVideosPermission,$charRankingtPermission
            ]);

        $superAdmin = new User;
        $superAdmin->login = 'superadmin';
        $superAdmin->password = '123456';
        $superAdmin->salt = 'salt-here';
        $superAdmin->email = 'superadmin@mail.com';
        $superAdmin->profile = 'Profile description here';
        $superAdmin->save();
        $superAdmin->assignRole($superAdminRole);

        $admin = new User;
        $admin->login = 'admin';
        $admin->password = '123456';
        $admin->salt = 'salt-here';
        $admin->email = 'admin@mail.com';
        $admin->profile = 'Profile description here';
        $admin->save();
        $admin->assignRole($adminRole);

        $teacher = new User;
        $teacher->login = 'teacher';
        $teacher->password = '123456';
        $teacher->salt = 'salt-here';
        $teacher->email = 'teacher@mail.com';
        $teacher->profile = 'Profile description here';
        $teacher->save();
        $teacher->assignRole($teacherRole);

        $student = new User;
        $student->login = 'student';
        $student->password = '123456';
        $student->salt = 'salt-here';
        $student->email = 'student@gmail.com';
        $student->profile = 'Profile description here';
        $student->save();
        $student->assignRole($studentRole);

        $thematicAreas = ThematicArea::all()->pluck('id')->toArray();
        foreach ($thematicAreas as $key => $value) {
            $admin->thematicAreas()->attach($value, [
                'date' => Carbon::now(),
                'active' => true,
            ]);
        }
    }
}
