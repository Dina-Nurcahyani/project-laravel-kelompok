@extends('layouts.app')

@section('content')
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Dashboard</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="/">Dashboard</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <!--begin::Col-->
                    <div class="col-lg-6 col-6">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box text-bg-primary">
                            <div class="inner">
                                <h3>150</h3>
                                <p>Total Pegawai</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16"
                                class="small-box-icon">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                            <a href="/pegawai"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->
                    <div class="col-lg-6 col-6">
                        <!--begin::Small Box Widget 2-->
                        <div class="small-box text-bg-success">
                            <div class="inner">
                                <h3>53<sup class="fs-5">%</sup></h3>
                                <p>Total Pasien</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="bi bi-people-fill small-box-icon" viewBox="0 0 16 16">
                                <path
                                    d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                            </svg>
                            <a href="/pasien"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                More info <i class="bi bi-link-45deg"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 2-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Chart Status Pasien
        const statusCtx = document.getElementById('statusChart');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($status)) !!},
                datasets: [{
                    label: 'Jumlah Pasien',
                    data: {!! json_encode(array_values($status)) !!},
                    backgroundColor: ['#36A2EB', '#FFCE56', '#FF6384'],
                    borderWidth: 1
                }]
            },
        });

        // Chart Jenis Kelamin
        const genderCtx = document.getElementById('genderChart');
        new Chart(genderCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($gender)) !!},
                datasets: [{
                    label: 'Jumlah Pasien',
                    data: {!! json_encode(array_values($gender)) !!},
                    backgroundColor: ['#4BC0C0', '#9966FF'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
