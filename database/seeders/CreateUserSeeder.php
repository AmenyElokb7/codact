<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =[
            ['name'=>'publisher',
            'email'=>"publisher@gmail.com",
            'address'=>"Sousse",
            'phoneno' =>"50779969",
            'password'=>bcrypt('123456'),
            ],
            ['name'=>'subscriber',
            'email'=>"subscriber@gmail.com",
            'address'=>"Tunis",
            'phoneno' =>"50779969",
            'password'=>bcrypt('123456'),
            ],
            ['name'=>'admin',
            'email'=>"admin@gmail.com",
            'phoneno' =>"50779969",
            'address'=>"Sfax",
            'password'=>bcrypt('123456'),
            ],
    ];
    foreach ($users as $user){
        User::create($user);
    }
    }
}
