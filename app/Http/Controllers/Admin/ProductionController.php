<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductCategory;
use App\Models\Production;
use App\Models\Customer;

class ProductionController extends AdminBaseController
{

    public function getTitle()
    {
        return 'Danh sách mẫu mã';
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

        if (!isset($data['product_category_id']) || empty($data['product_category_id']))
        {
            return response()->redirectToRoute('admin.production.index')->with('error_message', 'Chưa nhập chọn loại sản phẩm');
        }
        if (!isset($data['product_name']) || empty($data['product_name']))
        {
            return response()->redirectToRoute('admin.production.index')->with('error_message', 'Chưa nhập tên mẫu mã');
        }
        if (!isset($data['product_desc']) || empty($data['product_desc']))
        {
            return response()->redirectToRoute('admin.production.index')->with('error_message', 'Chưa nhập mô tả mẫu mã');
        }

        if (isset($data['product_id']) && $data['product_id'])
        {
            $productId = Production::find($data['product_id']);
            if ($productId)
            {
                $productId->update([
                    'product_category_id' => $data['product_category_id'],
                    'product_name' => $data['product_name'],
                    'product_desc' => $data['product_desc'],
                    'product_update_date' => date('Y-m-d H:i:s', time())
                ]);
                return response()->redirectToRoute('admin.production.index')->with('success_message', 'Cập nhật thành công');
            }
            else
            {
                return response()->redirectToRoute('admin.production.index')->with('error_message', 'Cập nhật thất bại');
            }
        }
        else
        {
            $result = Production::insert([
                'product_category_id' => $data['product_category_id'],
                'product_name' => $data['product_name'],
                'product_desc' => $data['product_desc'],
                'product_create_date' => date('Y-m-d H:i:s', time())
            ]);
            if ($result)
            {
                return response()->redirectToRoute('admin.production.index')->with('success_message', 'Thêm thành công');
            }
            return response()->redirectToRoute('admin.production.index')->with('error_message', 'Thêm thất bại');
        }
    }
}
