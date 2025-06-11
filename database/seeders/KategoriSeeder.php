<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $kategori = ['Politik', 'Olahraga', 'Teknologi', 'Hiburan', 'Lainnya'];

        foreach ($kategori as $nama) {
            Kategori::create(['nama' => $nama]);
        }
    }
}
