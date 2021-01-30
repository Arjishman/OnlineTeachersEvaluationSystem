<?php

namespace App\Imports;

use App\Studentinfo;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class StudentImport implements ToModel,WithHeadingRow,SkipsOnError
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Studentinfo([
            'sid' => $row['sid'],
            'sname' => $row['sname'],
            'semail' => $row['semail'],
            'deptcode' => $row['deptcode'],
        ]);
    }

    /**
     * @inheritDoc
     */

    /**
     * @inheritDoc
     */
    public function onError(Throwable $e)
    {
        // TODO: Implement onError() method.
    }
}
