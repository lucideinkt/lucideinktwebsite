<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerOrders extends Component
{
    use WithPagination;

    public function render()
    {
        $user = auth()->user();
        $customer = Customer::where('billing_email', $user->email)->first();
        
        if (!$customer) {
            $orders = Order::whereRaw('1=0')->paginate(10);
        } else {
            $orders = Order::where('customer_id', $customer->id)
                ->with(['items', 'customer'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('livewire.customer-orders', [
            'orders' => $orders,
        ]);
    }
}

