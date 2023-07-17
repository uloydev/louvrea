<?php

namespace App\Services\Midtrans;

use App\Models\Order;
use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct(Order $order)
    {
        parent::__construct();

        $this->order = $order;
    }

    public function getSnapToken()
    {
        $params = [
            'transaction_details' => [
                'order_id' => $this->order->id,
                'gross_amount' => $this->order->grand_total,
            ],
            'item_details' => $this->order->orderItems->map(function ($item) {
                return [
                    'id' => $item->product_id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'name' => $item->product->name
                ];
            })->toArray(),
            'customer_details' => [
                'first_name' => $this->order->full_name,
                'email' => $this->order->customer->email,
                'phone' => $this->order->phone,
            ]
        ];

        $resp = Snap::createTransaction($params);

        return $resp;
    }
}
