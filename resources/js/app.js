import "./bootstrap";
import Swal from 'sweetalert2';
import Alpine from 'alpinejs';
import Toaster from '../../vendor/masmerise/livewire-toaster/resources/js';

Alpine.plugin(Toaster); // 👈

window.Alpine = Alpine;
Alpine.start();