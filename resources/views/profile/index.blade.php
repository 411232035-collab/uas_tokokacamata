@extends('layouts.app')

@section('content')
<div class="card-dark p-4 animate-fade">
    <div class="row g-4 align-items-center">
        <div class="col-md-3 text-center">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-danger" style="width:110px;height:110px;font-size:2rem;">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
            <h4 class="mt-3 mb-1">{{ auth()->user()->name ?? 'User' }}</h4>
            <span class="badge bg-secondary">{{ ucfirst(auth()->user()->role ?? 'staff') }}</span>
        </div>
        <div class="col-md-9">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card-dark p-3">
                        <small class="text-muted">Nama Lengkap</small>
                        <div class="fw-bold">{{ auth()->user()->name }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-dark p-3">
                        <small class="text-muted">Email</small>
                        <div class="fw-bold">{{ auth()->user()->email }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-dark p-3">
                        <small class="text-muted">Role</small>
                        <div class="fw-bold">{{ ucfirst(auth()->user()->role ?? 'staff') }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-dark p-3">
                        <small class="text-muted">Status</small>
                        <div class="fw-bold text-success">Active</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
