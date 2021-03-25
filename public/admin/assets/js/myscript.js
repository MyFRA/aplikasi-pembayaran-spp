function deleteRow(message, url) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Akan menghapus data " + message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin!',
        cancelButtonText: 'Batal',
      }).then((result) => {
        if (result.isConfirmed) {
          const formDelete = document.getElementById('form-delete');
          formDelete.setAttribute('action', `${url}`);
          formDelete.submit();
        }
      })
}

function convertRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split  = number_string.split(","),
    sisa   = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);
 
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }
 
  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
}
 
function isNumberKey(evt) {
    key = evt.which || evt.keyCode;
  if (  key != 188 // Comma
     && key != 8 // Backspace
     && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
     && (key < 48 || key > 57) // Non digit
    ) 
  {
    evt.preventDefault();
    return;
  }
}

function logoutAction()
{
  event.preventDefault();

  Swal.fire({
    title: 'Apakah anda yakin?',
    text: "Akan Keluar Aplikasi?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yakin!',
    cancelButtonText: 'Batal',
  }).then((result) => {
    if (result.isConfirmed) {
      const formLogout = document.getElementById('admin-form-logout');
      formLogout.submit();
    }
  })
}