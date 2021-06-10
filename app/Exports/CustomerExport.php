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
        $data = FrontUser::select('id', 'name', 'email', 'mobile', 'address', 'city', 'state', 'country', 'pincode')->get();
        return $data;
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
        ];
    }
}