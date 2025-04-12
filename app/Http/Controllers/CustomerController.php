<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    private Customer $customer;

    public function __construct()
    {
        $this->customer = new Customer();
    }

        public function index(Request $request)
        {
            $query = Customer::query();
            if($request->filled('ho_ten'))
            {
                $query->where('ho_ten', 'LIKE', '%' . $request->ho_ten . '%');
            }

            $customers = $query->paginate(10);

            return view('admins.customers.index' , compact('customers'));
        }

        public function create()
        {
            return view('admins.customers.create');
        }

        public function show($id)
        {
            $customer = Customer::query()->findOrFail($id);
            return view('admins.customers.show', compact('customer'));
        }

        public function store(Request $request)
    {
        $dataValidate = $request->validate([
            'ho_ten' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:customers,email',
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'so_dien_thoai' => 'required|string|max:15',
            'dia_chi' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('hinh_anh')) {
            $imagePath = $request->file('hinh_anh')->store('images/customers', 'public');
            $dataValidate['hinh_anh'] = $imagePath;
        }

        Customer::create($dataValidate);

        return redirect()->route('admins.customers.index')->with('success', 'Thêm khách hàng thành công');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admins.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $dataValidate = $request->validate([
            'ho_ten' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:customers,email,' . $id,
            'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'so_dien_thoai' => 'required|numeric|digits:10',
            'dia_chi' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('hinh_anh')) {
            $imagePath = $request->file('hinh_anh')->store('images/customers', 'public');
            $dataValidate['hinh_anh'] = $imagePath;

            if ($customer->hinh_anh)
            {
                Storage::disk('public')->delete($customer->hinh_anh);
            }
        }

        $customer->update($dataValidate);

        return redirect()->route('admins.customers.index')->with('success', 'Cập nhật khách hàng thành công');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();

        return redirect()->route('admins.customers.index')->with('success', 'Xóa khách hàng thành công');
    }

    public function thungrac()
    {
        $customers = Customer::onlyTrashed()->get();
        return view('admins.customers.thungrac', compact('customers'));
    }

    public function restore($id)
    {
        $customers = Customer::onlyTrashed()->findOrFail($id);
        $customers->restore();
        return redirect()->route('admins.customers.thungrac')->with('success' , 'Khôi phục khách hàng thành công');
    }

   public function forceDelete($id)
    {
        $customer = Customer::onlyTrashed()->findOrFail($id);
        if ($customer->hinh_anh)
        {
            Storage::disk('public')->delete($customer->hinh_anh);
        }
        $customer->forceDelete();
        return redirect()->route('admins.customers.thungrac')->with('success' , 'Xóa vĩnh viễn khách hàng thành công');
    }
    }