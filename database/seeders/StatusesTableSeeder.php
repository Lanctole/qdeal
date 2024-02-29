<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $statuses = ['Open', 'In Progress', 'Resolved', 'Reopened', 'Closed'];

        foreach ($statuses as $status) {
            Status::create(['name' => $status]);
        }
    }
}
