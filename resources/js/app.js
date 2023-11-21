import './bootstrap';
import * as bootstrap from 'bootstrap'
import './../../vendor/power-components/livewire-powergrid/dist/powergrid.js'
import '../../vendor/power-components/livewire-powergrid/dist/bootstrap5.css'
import Swal from "sweetalert2";
import flatpickr from "flatpickr";
import TomSelect from "tom-select";

window.TomSelect = TomSelect
window.bootstrap = bootstrap
window.flatpickr = flatpickr

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
});
