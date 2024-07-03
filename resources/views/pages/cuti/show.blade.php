@extends('layouts.app')

@section('title', 'Cuti Detail')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Cuti Detail</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Cuti Detail</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Cuti Detail</h2>
                <p class="section-lead">
                    Informasi tentang detail cuti karyawan.
                </p>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Nama Karyawan</label>
                                        <p>{{ $cuti->user->name }}</p>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Telpon Karyawan</label>
                                        <p>{{ $cuti->user->phone }}</p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Position</label>
                                        <p>{{ $cuti->user->position }}</p>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Department</label>
                                        <p>{{ $cuti->user->department }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Date cuti</label>
                                        <p>{{ $cuti->date_cuti }}</p>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Reason</label>
                                        <p>{{ $cuti->reason }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Bukti Dukung</label>
                                        @if ($cuti->image)
                                            <!-- Jika image tersedia, tampilkan gambar -->
                                            <div>
                                                <img src="{{ asset('storage/cuti/' . $cuti->image) }}"
                                                    alt="Bukti Dukung" class="img-thumbnail mb-3" style="max-width: 200px;">
                                            </div>
                                        @else
                                            <!-- Jika image kosong, tampilkan teks -->
                                            <p>Tidak ada bukti dukung</p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Is Approval</label>
                                        <p>
                                            @if ($cuti->is_approved == 1)
                                                Approved
                                            @else
                                                Not Approved
                                            @endif
                                        </p>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('cutis.edit', $cuti->id) }}" class="btn btn-primary">Edit
                                    Cuti For Approve</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
