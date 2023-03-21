/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import './jquery';

import * as Popper from '@popperjs/core';
window.Popper = Popper;

import * as bootstrap from 'bootstrap';

import DataTable from 'datatables.net';
import 'datatables.net-responsive-bs5';
window.DataTable = DataTable;

import 'jquery-mask-plugin';

import Swal from 'sweetalert2/dist/sweetalert2'
window.Swal = Swal;
