@extends('admins.layouts.main')

@section('title', 'Cập nhật thông tin liên hệ')

@section('content')
    <div class="card-header bg-primary text-white">
        <h3 class="mb-0"><i class="fas fa-edit"></i> Cập nhật thông tin liên hệ</h3>
    </div>

    <div class="row mt-3">
        <div class="col-12 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('admins.contacts.update', $contact->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Tên khách hàng -->
                            <div class="mb-3 row">
                                <label for="ho_ten" class="col-4 col-form-label">Tên khách hàng</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="ho_ten" id="ho_ten"
                                        value="{{ old('ho_ten', $contact->ho_ten) }}" />
                                </div>
                                @error('ho_ten')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3 row">
                                <label for="email" class="col-4 col-form-label">Email khách hàng</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="email" id="email"
                                        value="{{ old('email', $contact->email) }}" />
                                </div>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Số điện thoại -->
                            <div class="mb-3 row">
                                <label for="so_dien_thoai" class="col-4 col-form-label">Số điện thoại</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="so_dien_thoai" id="so_dien_thoai"
                                        value="{{ old('so_dien_thoai', $contact->so_dien_thoai) }}" />
                                </div>
                                @error('so_dien_thoai')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tin nhắn -->
                            <div class="mb-3 row">
                                <label for="tin_nhan" class="col-4 col-form-label">Tin nhắn</label>
                                <div class="col-8">
                                    <textarea class="form-control" name="tin_nhan" id="tin_nhan">{{ old('tin_nhan', $contact->tin_nhan) }}</textarea>
                                </div>
                                @error('tin_nhan')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Trạng thái -->
                            <div class="mb-3 row">
                                <label for="trang_thai" class="col-4 col-form-label">Trạng thái</label>
                                <div class="col-8">
                                    <input type="checkbox" class="form-checkbox" name="trang_thai" id="trang_thai" value="1" {{ old('trang_thai', $contact->trang_thai) ? 'checked' : '' }} /> Đã đọc
                                    <input type="checkbox" class="form-checkbox ml-2" name="trang_thai" id="trang_thai" value="0" {{ old('trang_thai', $contact->trang_thai) ? '' : 'checked' }} /> Chưa đọc
                                </div>
                                @error('trang_thai')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit buttons -->
                            <div class="mb-3 row">
                                <div class="offset-sm-4 col-sm-8">
                                    <button type="submit" class="btn btn-info">
                                        Cập nhật liên hệ
                                    </button>

                                    <a href="/admins/contacts" class="btn btn-warning">
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
        CKEDITOR.replace('tin_nhan');
    </script>
@endsection
