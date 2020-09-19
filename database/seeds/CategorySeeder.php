<?php

use Illuminate\Database\Seeder;
use App\Category;

/**
 * Class CategorySeeder
 */
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert($this->generateCategoryEntries());
    }

    /**
     * @return array
     */
    private function generateCategoryEntries()
    {
        $entries = [];

        for ($i=1; $i <= DatabaseSeeder::COUNT_OF_CATEGORIES; $i++) {
            $entries[] = [
                'title' => 'Pizza category '.$i,
                'alias' => 'pizza-category-'.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return $entries;
    }
}
