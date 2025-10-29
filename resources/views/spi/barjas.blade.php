@extends('template')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<style>

</style>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card mb-4">
        <h5 class="card-header">Data Barjas</h5>
        <div class="card-body">
            <button class="btn btn-primary mt-2 mb-4" id="btnAdd"><i class="tf-icons bx bx-plus me-1"></i> Tambah Data</button>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kelola</th>
                            <th>Satker</th>
                            <th>Barjas Nama</th>
                            <th>PPK</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody id="data-barjas">
                        <!-- Data akan ditampilkan di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- Modal untuk input data -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAddLabel" aria-hidden="true">
    <!-- <div class="modal-dialog modal-fullscreen" role="document"> -->
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel">Tambah Data Barjas Sesi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs nav-fill" id="mytab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true"><i class="tf-icons bx bx-home me-1"></i> Data</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false" tabindex="-1"><i class="tf-icons bx bx-check-square me-1"></i> Lembar Periksa</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                            <form id="formAdd" method="post">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="satker">Satker</label>
                                        <input type="hidden" id="barjas_template_id" name="barjas_template_id" value="1" required>
                                        <input type="text" class="form-control" id="satker" name="satker" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="barjas_nama">Barjas Nama</label>
                                        <input type="text" class="form-control" id="barjas_nama" name="barjas_nama" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="ppk">PPK</label>
                                        <input type="text" class="form-control" id="ppk" name="ppk" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pejabat_pengadaan">Pejabat Pengadaan</label>
                                        <input type="text" class="form-control" id="pejabat_pengadaan" name="pejabat_pengadaan" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="rekanan">Rekanan</label>
                                        <input type="text" class="form-control" id="rekanan" name="rekanan" required>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="metode">Metode</label>
                                        <input type="text" class="form-control" id="metode" name="metode" value="Metode ABC" required>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_kontrak">Tanggal Kontrak</label>
                                        <input type="date" class="form-control" id="tanggal_kontrak" name="tanggal_kontrak" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nilai">Nilai</label>
                                        <input type="text" class="form-control" id="nilai" name="nilai" oninput="setValue(this)" required>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="kode_akun">Kode Akun</label>
                                        <input type="text" class="form-control" id="kode_akun" name="kode_akun" required>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_periksa">Tanggal Periksa</label>
                                        <input type="date" class="form-control" id="tanggal_periksa" name="tanggal_periksa" required>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1" id="buttonSubmit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                            <table class="table table-striped table-hover">
                                <a class="btn btn-dark me-sm-3 me-1" id="formPrint"><i class="tf-icons bx bx-printer me-1"></i> Cetak</a>

                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Dokumen</th>
                                        <th>Cek</th>
                                        <th>Tanggal Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody id="template-periksa">

                                </tbody>
                            </table>
                        </div>



                    </div>
                </div>



            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    const buttonSubmit = document.querySelector('#buttonSubmit')
    loadData()

    async function loadData() {
        let url = "{{route('barjas_sesi.index')}}?verifikator_id=" + JSON.parse(localStorage.getItem('tahun_anggaran')).verifikator_id
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "GET",
        })
        response = await sendRequest.json()
        document.querySelector('#data-barjas').innerHTML = ''
        response.data.map((data, index) => {
            addRowToTable(data, index + 1);
        })

    }

    $('#btnAdd').click(function() {
        $('#modalAdd').modal('show');
        buttonSubmit.innerHTML = "<i class='tf-icons bx bx-plus me-1'></i> Submit"
        buttonSubmit.removeAttribute('onclick')

        // $('#mytab a[href="#navs-justified-home"]').tab('show');

    });

    $('#formAdd').submit(function(event) {
        event.preventDefault(); // Mencegah aksi default submit form
        // let formData = $(this).serialize();
        let formDataArray = $(this).serializeArray();
        let formData = {};
        formDataArray.forEach(function(item) {
            formData[item.name] = item.value;
        });
        formData['verifikator_id'] = JSON.parse(localStorage.getItem('tahun_anggaran')).verifikator_id
        $.ajax({
            url: '{{route("barjas_sesi.store")}}', // Ganti URL dengan endpoint API Anda
            method: 'POST',
            headers: {
                // 'Content-Type': 'application/x-www-form-urlencoded',
                'Content-Type': 'application/json', // Set the correct content type for JSON

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify(formData),
            success: function(response) {
                loadData()

                showPeriksa(response.data.id);
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-top-center mt-3';
                toastr.success('Data Berhasil ditambahkan');
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan:', error);
            }
        });
    });

    // Fungsi untuk menambahkan baris data ke dalam tabel
    function addRowToTable(data, index) {
        var row = '<tr class="text-center">' +
            '<td>' + index + '</td>' +
            '<td class="text-center"><button class="btn btn-dark btn-sm" onclick="showPeriksa(' + data.id + ')">Kelola</button></td>' +
            '<td>' + data.satker + '</td>' +
            '<td>' + data.barjas_nama + '</td>' +
            '<td>' + data.ppk + '</td>' +
            // '<td>' + data.pejabat_pengadaan + '</td>' +
            // '<td>' + data.rekanan + '</td>' +
            // '<td>' + data.metode + '</td>' +
            // '<td>' + data.tanggal_kontrak + '</td>' +
            // '<td>' + data.nilai + '</td>' +
            // '<td>' + data.kode_akun + '</td>' +
            // '<td>' + data.jumlah_dokumen + '</td>' +
            // '<td>' + data.tanggal_periksa + '</td>' +
            '<td><button class="btn btn-danger btn-sm" onclick="hapus(' + data.id + ')"><i class="tf-icons bx bx-trash"></i></button></td>' +
            '</tr>';

        $('#data-barjas').append(row); // Menambahkan baris ke tabel
    }

    // showTemplate();

    async function hapus(id) {
        let konfirm = confirm('Yakin Hapus?');
        if (!konfirm) return
        let url = `{{ url('api/barjas_sesi') }}/${id}`;
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "DELETE",
        })
        response = await sendRequest.json()
        console.log(response);
        if (response.status) {
            loadData()
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Data berhasil dihapus');
        }

    }
    async function showPeriksa(id) {
        $('#modalAdd').modal('show');
        let urlCetak = "{{route('spi.barjas.cetak',[':id'])}}"
        urlCetak = urlCetak.replace(':id', id)
        document.querySelector('#formPrint').setAttribute('href', urlCetak)

        // buttonSubmit.innerText = "Edit"
        buttonSubmit.innerHTML = "<i class='tf-icons bx bx-pencil me-1'></i> Edit"
        buttonSubmit.setAttribute('onclick', "updateBarjasSesi(" + id + ")")
        buttonSubmit.setAttribute('type', "button")
        let verifikatorId = JSON.parse(localStorage.getItem('tahun_anggaran')).verifikator_id
        let template = document.querySelector('#template-periksa')
        let url = "{{route('barjas_sesi.index')}}?sesi_id=" + id + "&template=true"
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "GET",
        })
        response = await sendRequest.json()
        console.log(response);
        let contents = ''
        let urut = 1
        document.querySelector('#satker').value = response.data.satker;
        document.querySelector('#barjas_nama').value = response.data.barjas_nama;
        document.querySelector('#ppk').value = response.data.ppk;
        document.querySelector('#pejabat_pengadaan').value = response.data.pejabat_pengadaan;
        document.querySelector('#rekanan').value = response.data.rekanan;
        document.querySelector('#metode').value = response.data.metode;
        document.querySelector('#tanggal_kontrak').value = response.data.tanggal_kontrak;
        document.querySelector('#nilai').value = response.data.nilai;
        document.querySelector('#kode_akun').value = response.data.kode_akun;
        document.querySelector('#tanggal_periksa').value = response.data.tanggal_periksa;
        response.data.barjas_template.bagian.map(bagian => {
            contents += `<tr>`
            contents += `<td colspan="4" class="text-center"><b>${bagian.nama_bagian}</b></td>`
            contents += `</tr>`
            bagian.item.map((item, index) => {
                if (item.periksa != null) {
                    contents += `<tr>`
                    contents += `<td class="text-center">${urut}</td>`
                    contents += `<td class="text-center">${item.nama_dokumen}</td>`
                    contents += `<td>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" checked type="checkbox" data-id="${item.periksa.id}" onclick="deletePeriksa(this)">
                    </div>
                    </td>`
                    contents += `<td><input type="date" value="${item.periksa.tanggal_dokumen}" class="form-control"></td>`
                    contents += `</tr>`
                    urut++
                } else {
                    contents += `<tr>`
                    contents += `<td class="text-center">${urut}</td>`
                    contents += `<td class="text-center">${item.nama_dokumen}</td>`
                    contents += `<td>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" data-sesi="${id}" data-value="${item.id}" onclick="savePeriksa(this)">
                    </div>
                    </td>`
                    contents += `<td><input type="date" class="form-control"></td>`
                    contents += `</tr>`
                    urut++
                }
            })
        })
        template.innerHTML = ''
        template.innerHTML = contents
    }

    function setValue(input) {
        let cleanedInput = input.value.replace(/\D/g, '');
        const formattedInput = Number(cleanedInput).toLocaleString('id-ID');
        input.value = formattedInput;
    }
    async function updateBarjasSesi(id) {
        let url = `{{ url('api/barjas_sesi') }}/${id}`;

        let data = {
            verifikator_id: JSON.parse(localStorage.getItem('tahun_anggaran')).verifikator_id,
            barjas_template_id: 1,
            satker: document.getElementById('satker').value,
            barjas_nama: document.getElementById('barjas_nama').value,
            ppk: document.getElementById('ppk').value,
            pejabat_pengadaan: document.getElementById('pejabat_pengadaan').value,
            rekanan: document.getElementById('rekanan').value,
            metode: document.getElementById('metode').value,
            tanggal_kontrak: document.getElementById('tanggal_kontrak').value,
            nilai: document.getElementById('nilai').value,
            kode_akun: document.getElementById('kode_akun').value,
            tanggal_periksa: document.getElementById('tanggal_periksa').value,
        };

        try {
            let response = await fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                body: JSON.stringify(data)
            });

            let result = await response.json();
            if (response.ok) {
                console.log('Data berhasil diperbarui:', result);
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-top-center mt-3';
                toastr.success('Data berhasil diubah');
                loadData()
                // Lakukan sesuatu setelah data berhasil diperbarui
            } else {
                console.error('Gagal memperbarui data:', result.error);
            }
        } catch (error) {
            console.error('Terjadi kesalahan:', error);
        }
    }

    async function savePeriksa(element) {
        // return console.log(element.closest('tr').querySelector('input[type=date]').value);
        let tanggalDokumen = element.closest('tr').querySelector('input[type=date]')
        if (tanggalDokumen.value == "") {
            alert('Tentukan tanggal dokumen dahulu!');
            element.checked = false;
            return
        }
        let url = '{{route("barjas_sesi_periksa.store")}}'
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'application/json' // Set the correct content type for JSON
            },
            method: "POST",
            body: JSON.stringify({
                barjas_sesi_id: element.dataset.sesi,
                barjas_template_item_id: element.dataset.value,
                tanggal_dokumen: tanggalDokumen.value,
            })
        })
        response = await sendRequest.json()
        console.log(response);
        if (response.status) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Berhasil');
            element.removeAttribute('onclick')
            element.setAttribute('data-id', response.data.id)
            element.setAttribute('onclick', 'deletePeriksa(this)')
        }

    }
    async function deletePeriksa(element) {
        // retu
        // return console.log(element.closest('tr').querySelector('input[type=date]').value);
        let url = `{{ url('api/barjas_sesi_periksa') }}/${element.dataset.id}`;

        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'application/json' // Set the correct content type for JSON
            },
            method: "DELETE",
        })
        response = await sendRequest.json()
        console.log(response);
        if (response.status) {
            let tanggalDokumen = element.closest('tr').querySelector('input[type=date]')
            tanggalDokumen.value = ''

            element.removeAttribute('data-id')
            element.removeAttribute('onclick')
            element.setAttribute('onclick', 'savePeriksa(this)')
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Berhasil');

        }

    }
</script>
@endsection