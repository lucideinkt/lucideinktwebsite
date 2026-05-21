<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $tab = request('tab', 'customers');

        $customerQuery = Customer::withCount('orders')
            ->with('orders')
            ->orderBy('created_at', 'desc');

        if ($search = request('search')) {
            $customerQuery->where(function ($q) use ($search) {
                $q->where('billing_first_name', 'like', '%' . $search . '%')
                  ->orWhere('billing_last_name', 'like', '%' . $search . '%')
                  ->orWhere('billing_email', 'like', '%' . $search . '%');
            });
        }

        $userQuery = User::where('role', 'user')->orderBy('created_at', 'desc');

        if ($search = request('search')) {
            $userQuery->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                  ->orWhere('last_name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $customers = $customerQuery->paginate(15)->withQueryString();
        $users     = $userQuery->paginate(15)->withQueryString();

        return view('customers.index', compact('customers', 'users', 'tab'));
    }

    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);

        return view('customers.show', ['customer' => $customer]);
    }
}
