<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Customer;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private Contact $contact;

    private Customer $customer;

    public function __construct()
    {
        $this->contact = new Contact();

        $this->customer = new Customer();
    }

    public function index(Request $request)
    {
        $query = Contact::query();
        if($request->filled('so_dien_thoai')){
            $query->where('so_dien_thoai', 'LIKE', '%' . $request->so_dien_thoai . '%');
        }
        // Tương tự thực hiện tìm kiếm theo sản phẩm :
        // Không dùng all vì khi dùng all nó phải dùng for để lấy category => dư thừa dữ liệu 
        $contacts = $query->paginate(10);

        return view('admins.contacts.index', compact('contacts'));
    }

    public function create()
        {
            return view('admins.contacts.create');
        }

        public function show($id)
        {
            $contact = Contact::query()->findOrFail($id);
            return view('admins.contacts.show', compact('contact'));
        }

        public function store(Request $request)
    {
        $dataValidate = $request->validate([
            'ho_ten' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'so_dien_thoai' => 'required|numeric|digits:10',
            'tin_nhan' => 'required|string|max:255',
            'trang_thai' =>'required|boolean'
        ]);

        Contact::create($dataValidate);

        return redirect()->route('admins.contacts.index')->with('success', 'Gửi thành công');
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admins.contacts.edit' , compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $dataValidate = $request->validate([
            'ho_ten' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'so_dien_thoai' => 'required|numeric|digits:10',
            'tin_nhan' => 'required|string|max:255',
            'trang_thai' =>'required|boolean'
        ]);

        $contact->update($dataValidate);

        return redirect()->route('admins.contacts.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();

        return redirect()->route('admins.contacts.index')->with('success' , 'Xóa thành công');
    }

    public function thungrac()
    {
        $contacts = Contact::onlyTrashed()->get();
        return view('admins.contacts.thungrac', compact('contacts'));
    }

    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);

        $contact->restore();
        return redirect()->route('admins.contacts.thungrac')->with('success' , 'Khôi phục thành công');
    }

   public function forceDelete($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);

        $contact->forceDelete();
        return redirect()->route('admins.contacts.thungrac')->with('success' , 'Xóa vĩnh viễn thành công');
    }
}