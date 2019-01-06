<?php

use Illuminate\Database\Seeder;
use App\User;

class DefaultsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 3)->create()->each(function ($user) {
            $user->roles()->attach(2);
            $user->syncPermissions();
            $user->posts()->save(factory(App\Post::class)->make());
        });

        User::first()->update(['name' => 'Administrator', 'email' => 'admin@app.com']);
        User::first()->roles()->attach(1);
    }
}
