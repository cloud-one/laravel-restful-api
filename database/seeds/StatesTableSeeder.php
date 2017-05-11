<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("states")->insert([
            ["name" => "Acre",                "abbr" => "AC"],
            ["name" => "Alagoas",             "abbr" => "AL"],
            ["name" => "Amapá",               "abbr" => "AP"],
            ["name" => "Amazonas",            "abbr" => "AM"],
            ["name" => "Bahia",               "abbr" => "BA"],
            ["name" => "Ceará",               "abbr" => "CE"],
            ["name" => "Distrito Federal",    "abbr" => "DF"],
            ["name" => "Espírito Santo",      "abbr" => "ES"],
            ["name" => "Goiás",               "abbr" => "GO"],
            ["name" => "Maranhão",            "abbr" => "MA"],
            ["name" => "Mato Grosso do Sul",  "abbr" => "MS"],
            ["name" => "Mato Grosso",         "abbr" => "MT"],
            ["name" => "Minas Gerais",        "abbr" => "MG"],
            ["name" => "Paraná",              "abbr" => "PR"],
            ["name" => "Paraíba",             "abbr" => "PB"],
            ["name" => "Pará",                "abbr" => "PA"],
            ["name" => "Pernambuco",          "abbr" => "PE"],
            ["name" => "Piauí",               "abbr" => "PI"],
            ["name" => "Rio Grande do Norte", "abbr" => "RN"],
            ["name" => "Rio Grande do Sul",   "abbr" => "RS"],
            ["name" => "Rio de Janeiro",      "abbr" => "RJ"],
            ["name" => "Rondônia",            "abbr" => "RO"],
            ["name" => "Roraima",             "abbr" => "RR"],
            ["name" => "Santa Catarina",      "abbr" => "SC"],
            ["name" => "Sergipe",             "abbr" => "SE"],
            ["name" => "São Paulo",           "abbr" => "SP"],
            ["name" => "Tocantins",           "abbr" => "TO"],
        ]);

		$this->command->info('Estados criados');
    }
}
