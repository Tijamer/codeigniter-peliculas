<?php

namespace App\Database\Seeds;

use App\Models\CategoriaModel;
use CodeIgniter\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        //$this -> db->table('Categorias');
        //$CategoriaModel new CategoriaModel();

        $this -> db->table('Categorias')->where('id >=',1)->delete();
        for ($i=0; $i < 20; $i++) { 
            $this->db->table('categorias')->insert([
                'titulos' => "test Seeder $i"
            ]);
        }
        
    }
}
