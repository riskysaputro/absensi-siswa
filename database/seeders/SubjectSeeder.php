<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $subjects = [
            'MTK',
            'B.Inggris',
            'B.Indo',
            'IPA',
            'IPS',
        ];

        foreach ($subjects as $subject) {
            Subject::create([
                'subject_name' => $subject,
                'description' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
