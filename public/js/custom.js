/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

// hapus hari libur konfirmasi
$('.hapus-libur').click(function(event) {

    var form =  $(this).closest("form");

    var name = $(this).data("name");

    event.preventDefault();

    swal({

        title: `Apakah Anda yakin ingin menghapus Hari Libur ini?`,

        text: "Data yang sudah dihapus tidak dapat dikembalikan.",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

      if (willDelete) {

        form.submit();

      }

    });

});

// hapus unit konfirmasi
$('.hapus-unit').click(function(event) {

    var form =  $(this).closest("form");

    var name = $(this).data("name");

    event.preventDefault();

    swal({

        title: `Apakah Anda yakin ingin menghapus Unit ini?`,

        text: "Data yang sudah dihapus tidak dapat dikembalikan.",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

      if (willDelete) {

        form.submit();

      }

    });

});

// hapus subunit konfirmasi
$('.hapus-subunit').click(function(event) {

    var form =  $(this).closest("form");

    var name = $(this).data("name");

    event.preventDefault();

    swal({

        title: `Apakah Anda yakin ingin menghapus Subunit ini?`,

        text: "Data yang sudah dihapus tidak dapat dikembalikan.",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

      if (willDelete) {

        form.submit();

      }

    });

});

// hapus agama konfirmasi
$('.hapus-agama').click(function(event) {

    var form =  $(this).closest("form");

    var name = $(this).data("name");

    event.preventDefault();

    swal({

        title: `Apakah Anda yakin ingin menghapus Agama ini?`,

        text: "Data yang sudah dihapus tidak dapat dikembalikan.",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

      if (willDelete) {

        form.submit();

      }

    });

});

// hapus status konfirmasi
$('.hapus-status').click(function(event) {

    var form =  $(this).closest("form");

    var name = $(this).data("name");

    event.preventDefault();

    swal({

        title: `Apakah Anda yakin ingin menghapus Status Pernikahan ini?`,

        text: "Data yang sudah dihapus tidak dapat dikembalikan.",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

      if (willDelete) {

        form.submit();

      }

    });

});

// hapus karywawn konfirmasi
$('.hapus-karyawan').click(function(event) {

    var form =  $(this).closest("form");

    var name = $(this).data("name");

    event.preventDefault();

    swal({

        title: `Apakah Anda yakin ingin menghapus Karyawan ini?`,

        text: "Data yang sudah dihapus tidak dapat dikembalikan.",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

      if (willDelete) {

        form.submit();

      }

    });

});

// hapus kepalasubbidang konfirmasi
$('.hapus-kepalasubbidang').click(function(event) {

    var form =  $(this).closest("form");

    var name = $(this).data("name");

    event.preventDefault();

    swal({

        title: `Apakah Anda yakin ingin menghapus Kepala Sub Bidang ini?`,

        text: "Data yang sudah dihapus tidak dapat dikembalikan.",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

      if (willDelete) {

        form.submit();

      }

    });

});

// hapus kepalabidang konfirmasi
$('.hapus-kepalabidang').click(function(event) {

    var form =  $(this).closest("form");

    var name = $(this).data("name");

    event.preventDefault();

    swal({

        title: `Apakah Anda yakin ingin menghapus Kepala Bidang ini?`,

        text: "Data yang sudah dihapus tidak dapat dikembalikan.",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

      if (willDelete) {

        form.submit();

      }

    });

});

// hapus sekretarisbadan konfirmasi
$('.hapus-sekretarisbadan').click(function(event) {

    var form =  $(this).closest("form");

    var name = $(this).data("name");

    event.preventDefault();

    swal({

        title: `Apakah Anda yakin ingin menghapus Sekretaris Badan ini?`,

        text: "Data yang sudah dihapus tidak dapat dikembalikan.",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

      if (willDelete) {

        form.submit();

      }

    });

});

// hapus admin konfirmasi
$('.hapus-admin').click(function(event) {

    var form =  $(this).closest("form");

    var name = $(this).data("name");

    event.preventDefault();

    swal({

        title: `Apakah Anda yakin ingin menghapus Admin ini?`,

        text: "Data yang sudah dihapus tidak dapat dikembalikan.",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

      if (willDelete) {

        form.submit();

      }

    });

});

// hapus cuti konfirmasi
$('.hapus-cuti').click(function(event) {

    var form =  $(this).closest("form");

    var name = $(this).data("name");

    event.preventDefault();

    swal({

        title: `Apakah Anda yakin ingin menghapus Cuti Karyawan ini?`,

        text: "Data yang sudah dihapus tidak dapat dikembalikan.",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

      if (willDelete) {

        form.submit();

      }

    });

});

// hapus broadcast konfirmasi
$('.hapus-broadcast').click(function(event) {

    var form =  $(this).closest("form");

    var name = $(this).data("name");

    event.preventDefault();

    swal({

        title: `Apakah Anda yakin ingin menghapus Pesan Broadcast ini?`,

        text: "Data yang sudah dihapus tidak dapat dikembalikan.",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

      if (willDelete) {

        form.submit();

      }

    });

});

// hapus laporan konfirmasi
$('.hapus-laporan').click(function(event) {

    var form =  $(this).closest("form");

    var name = $(this).data("name");

    event.preventDefault();

   new swal({

        title: `Apakah Anda yakin ingin menghapus Laporan Kegiatan ini?`,

        text: "Data yang sudah dihapus tidak dapat dikembalikan.",

        icon: "warning",

        buttons: true,

        dangerMode: true,

    })

    .then((willDelete) => {

      if (willDelete) {

        form.submit();

      }

    });

});
