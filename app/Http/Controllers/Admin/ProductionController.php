<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductCategory;
use App\Models\Production;
use Auth;
use App\Models\Customer;

class ProductionController extends AdminBaseController
{

    public function getTitle()
    {
        return 'Danh sách sản phẩm';
    }

    public function index()
    {
        $filter = request()->all();

        $data = Production::with(['product_details']);
        if ($filter)
        {
            unset($filter['_token']);
            foreach ($filter AS $key => $filters)
            {
                if(empty($filters))
                {
                    unset($filter[$key]);
                }
                else
                {
                    $data = $data->where($key, $filters);
                }

            }
        }
        $data = $data->orderBy('product_create_date', 'desc')->paginate();
        $productCategory = ProductCategory::all()->toArray();

        return view('admin.production.index', [
            'title' => $this->getTitle(),
            'routeLink' => request()->getRequestUri(),
            'data' => $data,
            'productCategory' => $productCategory,
            'filter' => $filter
        ]);
    }

    public function save()
    {
        $data = request()->all();

        if (!isset($data['customer_name']) || empty($data['customer_name']))
        {
            return response()->redirectToRoute('admin.customer.index')->with('error_message', 'Chưa nhập tên khách');
        }
        if (!isset($data['email']) || empty($data['email']))
        {
            return response()->redirectToRoute('admin.customer.index')->with('error_message', 'Chưa nhập email khách');
        }
        if (!isset($data['mobile']) || empty($data['mobile']))
        {
            return response()->redirectToRoute('admin.customer.index')->with('error_message', 'Chưa nhập mobile khách');
        }
        if (!isset($data['address']) || empty($data['address']))
        {
            return response()->redirectToRoute('admin.customer.index')->with('error_message', 'Chưa nhập địa chỉ khách');
        }
        if (!isset($data['customer_group']) || empty($data['customer_group']))
        {
            return response()->redirectToRoute('admin.customer.index')->with('error_message', 'Chưa nhập nhóm khách');
        }
        if (!isset($data['date']) || empty($data['date']))
        {
            return response()->redirectToRoute('admin.customer.index')->with('error_message', 'Chưa nhập ngày sinh của khách');
        }

        list($yob, $mob, $dob) = explode('-', $data['date']);

        if (isset($data['customer_id']) && $data['customer_id'])
        {
            $customer = Customer::find($data['customer_id']);
            if ($customer)
            {
                $customer->update([
                    'customer_name' => $data['customer_name'],
                    'email' => $data['email'],
                    'mobile' => $data['mobile'],
                    'address' => $data['address'],
                    'dob' => $dob,
                    'mob' => $mob,
                    'yob' => $yob,
                    'customer_group_id' => $data['customer_group'],
                    'updated_date' => date('Y-m-d H:i:s', time())
                ]);
                return response()->redirectToRoute('admin.customer.index')->with('success_message', 'Cập nhật thành công');
            }
            else
            {
                return response()->redirectToRoute('admin.customer.index')->with('error_message', 'Cập nhật thất bại');
            }
        }
        else
        {
            $result = Customer::insert([
                'customer_name' => $data['customer_name'],
                'email' => $data['email'],
                'mobile' => $data['mobile'],
                'address' => $data['address'],
                'dob' => $dob,
                'mob' => $mob,
                'yob' => $yob,
                'customer_group_id' => $data['customer_group'],
                'created_date' => date('Y-m-d H:i:s', time())
            ]);
            if ($result)
            {
                return response()->redirectToRoute('admin.customer.index')->with('success_message', 'Thêm thành công');
            }
            return response()->redirectToRoute('admin.customer.index')->with('error_message', 'Thêm thất bại');
        }
    }
}
