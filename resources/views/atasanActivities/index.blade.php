@extends('layouts.app')

@section('title')
Aktifitas - {{ config('app.name') }}
@endsection

{{-- @section('header')
    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Masuk</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $masuk }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Telat</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $telat }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-yellow text-white rounded-circle shadow">
                            <i class="fas fa-business-time"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Cuti</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $cuti }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                <i class="fas fa-user-clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Alpha</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $alpha }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@section('content')

<!-- Begin Page Content -->
    <div class="container">
        <div class="card shadow h-100">
            <div class="card-header">
                <h5 class="m-0 pt-1 font-weight-bold float-left">Aktifitas Harian</h5>
                <a href="{{ route('atasanActivities.create') }}" class="btn btn-primary btn-sm float-right" title="Tambah Aktifitas"><i class="fas fa-plus"></i></a>
                <form class="float-right mr-1" action="{{ route('kehadiran.excel-users') }}" method="get">
                    <input type="hidden" name="tanggal" value="{{ request('tanggal', date('Y-m-d')) }}">
                    <button class="btn btn-sm btn-primary" type="submit" title="Download"><i class="fas fa-download"></i></button>
                </form>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 mb-1">
                        <form action="{{ route('atasanActivities.search') }}" method="get">
                            <div class="form-group row">
                                <label for="tanggal" class="col-form-label col-sm-3">Tanggal</label>
                                <div class="input-group col-sm-9">
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ request('tanggal', date('Y-m-d')) }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="float-right">
                            {{ $activities->links() }}
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Aktifitas</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                {{-- <th>Keterangan</th> --}}
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$activities->count())
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data yang tersedia</td>
                                </tr>
                            @else
                                @foreach ($activities as $activitie)
                                    <tr>
                                        <th>{{ $rank++ }}</th>
                                        <td>{{ $activitie->user->nama }}</td>
                                        <td>{{ $activitie->tanggal }}</td>
                                        <td>{{ $activitie->aktifitas}}</td>
                                        @if ($activitie->jam_mulai)
                                            <td>{{ date('H:i:s', strtotime($activitie->jam_mulai)) }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if($activitie->jam_selesai)
                                            <td>{{ date('H:i:s', strtotime($activitie->jam_selesai)) }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        {{-- <td>{{ $activitie->keterangan }}</td> --}}
                                        @if ($activitie->c_verifikasi==1)
                                            <td>Disetujui</td>
                                        @elseif ($activitie->c_verifikasi==2)
                                            <td>Ditolak</td>
                                        @else
                                            <td>Pengajuan</td>
                                        @endif

                                        @if ( $activitie->user_id == Auth::user()->id)
                                        @if ($activitie->c_verifikasi==1)
                                        <td><a href="#" class="btn btn-sm btn-dark" title="Detail Aktifitas"><i class="fas fa-pen"></i></a></td>
                                    @elseif ($activitie->c_verifikasi==2)
                                        <td><a href="{{ route('atasanActivities.edit', $activitie) }}" class="btn btn-sm btn-primary" title="Ajukan Aktifitas"><i class="fas fa-pen"></i></a>
                                    @else
                                        <td><a href="{{ route('atasanActivities.edit', $activitie) }}" class="btn btn-sm btn-info" title="Detail Aktifitas"><i class="fas fa-pen"></i></a>
                                        @if (auth()->user()->role->role == "Admin")
                                            <a href="{{ route('atasanActivities.show', $activitie) }}" class="btn btn-sm btn-info" title="Setujui Aktifitas"><i class="fas fa-check"></i></a>
                                        @endif
                                        </td>
                                    @endif
                                        @else
                                        @if ($activitie->c_verifikasi==1 || $activitie->c_verifikasi==2)
                                        <td><a href="#" class="btn btn-sm btn-secondary" title="Tinjau Aktifitas"><i class="fas fa-eye"></i></a></td>
                                    @else
                                        <td>
                                            <a href="{{ route('atasanActivities.edit', $activitie) }}" class="btn btn-sm btn-primary" title="Tinjau Aktifitas"><i class="fas fa-eye"></i></a>
                                        </td>
                                    @endif
                                        @endif


                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->

@endsection
