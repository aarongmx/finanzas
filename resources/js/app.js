import './bootstrap';
import * as bootstrap from 'bootstrap'
import './../../vendor/power-components/livewire-powergrid/dist/powergrid.js'
import '../../vendor/power-components/livewire-powergrid/dist/bootstrap5.css'
import Swal from "sweetalert2";
import flatpickr from "flatpickr";
import TomSelect from "tom-select";
import bootstrapTable from "bootstrap-table/dist/bootstrap-table.js"

window.TomSelect = TomSelect
window.bootstrap = bootstrap
window.flatpickr = flatpickr
window.bootstrapTable = bootstrapTable

document.addEventListener('livewire:initialized', () => {
    Livewire.on('openModal', (event) => {
        const {modal} = event
        bootstrap.Modal.getOrCreateInstance(`#${modal}`).show()
    });

    Livewire.on('closeModal', (event) => {
        const {modal} = event
        bootstrap.Modal.getInstance(`#${modal}`).hide()
    });

    Livewire.on('notify', (event) => {
        const {title, text, icon = 'success'} = event
        Swal.fire(title, text, icon)
    });

    Livewire.on('askConfirm', (event) => {
        const {dispatch, id, title, text, icon = 'warning'} = event
        const config = {
            title,
            text,
            icon,
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, eliminar',
            reverseButtons: true
        }

        Swal.fire(config)
            .then((result) => {
                if (result.isConfirmed){
                    Livewire.dispatch(dispatch, {id: id})
                }
            })
    });
});
