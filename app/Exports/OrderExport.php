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
        return OrderProduct::get();
    }

    public function headings(): array
    {
        return [
            '#',
            'order_id',
            'user_id',
            'product_id',
            'product_code',
            'product_name',
            'product_price',
            'product_image',
            'product_quantity',
            'created_at',
            'updated_at'
        ];
    }
}