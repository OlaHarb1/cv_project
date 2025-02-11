<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Country;
use App\Models\Roles\Permission;
use App\Models\Roles\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'superAdmin',
            'admin',
            'employee'
        ];
        $permissions = [
            //add
            'addSuperAdmin',
            'addAdmin',
            'addEmployee',

            //view
            'viewSuperAdmin',
            'viewAdmin',
            'viewEmployee',

            //delete
            'deleteSuperAdmin',
            'deleteAdmin',
            'deleteEmployee'
        ];
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $countryId = Country::where('name', 'Syria')->first()->_id;
        $statusId = Country::where('name', 'Damascus')->first()->_id;

        $business = new Business([
            'address' => 'sweida, syria',
            'name' => 'xcore',
            'countryId' => $countryId,
            'stateId' => $statusId,
        ]);
        $business->save();

        // Users
        $user1 = new User([
            'name' => 'jd3an',
            'email' => 'jd3an@gmail.com',
            'businessId' => $business->_id,
            'password' => Hash::make('123123123')
        ]);
        $user1->save();
        $user1->assignMainRole('superAdmin');

        $user1 = new User([
            'name' => 'fozy',
            'email' => 'fozy@gmail.com',
            'businessId' => $business->_id,
            'password' => Hash::make('123123123')
        ]);
        $user1->save();
        $user1->assignMainRole('admin');

        $user1 = new User([
            'name' => 'mohsan',
            'email' => 'mohsan@gmail.com',
            'businessId' => $business->_id,
            'password' => Hash::make('123123123')
        ]);
        $user1->save();
        $user1->assignMainRole('employee');
    }
}
