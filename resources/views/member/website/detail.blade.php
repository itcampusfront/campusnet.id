@extends('template/member/main')

@section('title', 'Detail Website')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/member"><i class="fas fa-tachometer-alt"></i></a></li>
        <li class="breadcrumb-item"><a href="/member/website">Website</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Website</li>
    </ol>
</nav>
<div class="content">
    <div class="bg-white rounded-3 shadow-sm py-3 px-4 mb-4">
        <h5>Detail Website</h5>
        <div class="table-responsive mt-4">
            <table id="table" class="table">
                <tbody>
                    <tr>
                        <td width="20%">Domain</td>
                        <td width="5">:</td>
                        <td><a href="{{ $website->website_url }}" target="_blank">{{ $website->website_url }}</a></td>
                    </tr>
                    <tr>
                        <td>API Key</td>
                        <td>:</td>
                        <td>{{ $website->website_key }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                            @if($website->website_status == 1)
                            <span class="badge badge-success">Aktif</span>
                            @elseif($website->website_status == 2)
                            <span class="badge badge-warning">Menunggu instalasi dari pihak admin</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Login Admin</td>
                        <td>:</td>
                        <td><a class="btn btn-sm btn-theme-1" href="{{ $website->website_url }}/login" target="_blank">Login Admin</a></td>
                    </tr>
                    <tr>
                        <td>Akun Admin</td>
                        <td>:</td>
                        <td>
                            <p class="mb-0"><label>Email:</label> {{ $website->email }}</p>
                            <p class="mb-0"><label>Password:</label> <em>Dirahasiakan.</em></p>
                        </td>
                    </tr>
                    <tr>
                        <td>Waktu Pembuatan</td>
                        <td>:</td>
                        <td>{{ generate_date($website->website_at) }}, pukul {{ date('H:i', strtotime($website->website_at)) }} WIB</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
  
@endsection

@section('css-extra')

<style>
    label {font-weight: 500;}
</style>

@endsection