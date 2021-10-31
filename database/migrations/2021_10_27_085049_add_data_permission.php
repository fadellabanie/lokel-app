<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('permissions')->truncate();

        DB::table('role_has_permissions')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Role::create(['name' => 'super admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'support']);

        ## Users
        Permission::create(['name' => 'access users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'export users']);
        Permission::create(['name' => 'freeze users']);

        ## Admins
        Permission::create(['name' => 'access admins']);
        Permission::create(['name' => 'create admins']);
        Permission::create(['name' => 'edit admins']);
        Permission::create(['name' => 'delete admins']);
        Permission::create(['name' => 'export admins']);

        ## Roles
        Permission::create(['name' => 'access roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);
        ## AppSetting
        Permission::create(['name' => 'access notifications']);
        Permission::create(['name' => 'send notifications']);
        Permission::create(['name' => 'access app settings']);
        Permission::create(['name' => 'access activity logs']);

        ## Static Page
        Permission::create(['name' => 'access static page']);
        Permission::create(['name' => 'create static page']);
        Permission::create(['name' => 'edit static page']);
        Permission::create(['name' => 'delete static page']);


        $role = Role::whereName('super admin')->first();

        $permission = Permission::get();
        $role->givePermissionTo($permission);

        $user = User::where('email', 'admin@admin.com')->first();
       
        $user->assignRole('super admin');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('model_has_permissions')->truncate();
            DB::table('model_has_roles')->truncate();
            DB::table('role_has_permissions')->truncate();
            DB::table('permissions')->truncate();
            DB::table('roles')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        });
    }
}
