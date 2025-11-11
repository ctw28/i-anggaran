<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Cetak SPM</title>
    <link rel="shortcut icon" href="https://simpeg.iainkendari.ac.id/assets/img/favicon.ico">
    <style type="text/css" media="all">
        @page {
            size: 21cm 29.7cm portrait;
            /* A4 size */
            margin: 1cm 2cm 1cm 2cm;
            /* this affects the margin in the printer settings */
        }

        @media all {
            body {
                background-color: #FFFFFF;
                font-family: arial;
            }

            table {
                font-size: 18px;
            }

            .page-break {
                display: none;
                display: block;
                page-break-after: always;
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

            .p0 {
                margin-block-start: 0;
                margin-block-end: 0;
            }
        }
    </style>
</head>
<!--
<body onload="window.print()" onfocus="window.close()">
-->

<body style="color:#000;font-size:18px;">

    <div style="width:21cm;margin:0 auto;">

        <!--KOP-->
        <table border="0" cellpadding="1" cellspacing="1" style="width:100%;" class="text-center">
            <tr>
                <td style="text-align: center; vertical-align: middle; width: 15%;">
                    <img src="https://simpeg.iainkendari.ac.id/./upload/logo/49sqk.png" style="width: 70px;" />
                </td>
                <td style="vertical-align: top; width: 70%;"><strong>
                        <span style="font-size:18">KEMENTERIAN AGAMA REPUBLIK INDONESIA</span><br />
                        <span style="font-size:17">INSTITUT AGAMA ISLAM NEGERI (IAIN) KENDARI</span></strong><br />
                    <span style="font-size:12">
                        Jl. Sultan Qaimuddin No. 17, Telp (0401) 3192081 Fax (0401) 3193710<br />
                        Email : humas@iainkendari.ac.id, Website : iainkendari.ac.id
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
        <h3 class="text-center">LEMBAR PERMOHONAN PENERBITAN SPM</h3><br />
        <br />
        <!--TITLE END-->


        <p>Kepada Yth :<br>
            Pejabat Penanda Tangan Surat Perintah Membayar<br>
            IAIN Kendari<br>
            Di -<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kendari</p><br>


        <p style="text-align:justify">Assalamu Alaikum Warahmatullahi Wabarakatuh<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Dengan ini kami mengajukan permintaan pembayaran
            <b><i><span id="pencairan-nama"></span></i></b> sesuai <span id="dasar"></span>
            sebesar
            <b><i><span id="total-seluruhnya"></span> (<span id="terbilang"></span> Rupiah).</i></b><br>
            Demikian, permohonan ini atas kerjasamanya diucapkan terima kasih.
        </p>



        <br>

        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
                <tr>
                    <td style="width:7cm">
                    </td>
                    <td style="width:7cm">
                    </td>
                    <td style="width:7cm">
                        Kendari,
                        <span id="tanggal-dokumen"></span>,<br />
                        Pejabat Pembuat Komitmen
                    </td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b></b></td>
                    <td><b></b></td>
                    <td><b><span id="ppk-nama"></span></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>NIP. <span id="ppk-nip"></span></td>
                </tr>
            </tbody>
        </table>

    </div>
</body>
<script>
    loadSesiData()
    async function loadSesiData() {
        let jenis = "{{$jenis}}"
        let url = '{{route("cetak.nominal","$pencairan_id")}}'
        if (jenis == "belanja")
            url = '{{route("cetak.belanja","$pencairan_id")}}'
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
        })
        response = await sendRequest.json()
        console.log(response.data.detail.dasar);
        let subkegiatan = `${response.data.kegiatan.sub_kegiatan_kode1}.${response.data.kegiatan.sub_kegiatan_kode2}.${response.data.kegiatan.sub_kegiatan_kode3}.${response.data.kegiatan.sub_kegiatan_kode4}.${response.data.kegiatan.sub_kegiatan_kode5}`
        document.querySelector('#pencairan-nama').innerText = response.data.pencairan_nama
        document.querySelector('#tanggal-dokumen').innerText = response.data.detail.tanggal_dokumen_indonesia
        document.querySelector('#ppk-nama').innerText = response.data.detail.ppk.nama_pejabat
        document.querySelector('#ppk-nip').innerText = response.data.detail.ppk.pegawai.pegawai_nomor_induk
        document.querySelector('#total-seluruhnya').innerText = formatRupiah(response.data.total)
        document.querySelector('#terbilang').innerText = response.data.terbilang

        // console.log(response.data.detail.dasar.isSK);

        let contentDasar = "";
        const isSK = response.data.detail.dasar.isSK;
        const isKuitansi = response.data.detail.dasar.isKuitansi;
        const nomorSK = response.data.detail.nomor_sk;
        const tanggalSK = response.data.detail.tanggal_sk_indonesia;
        const nomorKuitansi = response.data.detail.kuitansi_nomor;
        const tanggalIndonesia = response.data.detail.tanggal_dokumen_indonesia;

        // Jika SK dicentang
        if (isSK) {
            contentDasar += `SK No. ${nomorSK} tanggal ${tanggalSK}`;
        }

        // Jika Kuitansi dicentang
        if (isKuitansi) {
            // Kalau sudah ada isi sebelumnya (ada SK), tambahkan " dan "
            if (contentDasar !== "") {
                contentDasar += " dan ";
            }

            contentDasar += `Kuitansi No. ${nomorKuitansi} tanggal ${tanggalIndonesia}`;
        }

        document.querySelector('#dasar').innerText = contentDasar;


    }

    function formatRupiah(angka) {
        let reverse = angka.toString().split('').reverse().join('');
        let ribuan = reverse.match(/\d{1,3}/g);
        let formatted = ribuan.join('.').split('').reverse().join('');
        return `${formatted}`;
    }
</script>

</html>