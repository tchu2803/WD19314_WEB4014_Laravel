@extends('admins.layouts.main')

@section('title', 'Cập nhật thông tin khách hàng')

@section('content')
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0"><i class="fas fa-edit"></i> Cập nhật thông tin khách hàng </h3>
    </div>

    <div class="row mt-3">
        <div class="col-12 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('admins.customers.update', $customer->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Tên khách hàng -->
                            <div class="mb-3 row">
                                <label for="ho_ten" class="col-4 col-form-label">Tên khách hàng</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="ho_ten" id="ho_ten"
                                        value="{{ old('ho_ten', $customer->ho_ten) }}" />
                                </div>
                                @error('ho_ten')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3 row">
                                <label for="email" class="col-4 col-form-label">Email khách hàng</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="email" id="email"
                                        value="{{ old('email', $customer->email) }}" />
                                </div>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 row">
                                <label for="hinh_anh" class="col-4 col-form-label">Hình ảnh</label>
                                <div class="col-8">
                                    <input type="file" class="form-control" name="hinh_anh" id="hinh_anh">
                                    <br>
                                    @if ($customer->hinh_anh)
                                        <img src="{{ asset('storage/' . $customer->hinh_anh) }}" class="mt-2"
                                            width="100">
                                    @endif
                                </div>
                                @error('hinh_anh')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Số điện thoại -->
                            <div class="mb-3 row">
                                <label for="email" class="col-4 col-form-label">Số điện thoại</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="so_dien_thoai" id="so_dien_thoai"
                                        value="{{ old('so_dien_thoai', $customer->so_dien_thoai) }}" />
                                </div>
                                @error('so_dien_thoai')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            <!-- Địa chỉ -->
                            <div class="mb-3 row">
                                <label for="email" class="col-4 col-form-label">Địa chỉ</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="dia_chi" id="dia_chi"
                                        value="{{ old('dia_chi', $customer->dia_chi) }}" />
                                </div>
                                @error('dia_chi')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit buttons -->
                            <div class="mb-3 row">
                                <div class="offset-sm-4 col-sm-8">
                                    <button type="submit" class="btn btn-info">
                                        Cập nhật sản phẩm
                                    </button>

                                    <a href="/admins/customers" class="btn btn-warning">
                                        Quay lại trang danh sách
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.25.0/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('mo_ta');
    </script>
@endsection
