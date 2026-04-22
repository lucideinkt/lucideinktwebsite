<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $orders = Order::with(['items', 'customer'])
            ->orderBy('created_at', 'desc')
            ->get();

        $rows = collect();
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $rows->push([
                    $order->id,
                    $order->customer_id,
                    optional($order->customer)->billing_first_name . ' ' . optional($order->customer)->billing_last_name,
                    optional($order->customer)->billing_email,
                    $order->status,
                    $order->total,
                    $order->total_after_discount,
                    $order->discount_code_checkout,
                    $order->discount_type,
                    $order->discount_value,
                    $order->discount_price_total,
                    $order->paid_at,
                    $order->created_at,
                    $item->product_id,
                    $item->product_name,
                    $item->quantity,
                    $item->unit_price,
                    $item->subtotal,
                ]);
            }
        }
        return $rows;
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Customer ID',
            'Customer Name',
            'Customer Email',
            'Order Status',
            'Order Total',
            'Order Total After Discount',
            'Discount Code',
            'Discount Type',
            'Discount Value',
            'Discount Price Total',
            'Paid At',
            'Order Created At',
            'Product ID',
            'Product Name',
            'Quantity',
            'Unit Price',
            'Subtotal',
        ];
    }
}
