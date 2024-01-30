<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatementType;

class StatementTypes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            $data = [
                ['id' => 1, 'name' => 'Depósito'],
                ['id' => 2, 'name' => 'Saque'],
                ['id' => 3, 'name' => 'Trans. Pagar'],
                ['id' => 4, 'name' => 'Trans. Receber']
            ];

            foreach ($data as $creatData) {
                StatementType::updateOrCreate(['id' => $creatData['id']], $creatData);
            }
        }
    }
}
