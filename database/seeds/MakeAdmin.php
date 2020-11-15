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
        $this->make_admin('sam_here@outlook.com');
        $this->make_admin('anasismail28@gmail.com');
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
            if($user->hasRole('user')){
                echo "Already a user.\n";
                return;
            }
            else{
                $user->assignRole('user');
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
