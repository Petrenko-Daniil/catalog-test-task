<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Http\Api\RandomWordApi;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedProducts();
    }

    /**
     * @throws \Exception
     */
    protected function seedProducts(int $amount = 10): void
    {
        $products = [];
        $nameWords = $this->getRandomWordsArray($amount);
        for ($i = 0; $i < $amount; $i++){
            $products[] = [
                'name' => $this->pickWordForAName($nameWords, $i),
                'price' => random_int(30, 100)
            ];
        }
        DB::table('products')->insert($products);
    }
    protected function pickWordForAName(array $words, int $iteration): string{
        if ($iteration > count($words)-1){
            $iteration = $iteration-count($words);
            return $this->pickWordForAName($words, $iteration).$iteration;
        }
        return $words[$iteration];
    }
    protected function getRandomWordsArray(int $count): array{
        return [
            'pasta',
            'pizza',
            'ham',
            'fish',
            'bread',
            'lobster',
            'cola'
        ];
        $api = new RandomWordApi();
        try {
            return $api->getRandomWords($count);
        } catch (GuzzleException|\Exception $e) {
            return [
                'pasta',
                'pizza',
                'ham',
                'fish',
                'bread',
                'lobster',
                'cola'
            ];
        }
    }

}
