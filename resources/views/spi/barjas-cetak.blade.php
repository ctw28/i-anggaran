<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>CETAK AMPRA</title>
    <link rel="shortcut icon" href="https://simpeg.iainkendari.ac.id/assets/img/favicon.ico">
    <style type="text/css" media="all">
        @page {
            size: 21cm 33.56cm portrait;
            /* A4 size */
            margin: 1cm 2cm 1cm 2cm;
            /* this affects the margin in the printer settings */
        }

        @media all {

            body,
            table {
                background-color: #FFFFFF;
                color: #000;
                font-size: 18px;
                font-family: arial;
            }

            .table {
                border-collapse: collapse;
                width: 100%;
            }

            .table,
            .table th,
            .table td {
                border: 1px solid black;
            }

            .table th,
            .table td {
                padding: 4px;
            }


            .page-break {
                display: none;
                display: block;
                page-break-after: always;
            }

            .border {
                border-top: none;
                border-bottom: none;
            }

            .text-center {
                text-align: center;
                margin: 0 auto;
            }

            .text-right {
                text-align: right;
            }

            .text-up {
                vertical-align: top;
            }

            .trapezium {
                transform: skew(-20deg);
                border: 1px solid #000
            }

            .header {
                display: flex;
                align-items: center;
                /* Menyelaraskan item secara vertikal di tengah */
                justify-content: space-between;
                /* Menyelaraskan gambar dan h4 secara horizontal dengan ruang di antara mereka */
            }

            .header img {
                max-width: 100px;
                /* Atur lebar maksimum gambar jika diperlukan */
                height: auto;
                /* Pastikan gambar tetap proporsional */
            }

            .header h4 {
                margin: 0;
                /* Hapus margin default pada h4 */
                text-transform: uppercase;
                /* Tetap menjaga transformasi teks */
            }
        }
    </style>
</head>
<!--
<body onload="window.print()" onfocus="window.close()">
-->

<body>

    <div style="width:21cm;margin:0 auto; font-size:18px">

        <!--TITLE-->
        <div class="header">
            <img src="https://simpeg.iainkendari.ac.id/images/logoweb.png" alt="Logo">
            <h4 class="text-center">
                Kertas Kerja Analisis Dokumen Pengadaan Barang dan Jasa <br>
                (BARJAS) Tahun 2024
            </h4>
        </div>
        <hr>
        <!--TITLE END-->
        <table id="myTable" style="margin-bottom:10px">
            <tbody style="font-size:12px;">
            </tbody>
        </table>

        <!--CONTENT-->
        <table class="table">
            <tbody id="template-periksa" style="font-size:12px;">
                <!-- //data periksa di sini -->
            </tbody>
            <tfooter>
                <tr style="font-size:12px;">
                    <th colspan="2" class="text-center">Jumlah Dokumen</th>
                    <th class="text-center" id="total-dokumen">26 Dokumen</th>
                    <th></th>
                </tr>
            </tfooter>
        </table>

        <br>
        <p style="font-size:12px; text-transform:uppercase"><b>DOKUMEN TELAH DITERIMA DAN DIPERIKSA OLEH SPI PADA HARI <span id="tanggal_periksa"></span></b></p>

        <table border="0" cellpadding="2" cellspacing="2" style="font-size:12px;">
            <tbody>
                <tr>
                    <td style="width:1cm">&nbsp;</td>
                    <td style="width:7cm;vertical-align:bottom;">
                        Mengetahui,<br />
                        Kepala SPI IAIN Kendari
                    </td>
                    <td style="width:5cm">&nbsp;</td>
                    <td style="width:7cm">
                        Pemeriksa/Registrasi<br>
                        Analis Audit Kepatuhan & Keuangan
                    </td>
                    <td style="width:1cm">&nbsp;</td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <b id="ketua-spi">Dr. Sukadir Kete, M.Pd</b><br>
                        NIP. <span id="ketua-spi-nip">197509282005011004</span>
                    </td>
                    <td></td>
                    <td>
                        <b id="pemeriksa"></b><br>
                        NIP. <span id="pemeriksa-nip"></span>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

<script>
    loadSesiData()

    function createRow(label, id) {
        return `
            <tr>
                <td width="170px">${label}</td>
                <td width="10px">:</td>
                <td><span id="${id}"></span></td>
            </tr>
        `;
    }

    // Buat elemen-elemen tabel
    const tableContent = `
        ${createRow('Satker/Fakultas/Unit', 'satker')}
        ${createRow('Jenis Barjas yang diadakan', 'barjas_nama')}
        ${createRow('Nama PPK', 'ppk')}
        ${createRow('Nama Pejabat Pengadaan', 'pejabat_pengadaan')}
        ${createRow('Rekanan', 'rekanan')}
        ${createRow('Metode Pengadaan', 'metode')}
        ${createRow('Tanggal Masuk Kontrak', 'tanggal_kontrak')}
        ${createRow('Nilai Kontrak', 'nilai')}
        ${createRow('Kode Akun', 'kode_akun')}
    `;
    document.querySelector('#myTable tbody').innerHTML = tableContent;

    async function loadSesiData() {
        let id = "{{$barjas_sesi_id}}"
        let verifikatorId = JSON.parse(localStorage.getItem('tahun_anggaran')).verifikator_id
        let template = document.querySelector('#template-periksa')
        let url = "{{route('barjas_sesi.index')}}?sesi_id=" + id + "&template=true&verifikator=true"
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
        document.querySelector('#satker').innerText = response.data.satker;
        document.querySelector('#barjas_nama').innerText = response.data.barjas_nama;
        document.querySelector('#ppk').innerText = response.data.ppk;
        document.querySelector('#pejabat_pengadaan').innerText = response.data.pejabat_pengadaan;
        document.querySelector('#rekanan').innerText = response.data.rekanan;
        document.querySelector('#metode').innerText = response.data.metode;
        document.querySelector('#tanggal_kontrak').innerText = formatTanggal(response.data.tanggal_kontrak);
        // document.querySelector('#nilai').innerText = formatRupiah(response.data.nilai);
        document.querySelector('#nilai').innerText = response.data.nilai;
        document.querySelector('#kode_akun').innerText = response.data.kode_akun;
        document.querySelector('#tanggal_periksa').innerText = formatTanggal(response.data.tanggal_periksa, 'hari');

        document.querySelector('#pemeriksa').innerText = response.data.verifikator.pegawai.data_diri.nama_lengkap
        document.querySelector('#pemeriksa-nip').innerText = response.data.verifikator.pegawai.pegawai_nomor_induk
        let totalDokumen = 0
        response.data.barjas_template.bagian.map((bagian, index) => {
            if (index == 0) {
                contents += `<tr style="background:#b8edff">`
                contents += `<td class="text-center"><b>No</b></td>`
                contents += `<td class="text-center"><b>${bagian.nama_bagian}</b></td>`
                contents += `<td class="text-center"><b>Status</b></td>`
                contents += `<td class="text-center"><b>anggal Dokumen</b></td>`
                contents += `</tr>`
            } else {
                contents += `<tr style="background:#b8edff">`
                contents += `<td colspan="4" class="text-center"><b>${bagian.nama_bagian}</b></td>`
                contents += `</tr>`
            }
            bagian.item.map((item, index) => {
                if (item.periksa != null) {
                    contents += `<tr>`
                    contents += `<td class="text-center">${urut}</td>`
                    contents += `<td>${item.nama_dokumen}</td>`
                    contents += `<td class="text-center">Ada</td>`
                    contents += `<td class="text-center">${formatTanggal(item.periksa.tanggal_dokumen)}</td>`
                    contents += `</tr>`
                    urut++
                    totalDokumen++
                } else {
                    contents += `<tr>`
                    contents += `<td class="text-center">${urut}</td>`
                    contents += `<td>${item.nama_dokumen}</td>`
                    contents += `<td class="text-center">Tidak Ada</td>`
                    contents += `<td class="text-center">-</td>`
                    contents += `</tr>`
                    urut++
                }
            })
        })
        document.querySelector('#total-dokumen').innerText = totalDokumen + ' Dokumen'
        template.innerHTML = ''
        template.innerHTML = contents
    }

    function formatTanggal(tanggal, hari = null) {
        const bulanNama = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const hariNama = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

        const dateObj = new Date(tanggal);
        const hariTanggal = ("0" + dateObj.getDate()).slice(-2);
        const bulan = bulanNama[dateObj.getMonth()];
        const tahun = dateObj.getFullYear();
        const namaHari = hariNama[dateObj.getDay()];

        if (hari !== null) {
            return `${namaHari}, ${hariTanggal} ${bulan} ${tahun}`;
        }

        return `${hariTanggal} ${bulan} ${tahun}`;
    }


    function formatRupiah(angka) {
        let reverse = angka.toString().split('').reverse().join('');
        let ribuan = reverse.match(/\d{1,3}/g);
        let formatted = ribuan.join('.').split('').reverse().join('');
        return `${formatted}`;
    }
</script>

</html>