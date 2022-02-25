<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
class CategoryImport implements ToModel, WithValidation
{

    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category([
            'code'        => $row[0],
            'title'       => $row[1],
            'includes'    => $row[2],
            'excludes'    => $row[3],
        ]);
    }


    public function uniqueBy()
    {
        return 'code';
    }

    public function rules(): array
    {
        return [


             '0' =>  Rule::unique('categories', 'code')
        ];
    }

}
