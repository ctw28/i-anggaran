@extends('template')

@section('content')

<div class="col-lg-3 col-sm-6 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="card-info">
                    <p class="card-text">Statistik</p>
                    <div class="d-flex align-items-end mb-2">
                        <h4 class="card-title mb-0 me-2">00,00</h4>
                        <small class="text-success">(+0%)</small>
                    </div>
                    <small>Total Pagu</small>
                </div>
                <div class="card-icon">
                    <span class="badge bg-label-primary rounded p-2">
                        <i class="bx bx-trending-up bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-sm-6 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="card-info">
                    <p class="card-text">Statistik</p>
                    <div class="d-flex align-items-end mb-2">
                        <h4 class="card-title mb-0 me-2">00,00</h4>
                        <small class="text-success">(+0%)</small>
                    </div>
                    <small>Total Pagu</small>
                </div>
                <div class="card-icon">
                    <span class="badge bg-label-primary rounded p-2">
                        <i class="bx bx-trending-up bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-sm-6 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="card-info">
                    <p class="card-text">Statistik</p>
                    <div class="d-flex align-items-end mb-2">
                        <h4 class="card-title mb-0 me-2">00,00</h4>
                        <small class="text-success">(+0%)</small>
                    </div>
                    <small>Total Pagu</small>
                </div>
                <div class="card-icon">
                    <span class="badge bg-label-primary rounded p-2">
                        <i class="bx bx-trending-up bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-sm-6 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="card-info">
                    <p class="card-text">Statistik</p>
                    <div class="d-flex align-items-end mb-2">
                        <h4 class="card-title mb-0 me-2">00,00</h4>
                        <small class="text-success">(+0%)</small>
                    </div>
                    <small>Total Pagu</small>
                </div>
                <div class="card-icon">
                    <span class="badge bg-label-primary rounded p-2">
                        <i class="bx bx-trending-up bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')
<script>
    function jwt_decode(token) {
        const base64Url = token.split('.')[1]; // Ambil bagian payload dari token (dalam base64)
        const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/'); // Ubah karakter khusus
        const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join('')); // Decode base64 dan ubah menjadi JSON

        return JSON.parse(jsonPayload); // Parse JSON menjadi objek JavaScript
    }
</script>
@endsection