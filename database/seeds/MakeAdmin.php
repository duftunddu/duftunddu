<?php

// namespace App\Http\Controllers;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MakeAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->make_admin('test@test.com');
    }

    public function make_admin($email){
        $user = User::firstWhere('email', $email);
        if($user != NULL){
            if($user->hasRole('admin')){
                echo "Already an admin.\n";
                return;
            }
            else{
                $user->assignRole('admin');
                echo "Role Assigned.\n";
                return;
            }
        }
        else{
            echo "Email Address not found.\n";
            return;
        }
    }
}
