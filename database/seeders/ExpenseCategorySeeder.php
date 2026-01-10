<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            'Travel',
            'Food & Meals',
            'Accommodation',
            'Transportation',
            'Office Supplies',
            'Internet & Communication',
            'Medical',
            'Training & Courses',
            'Client Entertainment',
            'Miscellaneous',
        ];

        foreach($categories as $name) {
            ExpenseCategory::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name]
            );
        }

        
    }
}
