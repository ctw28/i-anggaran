@extends('template')

@section('style')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<style>
    /* Mengatur lebar pada bagian yang tetap */
    /* th:nth-child(1) {
        min-width: 10%;
    }

    th:nth-child(3) {
        min-width: 70%;
    }
 */
    #rpd-table th:nth-child(2) {
        max-width: 100px;
    }

    #rpd-data tr td {
        padding: 0;
    }

    #rpd-data tr td input {
        padding: 2px;
    }
</style>
@endsection
@section('content')
<div class="col-lg-12 mb-4 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-sm-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Kegiatan</h5>
                    <!-- <p class="mb-4">
                        You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                        your profile.
                    </p> -->
                    <div class="mb-2 mt-3">

                        <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#importModal"><i class="tf-icons bx bx-import"></i> Import Kegiatan</button>
                        <button onclick="showRpd()" class="btn btn-dark btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#fullscreenModal"><i class="tf-icons bx bx-data"></i> Kelola RPD</button>
                        <!-- <button type="button" class="btn btn-primary btn-sm mb-2" onclick="kirimRpd()"><i class="tf-icons bx bx-send"></i> Kirim RPD</button> -->

                    </div>

                    <div class="table-responsive">
                        <!-- <div class="table-container"> -->
                        <!-- <table id="data-table"> -->
                        <table class="table table-striped table-bordered" id="data-table">
                            <thead class="text-center align-middle">
                                <th width="2%" rowspan="2" width="50px">Edit</th>
                                <th width="1%" rowspan="2">No</th>
                                <th width="50%" rowspan="2">Program</th>
                                <th rowspan="2">Rencana Penarikan Dana<br>(RPD)</th>
                                <th width="2%" rowspan="2">hapus</th>
                            </thead>
                            <tbody id="kegiatan-data">

                            </tbody>
                        </table>
                    </div>
                    <!-- <button onclick="tambahBaris()" class="btn btn-primary mt-3"><i class="tf-icons bx bx-plus"></i> Tambah Kegiatan</button> -->
                    <button onclick="tambahBaris(this)" id="tambah-baris" class="btn btn-primary btn-sm mt-3"><i class="tf-icons bx bx-plus"></i> Kegiatan</button>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title " id="modalFullTitle">Import Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 mb-3">
                    <label for="dipa_pagu" class="form-label">Upload File (.xls) <a href="{{asset('/')}}assets/format.xlsx">Download format di sini!</a></label>
                    <input type="file" class="form-control" id="file_import">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="import-table">
                        <thead class="align-middle text-center text-bold">
                            <tr>
                                <th>No</th>
                                <th>Sub Kegiatan</th>
                                <th>Program</th>
                                <th>Pagu</th>
                                <th>Sumber Dana</th>
                                <th>Status</th>
                                <!-- <th rowspan="2">Aksi</th> -->
                            </tr>
                        </thead>
                        <tbody id="data-import">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button onclick="saveImport()" type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Keluar</button> -->
                <button type="button" id="submit_excel" class="btn btn-primary">Import Kegiatan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="fullscreenModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title " id="modalFullTitle">Rencana Penarikan Dana (RPD)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="loadData()"></button>
            </div>
            <div class="modal-body">
                <!-- <button type="button" class="btn btn-warning mb-3" onclick="kirimRpd()"><i class="tf-icons bx bx-send"></i> Kirim RPD</button> -->
                <p>Status Pengisian RPD : <span id="status-pengisian-rpd"></span></p>
                <p>Waktu Pengisian RPD : <span id="waktu-pengisian-rpd"></span></p>
                <div class="table-responsive">
                    <!-- <div class="table-container"> -->
                    <!-- <table id="data-table"> -->

                    <table class="table table-striped table-bordered" id="rpd-table">
                        <thead class="align-middle text-center text-bold">
                            <tr>
                                <th style="width: 1%" rowspan="2">No</th>
                                <th style="width: 20%" rowspan="2">Program</th>
                                <th style="width: 12%" rowspan="2">Pagu</th>
                                <th colspan="11">Rencana Penarikan Dana<br>(RPD)</th>
                                <!-- <th rowspan="2">Aksi</th> -->
                            </tr>
                            <tr>
                                <th>Jan</th>
                                <th>Feb</th>
                                <th>Mar</th>
                                <th>Apr</th>
                                <th>Mei</th>
                                <th>Jun</th>
                                <th>Jul</th>
                                <th>Agust</th>
                                <th>Sept</th>
                                <th>Okt</th>
                                <th>Nov</th>
                            </tr>
                        </thead>
                        <tbody id="rpd-data">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="loadData()" type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Keluar</button>
                <!-- <button type="button" class="btn btn-primary">Simpan Perubahan</button> -->
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.17.2/dist/xlsx.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    var modal = document.getElementById('fullscreenModal');
    const excel_file = document.getElementById('file_import');

    excel_file.addEventListener('change', (event) => {
        if (!['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'].includes(event.target.files[0].type)) {
            document.getElementById('excel_data').innerHTML = '<div class="alert alert-danger">Only .xlsx or .xls file format are allowed</div>';
            excel_file.value = '';
            return false;
        }
        var reader = new FileReader();
        reader.readAsArrayBuffer(event.target.files[0]);
        reader.onload = async function(event) {
            var data = new Uint8Array(reader.result);
            var work_book = XLSX.read(data, {
                type: 'array'
            });
            var sheet_name = work_book.SheetNames;
            var sheet_data = XLSX.utils.sheet_to_json(work_book.Sheets[sheet_name[0]], {
                header: 1
            });
            if (sheet_data.length > 0) {
                let table_output = ''
                for (var row = 1; row < sheet_data.length; row++) {
                    table_output += '<tr id="' + sheet_data[row][1] + '">';
                    table_output += `<td>${row}</td>`
                    table_output += `<td><input class="form-control" type="text" id="sub_kegiatan_kode" value="${sheet_data[row][1]}"></td>`
                    table_output += `<td><input class="form-control" type="text" id="kegiatan_nama" value="${sheet_data[row][2]}"></td>`
                    table_output += `<td><input class="form-control" type="text" id="jumlah_biaya" oninput="toNumber(this)" value="${formatRupiah(sheet_data[row][3])}"></td>`
                    table_output += `<td><input class="form-control" type="text" id="sumber_dana" value="${sheet_data[row][4]}"></td>`
                    table_output += `<td id="status" class="text-white"></td>`
                    table_output += '</tr>';
                }
                document.getElementById('data-import').innerHTML = table_output;
            }
            excel_file.value = '';
        }
    });

    function toNumber(event) {
        let cleanedInput = event.value.replace(/\D/g, '');
        // Memformat angka dengan pemisah ribuan
        const formattedInput = Number(cleanedInput).toLocaleString('id-ID');
        // Mengatur nilai input ke nilai yang telah diformat
        event.value = formattedInput;
    }
    var buttonSave = document.querySelector('#submit_excel');
    buttonSave.addEventListener('click', async function() {
        var table = document.getElementById('data-import');
        const rows = table.getElementsByTagName('tr');
        for (let i = 0; i < rows.length; i++) {
            const rowData = {};
            const inputs = rows[i].getElementsByTagName('input');

            for (let j = 0; j < inputs.length; j++) {
                const inputId = inputs[j].id;
                const inputValue = inputs[j].value;

                if (inputId == 'sub_kegiatan_kode') {
                    const stringData = inputValue;
                    const parts = stringData.split('.'); // Memisahkan string berdasarkan titik
                    const [sub_kegiatan_kode1, sub_kegiatan_kode2, sub_kegiatan_kode3, sub_kegiatan_kode4, sub_kegiatan_kode5] = parts.map(part => part.trim());
                    rowData['sub_kegiatan_kode1'] = sub_kegiatan_kode1
                    rowData['sub_kegiatan_kode2'] = sub_kegiatan_kode2
                    rowData['sub_kegiatan_kode3'] = sub_kegiatan_kode3
                    rowData['sub_kegiatan_kode4'] = sub_kegiatan_kode4
                    rowData['sub_kegiatan_kode5'] = sub_kegiatan_kode5
                } else if (inputId == 'jumlah_biaya') {
                    rowData[inputId] = inputValue.replace(/\D/g, '');
                } else {
                    rowData[inputId] = inputValue;
                }
            }
            const formData = new FormData();
            for (const key in rowData) {
                formData.append('organisasi_rpd_id', JSON.parse(localStorage.getItem('tahun_anggaran')).organisasi_rpd);
                formData.append(key, rowData[key]);
                formData.append('urutan', i + 1);

            }

            sendDataToAPI(formData, rows[i]);
        }

    });

    async function sendDataToAPI(formData, rows) {
        console.log(rows);
        // Replace the URL with your API endpoint
        response = await fetch('{{route("kegiatan.store")}}', {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "POST",
            body: formData
        })
        responseMessage = await response.json()
        console.log(responseMessage);
        if (responseMessage.status == true) {
            rows.querySelector('#status').innerText = "Sukses"
            return rows.style.backgroundColor = "green";
        }
        rows.querySelector('#status').innerText = responseMessage.message

        // rows[4].innerText = responseMessage.responseMessage
        return rows.style.backgroundColor = "red";
    }


    function handleEscKey(event) {
        if (event.key === 'Escape' && modal.style.display !== 'none') {
            // alert('ditekan');
            loadData();
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        loadData()

    });


    function loadData() {
        // return console.log(JSON.parse(localStorage.getItem('tahun_anggaran')).id);
        if (modal.style.display == 'none')
            modal.removeEventListener('keydown', handleEscKey);

        const formData = new FormData();
        formData.append('id', JSON.parse(localStorage.getItem('tahun_anggaran')).organisasi_rpd)
        fetch('{{route("kegiatan.data")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log(response);
                if (!response.ok) {

                    if (response.status === 404) {
                        // console.log(document.getElementById('data-table'));
                        document.querySelector("#kegiatan-data").innerHTML = '<tr><td colspan="5" class="text-center">Data tidak ada</td></tr>'
                        document.querySelector("#tambah-baris").dataset.isNoResult = true
                    }
                    throw new Error('ada kesalahan.');
                }
                // if (!response.ok) {
                // }
                return response.json();
            })
            .then(data => {
                if (document.querySelector("#tambah-baris").hasAttribute('data-is-no-result')) {
                    document.querySelector("#tambah-baris").removeAttribute('data-is-no-result')
                }
                console.log(data);
                let contents = '' // Mengambil token dari response JSON
                data.data.kegiatan.map((data, index) => {
                    console.log(Object.values(data.rencana).length);
                    contents += `<tr data-id="${data.id}">
                    <td><button class="btn btn-sm btn-warning"onclick="editBaris(this)"><i class="tf-icons bx bx-pencil"></i></button></td>
                    <td class="text-center">${index+1}</td>
                    <td>
                    <span class="badge bg-label-primary mb-1">
                    <small>
                    ${data.sub_kegiatan_kode1}.
                    ${data.sub_kegiatan_kode2}.
                    ${data.sub_kegiatan_kode3}.
                    ${data.sub_kegiatan_kode4}.
                    ${data.sub_kegiatan_kode5}
                    </small>
                    </span>
                    <br><strong>${data.kegiatan_nama}</strong>
                    <br> 
                    <span class="badge bg-label-dark mt-1">
                    Pagu : Rp. ${formatRupiah(data.jumlah_biaya)} (${data.sumber_dana})
                    </span>
                    </td>`
                    contents += `<td>`
                    if (Object.values(data.rencana).length > 0) {
                        console.log(data.rencana);
                        Object.values(data.rencana).forEach(rencana => {
                            const namaBulan = {
                                1: 'Januari',
                                2: 'Februari',
                                3: 'Maret',
                                4: 'April',
                                5: 'Mei',
                                6: 'Juni',
                                7: 'Juli',
                                8: 'Agustus',
                                9: 'September',
                                10: 'Oktober',
                                11: 'November',
                                12: 'Desember'
                            };
                            console.log(rencana);
                            contents += `<a href="javascript:void(0)"><span class="badge rounded-pill bg-dark">${namaBulan[rencana.bulan]}</span></a>`
                        })
                    }
                    contens = `</td>`
                    contents += `<td class="text-center"><button class="btn btn-sm btn-danger"onclick="deleteBaris(this)"><i class="tf-icons bx bx-trash"></i></button></td>`
                    contents += `</tr>`
                })
                document.querySelector("#kegiatan-data").innerHTML = ''
                document.querySelector("#kegiatan-data").innerHTML = contents
            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }

    function showRpd() {
        let statusPengisian
        // Fungsi untuk menangani aksi ketika tombol Escape ditekan
        fetch('{{route("admin.tahun-anggaran-sesi.index")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            })
            .then(response => {
                console.log(response);
                if (!response.ok) {

                    if (response.status === 404) {}
                    throw new Error('ada kesalahan.');
                }
                // if (!response.ok) {
                // }
                return response.json();
            })
            .then(data => {
                console.log(data.data);
                statusPengisian = data.data
                const statusPengisianRpd = document.querySelector('#status-pengisian-rpd')
                if (data.data.is_open) {
                    statusPengisianRpd.className = 'badge bg-label-success'
                    statusPengisianRpd.innerText = "Terbuka"
                } else {
                    statusPengisianRpd.className = 'badge bg-label-danger'
                    statusPengisianRpd.innerText = "Tertutup"
                }
                document.querySelector('#waktu-pengisian-rpd').innerHTML = `
                ${data.data.tanggal_rpd_mulai} - ${data.data.tanggal_rpd_selesai}
                `
            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });



        modal.removeEventListener('keydown', handleEscKey);
        console.log(statusPengisian);

        const formData = new FormData();
        formData.append('id', JSON.parse(localStorage.getItem('tahun_anggaran')).organisasi_rpd)
        fetch('{{route("kegiatan.data")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    if (response.status == 404) {
                        document.querySelector("#rpd-data").innerHTML = '<tr><td colspan="13" class="text-center">Data tidak ada</td></tr>'
                    }
                    throw new Error('data tidak ada.');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                // if()
                let contents = '' // Mengambil token dari response JSON
                data.data.kegiatan.map((data, index) => {
                    contents += `<tr data-id="${data.id}" data-pagu="${data.jumlah_biaya}">
                    <td class="text-center">${index+1}</td>
                    <td>${data.kegiatan_nama}</td>
                    <td>Pagu : ${formatRupiah(data.jumlah_biaya)}<br>
                    Sisa : <span id="sisa">${formatRupiah(data.sisa)}</span>
                    
                    </td>`
                    for (let inc = 0; inc < 11; inc++) {
                        // console.log(data.rencana[inc + 1]);
                        if (statusPengisian['is_open']) {
                            if (!data.rencana[inc + 1]) {
                                contents += `
                                        <td class="text-center" data-bulan="${inc + 1}" ondblclick="editCell(this)" data-jumlah="0">
                                        -
                                        </td>`
                            } else {
                                contents += `
                                    <td class="text-center have_jumlah" ondblclick="editCell(this)" data-bulan="${inc + 1}" data-id="${data.rencana[inc + 1].id}" data-jumlah="${data.rencana[inc + 1].rencana_jumlah}">
                                    <span class="badge bg-label-primary"><small>${data.rencana[inc + 1].tanggal} - ${data.rencana[inc + 1].bulan_indonesia}</small></span>
                                    <br><span class="badge bg-label-dark" style="font-size: 14px">${formatRupiah(data.rencana[inc + 1].jumlah)}</span>
                                    <br> 
                                    <button type="button" onclick="deleteRpd(this)" class="btn btn-icon btn-sm ">
                                    <span class="tf-icons bx bx-trash" style="color:red; font-size:12px"></span>
                                    </button>
                                    </td>`
                            }
                        } else {
                            if (!data.rencana[inc + 1]) {
                                contents += `
                                        <td class="text-center" data-bulan="${inc + 1}">
                                        -
                                        </td>`
                            } else {
                                contents += `
                                    <td class="text-center" data-bulan="${inc + 1}" data-id="${data.rencana[inc + 1].id}">
                                    <span class="badge bg-label-primary"><small>${data.rencana[inc + 1].tanggal}</small></span>
                                    <br><span class="badge bg-label-dark">${formatRupiah(data.rencana[inc + 1].jumlah)}</span>
                                    </td>`
                            }
                        }
                    }
                    contents += `</tr>`
                })
                document.querySelector("#rpd-data").innerHTML = ''
                document.querySelector("#rpd-data").innerHTML = contents


                // Menambahkan event listener saat memulai aplikasi
                document.addEventListener('keydown', handleEscKey);




            })
            .catch(error => {
                console.error('error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }


    function formatRupiah(angka) {
        let reverse = angka.toString().split('').reverse().join('');
        let ribuan = reverse.match(/\d{1,3}/g);
        let formatted = ribuan.join('.').split('').reverse().join('');
        return `${formatted}`;
    }

    function editCell(cell) {
        // Mengganti isi cell dengan input
        cell.removeAttribute('data-jumlah')
        cell.classList.remove('have_jumlah');
        const row = cell.parentNode;
        const pagu = row.dataset.pagu
        console.log(row);
        let haveJumlah = row.querySelectorAll('.have_jumlah')
        let total = 0;
        haveJumlah.forEach((jumlah) => {
            total = total + parseInt(jumlah.dataset.jumlah)
            console.log(total);
        })
        // console.log(`total = ${total}`);
        const bulan = cell.dataset.bulan
        const formattedBulan = String(bulan).padStart(2, '0');

        const tahunSekarang = new Date().getFullYear();


        // Mendapatkan tanggal pertama bulan selanjutnya
        const tanggalPertamaBulan = new Date(Date.UTC(tahunSekarang, bulan - 1, 1));
        const tanggalTerakhirBulan = new Date(Date.UTC(tahunSekarang, bulan, 0));

        // Mengonversi ke zona waktu lokal dan format 'YYYY-MM-DD'
        const options = {
            timeZone: 'Asia/Jakarta',
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        };
        const tanggalMin = tanggalPertamaBulan.toLocaleDateString('id-ID', options).split('/').reverse().join('-');
        const tanggalMax = tanggalTerakhirBulan.toLocaleDateString('id-ID', options).split('/').reverse().join('-');

        if (!cell.hasAttribute('data-id')) {

            cell.innerHTML = '';
            cell.innerHTML = `<input min="${tanggalMin}" max="${tanggalMax}" value="${tanggalMin}" title="Tanggal Pencairan" id="tanggal_pencairan" class="form-control form-control-sm" type="date" placeholder="tanggal cair" />
                            <input id="rencana_jumlah" class="form-control form-control-sm" type="text" placeholder="jumlah" autofocus/>
                            <button type="button" onclick="saveRpd(this)" class="btn btn-icon btn-sm">
                            <span class="tf-icons bx bx-check" style="color:green"></span>
                            </button>
                            <button type="button" onclick="cancelRpd(this)" class="btn btn-icon btn-sm ">
                            <span class="tf-icons bx bx-x" style="color:red"></span>
                            </button>`
            const uangInput = cell.querySelector('#rencana_jumlah');


            uangInput.addEventListener('input', function(event) {
                // Menghapus semua karakter kecuali angka
                let cleanedInput = event.target.value.replace(/\D/g, '');

                // Memformat angka dengan pemisah ribuan
                const formattedInput = Number(cleanedInput).toLocaleString('id-ID');

                // Mengatur nilai input ke nilai yang telah diformat
                event.target.value = formattedInput;
                console.log(event.target.value.replace(/\D/g, ''));
                let sisa = row.querySelector('#sisa')
                if ((pagu - total - event.target.value.replace(/\D/g, '')) >= 0) {
                    sisa.innerText = formatRupiah(pagu - total - event.target.value.replace(/\D/g, ''))
                    sisa.removeAttribute('class')
                    if ((pagu - total - event.target.value.replace(/\D/g, '')) == 0)

                        sisa.setAttribute('class', 'badge bg-label-success')

                } else {
                    sisa.innerText = `- ${formatRupiah(pagu - total - event.target.value.replace(/\D/g, ''))}`
                    sisa.removeAttribute('class')
                    sisa.setAttribute('class', 'badge bg-label-danger')
                    alert('pagu kegiatan tidak mencukupi')
                    // sisa.classList.add('badge bg-label-danger');
                }


            });

            return
        }
        console.log(cell.dataset.id);
        // return;
        let url = '{{route("rpd.show",":id")}}';
        url = url.replace(':id', cell.dataset.id)

        fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            })
            .then(response => {
                console.log(response);
                if (!response.ok) {
                    if (response.status === 422) {
                        return response.json(); // Mengambil data kesalahan dari respons JSON
                    } else {
                        throw new Error('Ada kesalahan dalam permintaan');
                    }
                } else {
                    return response.json(); // Mengembalikan respons JSON dari permintaan berhasil
                }
            })
            .then(data => {
                console.log(data);
                cell.innerHTML = ''
                cell.dataset.id = data.data.id
                cell.removeAttribute('ondblclick')
                // cells.dataset.bulan = data.data.id
                const tanggal = String(data.data.tanggal).padStart(2, '0');

                cell.innerHTML = `
                            <input min="${tanggalMin}" max="${tanggalMax}" title="Tanggal Pencairan" id="tanggal_pencairan" 
                            class="form-control form-control-sm" type="date" value="${tahunSekarang}-${formattedBulan}-${tanggal}" />
                            <input id="rencana_jumlah" class="form-control form-control-sm" type="text" placeholder="jumlah" value="${data.data.jumlah}"/>
                            <button type="button" onclick="saveRpd(this)" class="btn btn-icon btn-sm">
                            <span class="tf-icons bx bx-check" style="color:green"></span>
                            </button>
                            <button type="button" onclick="cancelRpd(this)" class="btn btn-icon btn-sm ">
                            <span class="tf-icons bx bx-x" style="color:red"></span>
                            </button>`

                const uangInput = cell.querySelector('#rencana_jumlah');

                uangInput.addEventListener('input', function(event) {
                    // Menghapus semua karakter kecuali angka
                    let cleanedInput = event.target.value.replace(/\D/g, '');

                    // Memformat angka dengan pemisah ribuan
                    const formattedInput = Number(cleanedInput).toLocaleString('id-ID');

                    // Mengatur nilai input ke nilai yang telah diformat
                    event.target.value = formattedInput;
                    console.log(event.target.value.replace(/\D/g, ''));
                    let sisa = row.querySelector('#sisa')
                    if ((pagu - total - event.target.value.replace(/\D/g, '')) >= 0) {
                        sisa.innerText = formatRupiah(pagu - total - event.target.value.replace(/\D/g, ''))
                        sisa.removeAttribute('class')
                        if ((pagu - total - event.target.value.replace(/\D/g, '')) == 0)
                            sisa.setAttribute('class', 'badge bg-label-success')

                    } else {

                        sisa.innerText = `- ${formatRupiah(pagu - total - event.target.value.replace(/\D/g, ''))}`
                        // sisa.classList.add('badge bg-label-danger');
                        sisa.removeAttribute('class')

                        sisa.setAttribute('class', 'badge bg-label-danger')
                        alert('pagu kegiatan tidak mencukupi')

                    }
                });

            })
            .catch(error => {
                console.error('error:', error);
            });


    }

    function cancelRpd(button) {
        const row = button.parentNode.parentNode;
        const cells = button.parentNode;
        // const cells = row.getElementsByTagName('td');
        if (!cells.hasAttribute('data-id')) {
            cells.innerHTML = ` <td class="text-center" ondblclick="editCell(this)">
            -
            </td>`
            return
        }
        console.log(cells.dataset.id);
        // return;
        let url = '{{route("rpd.show",":id")}}';
        url = url.replace(':id', cells.dataset.id)

        fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            })
            .then(response => {
                console.log(response);
                if (!response.ok) {
                    if (response.status === 422) {
                        return response.json(); // Mengambil data kesalahan dari respons JSON
                    } else {
                        throw new Error('Ada kesalahan dalam permintaan');
                    }
                } else {
                    return response.json(); // Mengembalikan respons JSON dari permintaan berhasil
                }
            })
            .then(data => {
                console.log(data);
                if (data.status === true) {
                    cells.innerHTML = ''
                    cells.classList.add
                    cells.dataset.id = data.data.id
                    cells.setAttribute('ondblclick', 'editCell(this)')
                    cells.innerHTML = ` <td class="text-center" ondblclick="editCell(this)" data-id="${data.data.id}">
                                <span class="badge bg-label-warning"><small>${data.data.tanggal}-${data.data.bulan_indonesia}</small></span>
                                <br><span class="badge bg-label-primary" style="font-size: 14px">${formatRupiah(data.data.jumlah)}</span>
                                <br> 
                                <button type="button" onclick="deleteRpd(this)" class="btn btn-icon btn-sm ">
                                <span class="tf-icons bx bx-trash" style="color:red; font-size: 12px"></span>
                                </button>
                                </td>`

                } else {

                }

            })
            .catch(error => {
                console.error('error:', error);
            });
    }

    function saveRpd(button) {
        const row = button.parentNode.parentNode;
        const cells = button.parentNode;
        // const cells = row.getElementsByTagName('td');
        console.log(row.dataset.id);
        // return;
        const formData = new FormData()
        if (cells.hasAttribute('data-id'))
            formData.append('id', cells.dataset.id);
        formData.append('kegiatan_id', row.dataset.id);
        formData.append('tanggal_pencairan', cells.querySelector('#tanggal_pencairan').value);
        formData.append('rencana_jumlah', cells.querySelector('#rencana_jumlah').value.replace(/\D/g, ''))

        fetch('{{route("rpd.store")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log(response);
                if (!response.ok) {
                    if (response.status === 422) {
                        return response.json(); // Mengambil data kesalahan dari respons JSON
                    } else {
                        throw new Error('Ada kesalahan dalam permintaan');
                    }
                } else {
                    return response.json(); // Mengembalikan respons JSON dari permintaan berhasil
                }
            })
            .then(data => {
                console.log(data);
                if (data.status === true) {
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-top-center mt-3';
                    toastr.success('Sukses');
                    cells.innerHTML = ''
                    cells.dataset.id = data.data.id

                    cells.setAttribute('data-jumlah', data.data.rencana_jumlah)
                    cells.classList.add('have_jumlah');
                    cells.setAttribute('ondblclick', 'editCell(this)')
                    cells.innerHTML = ` <td class="text-center have_jumlah" ondblclick="editCell(this)" data-id="${data.data.id}" data-jumlah="${data.data.rencana_jumlah}">
                                <span class="badge bg-label-warning"><small>${data.data.tanggal} - ${data.data.bulan_indonesia}</small></span>
                                <br><span class="badge bg-label-primary" style="font-size: 14px">${formatRupiah(data.data.rencana_jumlah)}</span>
                                <br> 
                                <button type="button" onclick="deleteRpd(this)" class="btn btn-icon btn-sm ">
                                <span class="tf-icons bx bx-trash" style="font-size: 12px; color:red"></span>
                                </button>
                                </td>`

                } else {
                    let errorMsg = '';
                    data.details.forEach(data => {
                        errorMsg += `${data}, `
                    })
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-top-center mt-3';
                    toastr.error('Perhatikan Inputan! , ' + errorMsg);

                    // alert(')
                }

            })
            .catch(error => {
                console.error('error:', error);
            });
    }

    function deleteRpd(button) {
        let conf = confirm('yakin hapus?')
        if (!conf) return
        const cell = button.parentNode;
        // console.log(row);
        let url = '{{route("rpd.delete",":id")}}';
        url = url.replace(':id', cell.dataset.id)

        fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Login failed.');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === true) {
                    cell.removeAttribute('data-id')
                    cell.innerHTML = '-';
                }
            })
            .catch(error => {
                console.error('Login error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }

    function kirimRpd() {
        let konfirmasi = confirm('Yakin kirim RPD ke keuangan? setelah mengirim RPD tidak dapat diubah lagi')
        if (konfirmasi) {
            alert('RPD Terkirim ke keuangan')



            const formData = new FormData();
            // if (row.hasAttribute('data-id'))
            // formData.append('id', row.dataset.id);
            formData.append('organisasi_rpd_id', JSON.parse(localStorage.getItem('tahun_anggaran')).organisasi_rpd);
            fetch('{{route("rpd.sesi.store")}}', {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    },
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    console.log(response);
                    if (!response.ok) {
                        if (response.status === 422) {
                            alert('sub kode kegiatan tidak boleh sama')
                        }
                        throw new Error(response);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    if (data.status === true) {
                        toastr.options.closeButton = true;
                        toastr.options.positionClass = 'toast-top-center mt-3';
                        toastr.success('Sukses dikirim');
                    }
                })
                .catch(error => {
                    console.error('error:', error);
                    // alert('ada kesalahan, ' + error)

                    // Tampilkan pesan error atau lakukan sesuatu jika login gagal
                });
        }
    }


    function tambahBaris(button) {
        if (document.querySelector("#tambah-baris").hasAttribute('data-is-no-result')) {
            var tbody = document.querySelector('#kegiatan-data');
            var firstRow = tbody.querySelector('tr:first-child');
            if (firstRow)
                tbody.removeChild(firstRow);

        }
        const table = document.getElementById('kegiatan-data');
        const newRow = table.insertRow(table.rows.length);
        const actCell = newRow.insertCell(0);

        var hasNoResultAttribute = button.getAttribute('data-is-no-result');

        if (hasNoResultAttribute !== null) {
            actCell.innerHTML = `<button data-state='insert' class='btn btn-primary btn-sm' onclick='saveKegiatan(this)'>Simpan</button>
        <button class='btn btn-danger btn-sm mt-2' data-is-no-result="${button.dataset.isNoResult}" onclick='cancel(this)'>Batal</button>`
        } else {
            actCell.innerHTML = `<button data-state='insert' class='btn btn-primary btn-sm' onclick='saveKegiatan(this)'>Simpan</button>
        <button class='btn btn-danger btn-sm' onclick='cancel(this)'>Batal</button>`
        }
        const numberCell = newRow.insertCell(1);
        numberCell.textContent = table.rows.length; // Nomor urut baris


        let formInput = [{
                'label': 'Sub Kegiatan',
                'name': 'sub_kegiatan_kode',
                'id': 'sub_kegiatan_kode',
                'type': 'text',
                'placeholder': 'Isi Sub Kegiatan',
                'form': 'input',
            },
            {
                'label': 'Nama Kegiatan',
                'name': 'kegiatan_nama',
                'id': 'kegiatan_nama',
                'placeholder': 'Isi Nama Kegiatan',
                'form': 'textarea',
            },
            {
                'label': 'Pagu Kegiatan',
                'name': 'jumlah_biaya',
                'id': 'jumlah_biaya',
                'placeholder': 'Isi Pagu Kegiatan',
                'type': 'text',
                'form': 'input',
            },
            {
                'label': 'Sumber Dana',
                'name': 'sumber_dana',
                'id': 'sumber_dana',
                'type': 'text',
                'form': 'select',
                'select_item': [{
                        'text': 'RM',
                        'value': 'RM'
                    },
                    {
                        'text': 'PNBP',
                        'value': 'PNBP'
                    },
                ]
            },
        ]

        const cell = newRow.insertCell(2)
        cell.setAttribute('colspan', '3')
        formInput.forEach(input => {
            var element
            if (input.form === 'input')
                element = document.createElement('input');
            else if (input.form === 'textarea')
                element = document.createElement('textarea')
            else if (input.form === 'select')
                element = document.createElement('select');

            const label = document.createElement('label');
            label.setAttribute('class', 'form-label')
            label.innerText = input.label

            element.setAttribute('id', input.id);
            element.setAttribute('class', "form-control");
            element.setAttribute('placeholder', input.placeholder);
            element.setAttribute('name', input.name);
            element.setAttribute('type', input.type);
            element.setAttribute('required', 'required');
            if (input.form === 'select') {
                input.select_item.forEach(item => {
                    var option = document.createElement('option')
                    option.text = item.text
                    option.value = item.value
                    element.appendChild(option)
                })
            }
            cell.appendChild(label);
            cell.appendChild(element);
        });
        cell.querySelector('#jumlah_biaya').addEventListener('input', function(event) {
            // Menghapus semua karakter kecuali angka
            let cleanedInput = event.target.value.replace(/\D/g, '');
            // Memformat angka dengan pemisah ribuan
            const formattedInput = Number(cleanedInput).toLocaleString('id-ID');
            // Mengatur nilai input ke nilai yang telah diformat
            event.target.value = formattedInput;
        });

    }

    function saveKegiatan(button) {
        const row = button.parentNode.parentNode;
        const cells = row.getElementsByTagName('td');
        console.log(cells);
        const stringData = cells[2].querySelector('#sub_kegiatan_kode').value;
        const parts = stringData.split('.'); // Memisahkan string berdasarkan titik
        const [sub_kegiatan_kode1, sub_kegiatan_kode2, sub_kegiatan_kode3, sub_kegiatan_kode4, sub_kegiatan_kode5] = parts.map(part => part.trim());
        const token = localStorage.getItem('token');
        const decodedToken = jwt_decode(token);
        const formData = new FormData();
        if (row.hasAttribute('data-id'))
            formData.append('id', row.dataset.id);
        formData.append('organisasi_rpd_id', JSON.parse(localStorage.getItem('tahun_anggaran')).organisasi_rpd);
        formData.append('sumber_dana', cells[2].querySelector('#sumber_dana').value);
        formData.append('kegiatan_nama', cells[2].querySelector('#kegiatan_nama').value);
        formData.append('sub_kegiatan_kode1', sub_kegiatan_kode1);
        formData.append('sub_kegiatan_kode2', sub_kegiatan_kode2);
        formData.append('sub_kegiatan_kode3', sub_kegiatan_kode3);
        formData.append('sub_kegiatan_kode4', sub_kegiatan_kode4);
        formData.append('sub_kegiatan_kode5', sub_kegiatan_kode5);
        formData.append('jumlah_biaya', cells[2].querySelector('#jumlah_biaya').value.replace(/\D/g, ''));
        formData.append('urutan', '1');
        fetch('{{route("kegiatan.store")}}', {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log(response);
                if (!response.ok) {
                    if (response.status === 422) {
                        alert('sub kode kegiatan tidak boleh sama')
                    }
                    throw new Error(response);
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                if (data.status === true) {
                    if (document.querySelector("#tambah-baris").hasAttribute('data-is-no-result')) {
                        document.querySelector("#tambah-baris").removeAttribute('data-is-no-result')
                    }
                    row.dataset.id = data.data.id
                    toastr.options.closeButton = true;
                    toastr.options.positionClass = 'toast-top-center mt-3';
                    toastr.success('Data berhasil ditambahkan!');
                    cells[0].innerHTML = `
                    <button class="btn btn-sm btn-warning"onclick="editBaris(this)">
                    <i class="tf-icons bx bx-pencil"></i></button>`
                    cells[2].removeAttribute('colspan')
                    cells[2].innerHTML = `<td>
                    <span class="badge bg-label-primary mb-1">

                    <small>${data.data.sub_kegiatan_kode1}.
                    ${data.data.sub_kegiatan_kode2}.
                    ${data.data.sub_kegiatan_kode3}.
                    ${data.data.sub_kegiatan_kode4}.
                    ${data.data.sub_kegiatan_kode5}
                    </small>
                    </span>
                    <br><strong>${data.data.kegiatan_nama}</strong>
                    <br> 
                    <span class="badge bg-label-dark mt-1">Pagu : Rp. ${formatRupiah(data.data.jumlah_biaya)} (${data.data.sumber_dana})</span>
                    </td>`
                    if (button.dataset.state == "insert") {
                        row.insertCell().innerHTML = '<span>Belum ada RPD</span>'
                        row.insertCell().innerHTML = '<button class="btn btn-sm btn-danger"onclick="deleteBaris(this)"><i class="tf-icons bx bx-trash"></i></button>'
                    }
                }
            })
            .catch(error => {
                console.error('error:', error);
                // alert('ada kesalahan, ' + error)

                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }

    function editBaris(button) {
        const row = button.parentNode.parentNode;
        const cells = row.getElementsByTagName('td');
        // return console.log(row.dataset.id);
        cells[0].innerHTML = `<button data-state='edit' class='btn btn-primary btn-sm' onclick='saveKegiatan(this)'>Edit</button>
        <button class='btn btn-danger btn-sm mt-2' onclick='cancelEdit(this)'>Batal</button>`
        cells[1].textContent = cells[1].innerText.trim(); // Nomor urut baris

        let url = '{{route("kegiatan.show",":id")}}';
        url = url.replace(':id', row.dataset.id)
        fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Login failed.');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                let kegiatan_kode = `${data.data.sub_kegiatan_kode1}.${data.data.sub_kegiatan_kode2}.${data.data.sub_kegiatan_kode3}.${data.data.sub_kegiatan_kode4}.${data.data.sub_kegiatan_kode5}`
                let formInput = [{
                        'label': 'Sub Kegiatan',
                        'name': 'sub_kegiatan_kode',
                        'value': `${kegiatan_kode}`,
                        'id': 'sub_kegiatan_kode',
                        'type': 'text',
                        'placeholder': 'Isi Sub Kegiatan',
                        'form': 'input',
                    },
                    {
                        'label': 'Nama Kegiatan',
                        'name': 'kegiatan_nama',
                        'value': `${data.data.kegiatan_nama}`,

                        'id': 'kegiatan_nama',
                        'placeholder': 'Isi Nama Kegiatan',
                        'form': 'textarea',
                    },
                    {
                        'label': 'Pagu Kegiatan',
                        'name': 'jumlah_biaya',
                        'value': `${formatRupiah(data.data.jumlah_biaya)}`,
                        'id': 'jumlah_biaya',
                        'placeholder': 'Isi Pagu Kegiatan',
                        'type': 'text',
                        'form': 'input',
                    },
                    {
                        'label': 'Sumber Dana',
                        'name': 'sumber_dana',
                        'value': `${data.data.sumber_dana}`,
                        'id': 'sumber_dana',
                        'type': 'text',
                        'form': 'select',
                        'select_item': [{
                                'text': 'RM',
                                'value': 'RM'
                            },
                            {
                                'text': 'PNBP',
                                'value': 'PNBP'
                            },
                        ]
                    },
                ]
                cells[2].innerHTML = ""

                formInput.forEach(input => {
                    var element
                    if (input.form === 'input')
                        element = document.createElement('input');
                    else if (input.form === 'textarea')
                        element = document.createElement('textarea')
                    else if (input.form === 'select')
                        element = document.createElement('select');

                    const label = document.createElement('label');
                    label.setAttribute('class', 'form-label')
                    label.innerText = input.label
                    element.setAttribute('id', input.id);
                    element.setAttribute('class', "form-control");
                    element.setAttribute('placeholder', input.placeholder);
                    element.setAttribute('name', input.name);
                    element.setAttribute('type', input.type);
                    element.setAttribute('required', 'required');
                    element.value = input.value.trim();
                    if (input.form === 'select') {
                        input.select_item.forEach(item => {
                            var option = document.createElement('option')
                            option.text = item.text
                            option.value = item.value
                            element.appendChild(option)
                        })
                    }
                    cells[2].appendChild(label);
                    cells[2].appendChild(element);
                });
                row.querySelector('#jumlah_biaya').addEventListener('input', function(event) {
                    // Menghapus semua karakter kecuali angka
                    let cleanedInput = event.target.value.replace(/\D/g, '');
                    // Memformat angka dengan pemisah ribuan
                    const formattedInput = Number(cleanedInput).toLocaleString('id-ID');
                    // Mengatur nilai input ke nilai yang telah diformat
                    event.target.value = formattedInput;
                });
            })
            .catch(error => {
                console.error('error:', error);
            });
        return
    }

    function deleteBaris(button) {
        let conf = confirm('yakin hapus? jika sudah ada RPD pada kegiatan ini, maka akan ikut terhapus')
        if (!conf) return
        const row = button.parentNode.parentNode;
        console.log(row);
        let url = '{{route("kegiatan.delete",":id")}}';
        url = url.replace(':id', row.dataset.id)

        fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Login failed.');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === true)

                    row.remove();
                toastr.options.closeButton = true;
                toastr.options.positionClass = 'toast-top-center mt-3';
                toastr.success('data dihapus');
                loadData()


            })
            .catch(error => {
                console.error('Login error:', error);
                // Tampilkan pesan error atau lakukan sesuatu jika login gagal
            });
    }

    function cancelEdit(button) {
        const row = button.parentNode.parentNode;
        const cells = row.getElementsByTagName('td');

        let url = '{{route("kegiatan.show",":id")}}';
        url = url.replace(':id', row.dataset.id)
        fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                method: 'GET',
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Login failed.');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                if (data.status === true) {
                    row.dataset.id = data.data.id
                    cells[0].innerHTML = `
                    <button class="btn btn-sm btn-warning"onclick="editBaris(this)">
                    <i class="tf-icons bx bx-pencil"></i></button>`
                    cells[2].removeAttribute('colspan')
                    cells[2].innerHTML = `<td>
                    <span class="badge bg-label-primary">
                    <small>${data.data.sub_kegiatan_kode1}.
                    ${data.data.sub_kegiatan_kode2}.
                    ${data.data.sub_kegiatan_kode3}.
                    ${data.data.sub_kegiatan_kode4}.
                    ${data.data.sub_kegiatan_kode5}.
                    </small>
                    </span>
                    <br><strong>${data.data.kegiatan_nama}</strong>
                    <br> 
                    <span class="badge bg-label-dark">Pagu : Rp. ${formatRupiah(data.data.jumlah_biaya)} (${data.data.sumber_dana})</span>
                    </td>`
                    if (button.dataset.state == "insert") {
                        row.insertCell().innerHTML = '<span>Belum ada RPD</span>'
                        row.insertCell().innerHTML = '<button class="btn btn-sm btn-danger"onclick="deleteBaris(this)"><i class="tf-icons bx bx-trash"></i></button>'
                    }
                }
            })
            .catch(error => {
                console.error('error:', error);
            });
        return
    }

    //cancel untuk input
    function cancel(button) {
        const row = button.parentNode.parentNode;
        row.remove();

        var hasNoResultAttribute = button.getAttribute('data-is-no-result');

        if (hasNoResultAttribute !== null) {
            document.querySelector("#kegiatan-data").innerHTML = '<tr><td colspan="5" class="text-center">Data tidak ada</td></tr>'
        }
    }

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