<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Lembar Pemeriksaan Berkas</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="shortcut icon" href="https://simpeg.iainkendari.ac.id/assets/img/favicon.ico">
    <style type="text/css" media="all">
        @page {
            size: 21cm 29.7cm portrait;
            /* A4 size */
            margin: 1cm 2cm 1cm 2cm;
            /* this affects the margin in the printer settings */
        }

        @media all {
            table {
                font-size: 16px;
            }

            body {
                background-color: #FFFFFF;
                font-family: arial;

            }

            .page-break {
                display: none;
                display: block;
                page-break-after: always;
            }

            ul {
                list-style: none;
                padding: 0;
                margin: 0;
                text-align: left;
            }

            .text-center {
                text-align: center;
                margin: 0 auto;
            }

            .text-up {
                vertical-align: top;
            }

            .trapezium {
                transform: skew(-20deg);
                border: 1px solid #000
            }

            p {
                text-align: justify;
            }

            i {
                /* font-size: 20px; */
            }

            li {}
        }
    </style>
</head>
<!--
<body onload="window.print()" onfocus="window.close()">
-->

<body style="color:#000;font-size:16px;">

    <div style="width:21cm;margin:0 auto;">

        <!--KOP-->
        <table border="0" cellpadding="1" cellspacing="1" style="width:100%;" class="text-center">
            <tr>
                <td style="text-align: center; vertical-align: middle; width: 15%;">
                    <img src="https://simpeg.iainkendari.ac.id/./upload/logo/49sqk.png" style="width: 70px;" />
                </td>
                <td style="vertical-align: top; width: 70%;"><strong>
                        <span style="font-size:20px">KEMENTERIAN AGAMA REPUBLIK INDONESIA</span><br />
                        <span style="font-size:20px">INSTITUT AGAMA ISLAM NEGERI (IAIN) KENDARI</span></strong><br />
                    <span style="font-size:19px">SATUAN PENGAWAS INTERNAL</span></strong><br />
                    <span style="font-size:12px">
                        Jl. Sultan Qaimuddin No. 17, Telp (0401) 3192081 Fax (0401) 3193710<br />
                        Email : SPI_iainkendari@yahoo.com, Website : spi.iainkendari.ac.id
                    </span>
                </td>
                <td style="text-align: center; vertical-align: middle; width: 15%;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center; vertical-align: top;border-top:2px #000 solid;">&nbsp;</td>
            </tr>
        </table>
        <!--KOP END-->

        <!--TITLE-->
        <h4 class="text-center" style="text-transform:uppercase">Lembar Kertas Kerja Pemeriksaan Dokumen<br>Pengajuan Pencairan Anggaran</h4>
        <!--TITLE END-->


        <table border="1" cellpadding="2" cellspacing="0">
            <tbody>
                <tr>
                    <td style="width:5.5cm">FAKULTAS / LEMBAGA / PUSAT / UNIT</td>
                    <td style="width:15cm" colspan="4"><span id="organisasi"></span></td>
                </tr>
                <tr>
                    <td>Sumber Dana</td>
                    <td id="blu"><i class="tf-icons bx bx-checkbox me-1"></i> BLU</td>
                    <td id="rm"><i class="tf-icons bx bx-checkbox me-1"></i> RM</td>
                    <td id="boptn"><i class="tf-icons bx bx-checkbox me-1"></i> BOTPN</td>
                    <td id="lainnya"><i class="tf-icons bx bx-checkbox me-1"></i> .....</td>
                </tr>

            </tbody>
        </table>

        <br>
        <table border="1" cellpadding="2" cellspacing="0" style="font-size:12px;width:100%">
            <tbody style="text-transform: uppercase; vertical-align:top">
                <tr>
                    <td style="vertical-align: middle;" style="width:3cm">KELENGKAPAN DOKUMEN</td>
                    <td class="text-center" style="width:5cm">
                        <b>PELAKSAAN KEGIATAN</b><br>
                        <ul id="pelaksanaan-kegiatan-list" style="vertical-align: middle;"></ul>
                    </td>
                    <td class="text-center" style="width:5cm">
                        <b>HONORARIUM/INSENTIF BULANAN</b>
                        <br>
                        <ul id="honor-list"></ul>
                        <hr>
                        <b>UANG PERSEDIAAN</b><br>
                        <ul id="uang-persediaan-list"></ul>
                        <hr>
                        <b>GANTI UANG PERSEDIAAN</b><br>
                        <ul id="ganti-uang-persediaan-list"></ul>
                    </td>
                    <td class="text-center" style="width:4cm">
                        <b>PERJALANAN DINAS</b><br>
                        <ul id="perjadin-list"></ul>
                    </td>
                    <td class="text-center" style="width:3cm">
                        <b>LEMBUR</b><br>
                        <ul id="lembur-list"></ul>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="4"><small>*) Jika kegiatan telah selesai &nbsp; &nbsp; &nbsp; **) Jika Ada &nbsp; &nbsp; &nbsp; ***) Perjalan Dinas Luar Negeri</small></td>
                </tr>
                <tr>
                    <td>TIM PEMERIKSA</td>
                    <td colspan="4" class="text-center" id="pemeriksa"></td>
                </tr>
                <tr>
                    <td>NAMA KEGIATAN</td>
                    <td colspan="4" id="show-pencairan-nama"></td>
                </tr>
                <tr>
                    <td>REKOMENDASI</td>
                    <td colspan="4" id="rekomendasi">Catatan SPI : </td>
                </tr>
            </tbody>
        </table>
        <p>Pengajuan pencairan dana Bapak/Ibu telah kami periksa sesuai dengan peraturan perundang-undangan,
            Ketidaklengkapan dokumen pencairan agar segera dilengkapi dan/atau diperbaiki.</p>
        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:6cm"></td>
                    <td style="width:6cm"></td>
                    <td style="width:10cm">
                        Mengetahui,<br />
                        Kepala Satuan Pengawas Internal<br>
                        IAIN Kendari
                    </td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Dr. Sukadir Kete, M.Pd</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>NIP. 19975092820050011004</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

<script>
    showPeriksa()
    async function showPeriksa() {
        let url = '{{route("periksa.daftar.index",":id")}}'
        url = url.replace(':id', "{{$sesi_id}}")
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "GET",
        })
        response = await sendRequest.json()
        console.log(response);
        // if(response.data.length > 0){
        if (response.data[0].periksa_sesi.sumber_dana == "blu")
            document.querySelector("#blu").innerHTML = `<i class="tf-icons bx bx-check-square me-1" style="font-weight:bold"></i> BLU`
        else if (response.data[0].periksa_sesi.sumber_dana == "rm")
            document.querySelector("#rm").innerHTML = `<i class="tf-icons bx bx-check-square me-1" style="font-weight:bold"></i> RM`
        else if (response.data[0].periksa_sesi.sumber_dana == "boptn")
            document.querySelector("#boptn").innerHTML = `<i class="tf-icons bx bx-check-square me-1" style="font-weight:bold"></i> BOTPN`
        else if (response.data[0].periksa_sesi.sumber_dana == "lainnya")
            document.querySelector("#lainnya").innerHTML = `<i class="tf-icons bx bx-check-square me-1" style="font-weight:bold"></i> .....`
        var periksa = document.querySelector('#periksa')
        document.querySelector("#organisasi").innerText = `${response.data[0].periksa_sesi.periksa_usul.pencairan_sesi.kegiatan.organisasi.organisasi.organisasi_nama} (${response.data[0].periksa_sesi.periksa_usul.pencairan_sesi.kegiatan.organisasi.organisasi.organisasi_singkatan})`
        document.querySelector("#show-pencairan-nama").innerText = response.data[0].periksa_sesi.periksa_usul.pencairan_sesi.pencairan_nama
        document.querySelector("#pemeriksa").innerHTML = `
        PEMERIKSA / REGISTRASI : <br>
        ${response.data[0].periksa_sesi.verifikator.sebutan_jabatan}<br><br><br><br>
        ${response.data[0].periksa_sesi.verifikator.pegawai.data_diri.nama_lengkap}<br>
        NIP. ${response.data[0].periksa_sesi.verifikator.pegawai.pegawai_nomor_induk}
        `
        response.data[0].periksa_template.periksa_daftar.map((data, index) => {
            let contents = ''
            let kategori = `${data.periksa_kategori.nama_kategori}`
            console.log(kategori);
            let kategoriList = document.querySelector('#pelaksanaan-kegiatan-list')
            if (kategori == "Honorarium / Insentif Bulanan")
                kategoriList = document.querySelector('#honor-list')
            else if (kategori == "Uang Persediaan")
                kategoriList = document.querySelector('#uang-persediaan-list')
            else if (kategori == "Ganti Uang Persediaan")
                kategoriList = document.querySelector('#ganti-uang-persediaan-list')
            else if (kategori == "Perjalanan Dinas")
                kategoriList = document.querySelector('#perjadin-list')
            else if (kategori == "Lembur")
                kategoriList = document.querySelector('#lembur-list')
            data.periksa_kategori.periksa_kategori_list.map(item => {
                contents += `<li>`
                if (item.periksa_dokumen.length > 0) {
                    if (item.periksa_dokumen[0].is_valid == 1)
                        contents += `<i class="tf-icons bx bx-check-square me-1" style="font-weight:bold"></i> ${item.periksa_list.nama_list}`
                    else
                        contents += `<i class="tf-icons bx bx-x-circle me-1"></i> ${item.periksa_list.nama_list}`
                } else {
                    contents += `<i class="tf-icons bx bx-checkbox me-1"></i> ${item.periksa_list.nama_list}`
                }
                contents += `</li>`
            })
            kategoriList.innerHTML = contents
        })

    }
</script>

</html>