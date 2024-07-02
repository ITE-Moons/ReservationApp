<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
        INSERT INTO `users` (`id`, `name`, `user_name`, `email`, `password`, `role`,`balance`,  `created_at`, `updated_at`) VALUES
        (1, 'admin',  'admin', 'admin@admin.com', '$2y$10\$WkBvZ.DEI5QtHyczvyfhPOG3XRxExmtxluUzaYSHKNBD7MvEelD1e','ADMIN',  0, NULL, NULL),
        (2, 'investor',  'investor', 'investor@investor.com', '$2y$10\$WkBvZ.DEI5QtHyczvyfhPOG3XRxExmtxluUzaYSHKNBD7MvEelD1e','INVESTOR', 0, NULL, NULL),
        (3, 'user',  'user', 'user@user.com', '$2y$10\$WkBvZ.DEI5QtHyczvyfhPOG3XRxExmtxluUzaYSHKNBD7MvEelD1e','USER', 0, NULL, NULL);
        ");
    }
}
