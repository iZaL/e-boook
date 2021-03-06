<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    private $tables = [
        'users',
        'password_resets',
        'roles',
        'user_roles',
        'permissions',
        'role_permissions',
        'categories',
        'types',
        'books',
        'previews',
        'book_previews',
        'book_readers',
        'book_metas',
        'purchases',
        'book_user'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //if ( App::environment() == 'local' ) {
            Model::unguard();
            $this->cleanDatabase();
                $this->call('UsersTableSeeder');
                $this->call('BooksTableSeeder');
                $this->call('CategoriesTableSeeder');
                $this->call('BookMetasTableSeeder');
                $this->call('ContactusTableSeeder');
                $this->call('RolesTableSeeder');
        //}

    }

    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ( $this->tables as $table ) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
