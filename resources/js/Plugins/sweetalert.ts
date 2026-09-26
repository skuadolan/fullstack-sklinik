import Swal from 'sweetalert2';

export function showSwal(options: Record<string, any> = {}) {
  return Swal.fire(options);
}

export function showLoading() {
  if (!Swal.isLoading()) {
    showSwal({
      html: `Loading, Mohon tunggu...`,
      allowOutsideClick: false,
      showCancelButton: false,
      showCloseButton: false,
      allowEscapeKey: false,
      didOpen: function () {
        Swal.showLoading();
      },
    });
  }
}

export function hideLoading() {
  if (Swal.isLoading() && Swal.isVisible()) {
    Swal.hideLoading();
    Swal.close();
  }
}
