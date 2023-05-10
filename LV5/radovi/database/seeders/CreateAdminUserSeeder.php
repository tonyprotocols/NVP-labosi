<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use App\Models\User;

  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin', 
            'email' => 'admin@me.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'locale' => 'en',
        ]);
    }
}