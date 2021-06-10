<?php

namespace App\Exports;

use App\Models\Coupon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CouponExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Coupon::select('id', 'coupon_code', 'coupon_type', 'coupon_value', 'minimum_purchase', 'Exp_date','status')->get();
        return $data;
    }

    public function headings(): array
    {
        return [
            '#',
            'Coupon Code',
            'Coupon Type',
            'Coupon Value',
            'Minimum Purchase Amount',
            'Coupon Expire Date',
            'Status',
        ];
    }
}