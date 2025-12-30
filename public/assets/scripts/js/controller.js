const base_url = window.location.host;
const [host, port] = base_url.split(':');
const $base_url = (port ? `http://${host}:${port}` : `https://${host}`);

$(document).ready(function () {
    $.getScript(`${$base_url}/assets/scripts/js/functions.js`, async function () {
        DisableRightClickOnMouse();
    });
});

function ConvertToIDR($val) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 2 }).format($val);
}

function SwalModal(optional) { return Swal.fire(optional); }

function toastrCustomize(option, title, message) {
    switch (option) {
        case "success":
            toastr.success(message, title);
            break;

        case "error":
            toastr.error(message, title);
            break;

        case "warning":
            toastr.warning(message, title);
            break;

        case "info":
            toastr.info(message, title);
            break;
    
        default:
            toastr.error(message, title);
            break;
    }
}

function AllNotify(section, optional) {
    switch (section) {
        case "success":
            optional.title = "Berhasil!";
            optional.icon = "success";
            break;

        case "error":
            optional.title = "Kesalahan!";
            optional.icon = "error";
            break;

        case "warning":
            optional.title = "Peringatan!";
            optional.icon = "warning";
            break;

        case "info":
            optional.title = "Sekilas Informasi";
            optional.icon = "info";
            break;

        default:
            optional.title = "Tidak Ditemukan!";
            optional.icon = "error";
            break;
    }

    toastrCustomize(section, optional.title, optional.text);
    SwalModal(optional);
}
