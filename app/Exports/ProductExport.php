<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): Collection
    {
        return Product::with('user')->get()->map(function ($product) {
            return [
                'ID'       => $product->id,
                'Name'     => $product->name,
                'Quantity' => $product->quantity,
                'Price'    => $product->price,
                'Owner'    => $product->user->name ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Quantity', 'Price', 'Owner'];
    }
}
