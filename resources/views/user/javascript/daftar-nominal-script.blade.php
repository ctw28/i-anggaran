<script>
    function up(button) {
        // return alert('ggwp')
        var row = button.parentNode.parentNode;
        var table = row.parentNode.parentNode;
        console.log(table);
        if (row.rowIndex > 2) {
            table.rows[row.rowIndex - 1].before(row);
            updateNomorBaris(table);
        }
    }

    function down(button) {
        var row = button.parentNode.parentNode;
        var table = row.parentNode.parentNode;
        if (row.rowIndex < table.rows.length - 1) {
            table.rows[row.rowIndex + 1].after(row);
            updateNomorBaris(table);
        }
    }

    function updateNomorBaris(table) {
        for (var i = 1; i < table.rows.length; i++) {
            table.rows[i].cells[1].textContent = i - 1;
            console.log(table.rows[i].cells[1]);
            table.rows[i].dataset.urut = i - 1;
        }
    }
</script>