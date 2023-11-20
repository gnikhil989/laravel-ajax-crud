<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUser implements FromCollection, WithHeadings
{
    public function collection()
    {
        return collect([]); // Return an empty collection for no data rows.
    }

    public function headings(): array
    {
        return ['name', 'email','password']; // Specify the column headers.
    }
}
