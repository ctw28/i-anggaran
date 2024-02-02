@extends('template')

@section('content')
<div class="col-lg-12 mb-4 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary">Selamat Datang</h5>
                    <p class="mb-4">
                        Selamat datang di aplikasi juara
                    </p>

                    <!-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">Isi RPD</a> -->
                </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                    <img src="{{asset('/')}}assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
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