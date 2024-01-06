Alpine.data('form', (totalExistencia, data, efectivo) => ({
    totalExistencia,
    totalEntrada: 0,
    totalSalida:0,
    totalSobrante:0,
    totalGastos: 0,
    total: 0,
    data,
    efectivo,

    init() {

    },
    searchOnTable(e, tableId) {
        const searchTable = document.getElementById(tableId);
        const rows = searchTable.querySelectorAll('tbody tr');

        rows.forEach((row) => {
            const cells = Array.from(row.querySelectorAll('td'));
            const matchString = cells.map((n) => n.textContent.toLowerCase()).join(' ');
            const match = matchString.includes(e.target.value);
            row.classList.toggle('d-none', !match);
        });
    }
}))
