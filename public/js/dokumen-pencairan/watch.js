const pencairanWatch = {

dataNominal: {
    deep: true,
    handler(newVal) {
        newVal.forEach((item, index) => {
            this.calculate(index);
        });
    }
},
dataBelanjaBahan: {
    deep: true,
    handler(newVal) {
        newVal.forEach((item, index) => {
            this.calculateBelanjaBahan(index);
        });
    }
},
async searchQuery(newValue) {
    if (newValue.length > 2) {
        await this.fetchPegawai(newValue);
    } else {
        this.searchResults = [];
    }
},

};