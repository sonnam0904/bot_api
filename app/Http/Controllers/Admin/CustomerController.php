<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Customer;

class CustomerController extends AdminBaseController
{

    public function getTitle()
    {
        return 'Danh sách khách hàng';
    }

    public function index()
    {
        $data = Customer::with(['customer_group'])->orderBy('created_date', 'desc')->paginate();

        return view('admin.customer.index', [
            'title' => $this->getTitle(),
            'routeLink' => request()->getRequestUri(),
            'data' => $data
        ]);
    }
}
