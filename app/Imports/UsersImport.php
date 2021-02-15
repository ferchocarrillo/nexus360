<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToArray, WithHeadingRow
{
    public $array;


    public function array(array $array){
        $this->array = $array;
    }

}
