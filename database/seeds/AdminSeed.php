<?php

use Illuminate\Database\Seeder;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $add=new \App\Admin();
//        $add->id=1;
        $add->name='Admin';
        $add->password=bcrypt('password');
        $add->email='admin@admin.com';
        $add->save();

    }
}
