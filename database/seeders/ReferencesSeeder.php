<?php

namespace Database\Seeders;

use App\Models\Reference;
use Illuminate\Database\Seeder;

class ReferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $references = new Reference();
        $references->id = 1;
        $references->code = 'overtime_method';
        $references->name = 'Salary / 173';
        $references->expression = '(salary / 173) * overtime_duration_total';
        $references->save();

        $references = new Reference();
        $references->id = 2;
        $references->code = 'overtime_method';
        $references->name = 'Fixed';
        $references->expression = '10000 * overtime_duration_total';
        $references->save();
    }
}
