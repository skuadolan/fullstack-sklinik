const base_url = window.location.host;
const [host, port] = base_url.split(':');
const $base_url = (port ? `http://${host}:${port}` : `https://${host}`);

$(document).ready(function () {
    $.getScript(`${$base_url}/assets/scripts/js/helper.js`, async function () {
        DisableRightClickOnMouse();
    });
});

function DisableRightClickOnMouse() {
    function disabledSelection(e) {
        return false;
    }

    function reEnable() {
        return true;
    }

    document.onselectstart = new Function("return false");

    if (window.sidebar) {
        document.onmousedown = disabledSelection;
        document.onclick = reEnable;
    }
}

function ConvertToIDR($val) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 2 }).format($val);
}
