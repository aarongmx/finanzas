Alpine.data('form', () => ({
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
    validNumber(value) {
        let floatValue = parseFloat(value)
        console.log(floatValue)
        return !isNaN(floatValue) ? parseFloat(floatValue.toFixed(2)) : 0
    },
    actualizarPrecios(e){

    },
    calcularTotales(e, index) {
        console.log(this.$wire.items)
        /*let precio = parseFloat(e.target.value).toFixed(2);
        let cantidadExistencia = parseFloat(this.$wire.items[index].cantidad_existencia).toFixed(2);
        let cantidadEntrada = parseFloat(this.$wire.items[index].cantidad_entrada).toFixed(2);
        let cantidadSalida = parseFloat(this.$wire.items[index].cantidad_salida).toFixed(2);
        let cantidadSobrante = parseFloat(this.$wire.items[index].cantidad_sobrante).toFixed(2);

        this.$wire.items[index].importe_existencia = parseFloat(precio * cantidadExistencia).toFixed(2);
        this.$wire.items[index].importe_entrada = parseFloat(precio * cantidadEntrada).toFixed(2);
        this.$wire.items[index].importe_salida = parseFloat(precio * cantidadSalida).toFixed(2);
        this.$wire.items[index].importe_sobrante = parseFloat(precio * cantidadSobrante).toFixed(2);

        let total = this.$wire.items.reduce((total, item) => total + parseFloat(item.importe_existencia), 0).toFixed(2);
        this.$wire.sumExistencia = isNaN(total) ? this.$wire.importeExistencia : total + this.$wire.importeExistencia;

        this.$wire.entradasArray.map(i => {
            let precioProducto = this.validNumber(this.$wire.items.find(item => item.producto_id === i.producto_id).precio);

            let total = precioProducto * this.validNumber(i.cantidad) + this.validNumber(this.$wire.totalEntrada);

            this.$wire.sumEntradasRecibidas = total;
            this.$wire.sumEntrada = total;
        });*/
    }
}))
