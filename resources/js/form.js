Alpine.data('form', (totalExistencia, data, efectivo, totalSalida, totalEntrada, sumSalida, sumEntrada, entradas) => ({
    totalExistencia,
    totalEntrada,
    totalSalida,
    totalSobrante: 0,
    totalGastos: 0,
    total: 0,
    sumSobrante: 0,
    sumSalida,
    sumEntrada,
    data,
    efectivo,
    entradas,
    marinados: [],

    searchOnTable(e, tableId) {
        const searchTable = document.getElementById(tableId);
        const rows = searchTable.querySelectorAll('tbody tr');

        rows.forEach((row) => {
            const cells = Array.from(row.querySelectorAll('td'));
            const matchString = cells.map((n) => n.textContent.toLowerCase()).join(' ');
            const match = matchString.includes(e.target.value);
            row.classList.toggle('d-none', !match);
        });
    },
    copiarExistenciaMarinados() {
        let data = this.data.filter(i => i.categoria_id === 2);
        this.marinados = data
        console.log(data)
    },
    calcularTotal(precioUnitario, cantidad) {
        return ((parseFloat(precioUnitario) || 0) * (parseFloat(cantidad) || 0)).toFixed(2)
    },
    sumaTotalExistencia() {
        this.totalExistencia = this.data.map(item => parseFloat(item.importe_existencia) || 0).reduce((acc, total) => acc + (parseFloat(total) || 0), 0)
    },
    sumaTotalEntrada() {
        this.totalEntrada = this.data.map(item => parseFloat(item.importe_entrada) || 0).reduce((acc, total) => acc + (parseFloat(total) || 0), 0)
    },
    sumaTotalSalida(){
        let total = this.data.map(item => parseFloat(item.importe_salida) || 0).reduce((acc, total) => acc + (parseFloat(total) || 0), 0)
        this.sumSalida = this.totalSalida + total
    },
    setTotalEntrada(item, cantidad) {
        item.importe_entrada = this.calcularTotal(item.precio, cantidad)
        this.sumaTotalEntrada()
    },
    setTotalSalida(item, cantidad) {
        item.importe_salida = this.calcularTotal(item.precio, cantidad)
        this.sumaTotalSalida()
    },
    setTotalExistencia(item, precio){
        item.importe_existencia = this.calcularTotal(precio, item.cantidad_existencia)
        this.sumaTotalExistencia()
    }
}))
