<?php

namespace App\Exports;

use App\Models\FrontUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return FrontUser::get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Mobile',
            'Address',
            'City',
            'State',
            'Country',
            'Pincode',
            'Status',
            'Google Id',
            'Facebook Id',
            'Github Id',
            'Password',
            'created_at',
            'updated_at'
        ];
    }
}