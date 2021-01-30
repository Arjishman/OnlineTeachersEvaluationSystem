<?php

namespace App\Imports;

use App\Courseinfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class CourseImport implements ToModel,WithHeadingRow,SkipsOnError
{
    use Importable;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }

    /**
     * @inheritDoc
     */
    public function onError(Throwable $e)
    {
        // TODO: Implement onError() method.
    }

    /**
     * @inheritDoc
     */
    public function model(array $row)
    {
        return new Courseinfo([
           'courseid' => $row['courseid'],
           'year' => $row['year'],
           'semester' => $row['semester'],
           'part' => $row['part'],
           'teacherinfo_id' => $row['teacherinfo_id'],
           'deptcode' => $row['deptcode'],
        ]);
    }
}
