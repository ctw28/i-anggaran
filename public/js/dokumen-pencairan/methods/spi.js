const SPIMethods = {

    async sendSPI() {
        
        let dataSend = new FormData()
        dataSend.append('pencairan_id', this.pencairan_id)
        dataSend.append('is_finish', 0)
        let url = this.urls.urlKirimSPI
        let sendRequest = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            method: "POST",
            body: dataSend
        })
        response = await sendRequest.json()
        if (response.status) {
            toastr.options.closeButton = true;
            toastr.options.positionClass = 'toast-top-center mt-3';
            toastr.success('Sukses');
            isKirimSpi = true
            // Tutup modal setelah sukses
            let modalElement = document.getElementById('backDropModal');
            let modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
            }
        }
    },
};