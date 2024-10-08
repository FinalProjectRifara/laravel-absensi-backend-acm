@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile Company</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile Company</div>
                </div>
            </div>

            <div class="section-body">
                <!-- Include Alert -->
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>

                <h2 class="section-title">Profil Perusahaan</h2>
                <p class="section-lead">
                    Informasi tentang perusahaan Anda.
                </p>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                {{-- Nama & Email Perusahaan --}}
                                <div class="row">
                                    {{-- Nama Perusahaan --}}
                                    <div class="form-group col-md-6 col-12">
                                        <label>Nama Perusahaan</label>
                                        <p>{{ $company->name }}</p>
                                    </div>

                                    {{-- Alamat Perusahaan --}}
                                    <div class="form-group col-md-6 col-12">
                                        <label>Alamat Perusahaan</label>
                                        <p>{{ $company->address }}</p>
                                    </div>
                                </div>

                                {{-- Email Perusahaan & Radius KM --}}
                                <div class="row">
                                    {{-- Email Perusahaan --}}
                                    <div class="form-group col-md-6 col-12">
                                        <label>Email Perusahaan</label>
                                        <p>{{ $company->email }}</p>
                                    </div>

                                    {{-- Radius KM --}}
                                    <div class="form-group col-md-6 col-12">
                                        <label>Radius KM</label>
                                        <p>{{ $company->radius_km }} KM</p>
                                    </div>
                                </div>

                                {{-- Latitude & Longitude --}}
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Latitude</label>
                                        <p>{{ $company->latitude }}</p>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Longitude</label>
                                        <p>{{ $company->longitude }}</p>
                                    </div>
                                </div>

                                {{-- Waktu Masuk & Pulang --}}
                                <div class="row">
                                    {{-- Masuk --}}
                                    <div class="form-group col-md-6 col-12">
                                        <label>Waktu Masuk</label>
                                        <p>{{ $company->time_in }}</p>
                                    </div>

                                    {{-- Pulang --}}
                                    <div class="form-group col-md-6 col-12">
                                        <label>Waktu Pulang</label>
                                        <p>{{ $company->time_out }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary">Edit Profil
                                    Perusahaan</a>
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
    {{-- <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script> --}}
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
