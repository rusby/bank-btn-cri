<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collection\{
	Developer,
	DeveloperProject
};
use Illuminate\Support\Str;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Developer::insert([
        	[
        		'id' => Str::uuid()->toString(),
        		'developer_name' => "Developer 1"
        	],
        	[
        		'id' => Str::uuid()->toString(),
        		'developer_name' => "Developer 2"
        	],
        	[
        		'id' => Str::uuid()->toString(),
        		'developer_name' => "Developer 3"
        	],
        ]);

        DeveloperProject::insert([
        	[
        		'id' => Str::uuid()->toString(),
        		'developer_id' => 2,
        		'project_name' => "Project Name 1"
        	],
        	[
        		'id' => Str::uuid()->toString(),
        		'developer_id' => 2,
        		'project_name' => "Project Name 2"
        	],
        	[
        		'id' => Str::uuid()->toString(),
        		'developer_id' => 2,
        		'project_name' => "Project Name 3"
        	]
        ]);
    }
}
