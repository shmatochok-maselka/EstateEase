<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            'Ужгород',
            'Мукачево',
            'Хуст',//3
            'Виноградів',
            'Тячів',
            'Іршава',//6
            'Берегове',
            'Рахів',
            'Свалява',
            'Перечин',
            'Чоп',//11
            'Ужгородський р-н',
            'Мукачівський р-н',
            'Хустський р-н',
            'Тячівський р-н',
            'Берегівський р-н',
            'Рахівський р-н'//17
        ];

        foreach ($locations as $location) {
            $transliterator = transliterator_create('Ukrainian-Latin/BGN');
            $slug = Str::slug(transliterator_transliterate($transliterator, $location));
            $locationObject = Location::create([
                'name' => $location,
                'slug' => $slug
            ]);

            $locationObject->addMedia(storage_path('app\\public\\locations\\' . $slug . '.jpg'))->toMediaCollection('photo');
        }
    }
}
