<?php

namespace App\Exports;

use App\Models\OrderProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = OrderProduct::select('id','product_code', 'product_name', 'product_price', 'product_image', 'product_qyt')->get();
        return $data;
    }

    public function headings(): array
    {
        return [
            '#',
            'product_code',
            'product_name',
            'product_price',
            'product_image',
            'product_quantity',
        ];
    }
}