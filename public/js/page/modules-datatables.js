"use strict";

$("[data-checkboxes]").each(function() {
  var me = $(this),
    group = me.data('checkboxes'),
    role = me.data('checkbox-role');

  me.change(function() {
    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
      checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
      dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
      total = all.length,
      checked_length = checked.length;

    if(role == 'dad') {
      if(me.is(':checked')) {
        all.prop('checked', true);
      }else{
        all.prop('checked', false);
      }
    }else{
      if(checked_length >= total) {
        dad.prop('checked', true);
      }else{
        dad.prop('checked', false);
      }
    }
  });
});


$(document).ready(function() {
  let table = $('#table-1').DataTable({
    "columnDefs": [
      { "orderable": false, "targets": 0 }
    ], 
    "order": [],
  });

  table.on( 'order.dt search.dt', function () {
    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
  } ).draw();
});

$(document).ready(function() {
  let table = $('#table-2').DataTable({
    "columnDefs": [
      { "orderable": false, "targets": 0 }
    ], 
    "order": [],
  });

  table.on( 'order.dt search.dt', function () {
    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
  } ).draw();
});

$(document).ready(function() {
  let table = $('#table-3').DataTable({
    "columnDefs": [
      { "orderable": false, "targets": 0 }
    ], 
    "order": [],
  });

  table.on( 'order.dt search.dt', function () {
    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
  } ).draw();
});

$(document).ready(function() {
  let table = $('#table-4').DataTable({
    "columnDefs": [
      { "orderable": false, "targets": 0 }
    ], 
    "order": [],
  });

  table.on( 'order.dt search.dt', function () {
    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
  } ).draw();
});

$(document).ready(function() {
  let table = $('#table-5').DataTable({
    "columnDefs": [
      { "orderable": false, "targets": 0 }
    ], 
    "order": [],
  });

  table.on( 'order.dt search.dt', function () {
    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
  } ).draw();
});

$(document).ready(function() {
  let table = $('#table-6').DataTable({
    "columnDefs": [
      { "orderable": false, "targets": 0 }
    ], 
    "order": [],
  });

  table.on( 'order.dt search.dt', function () {
    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
  } ).draw();
});

$(document).ready(function() {
  let table = $('#table-7').DataTable({
    "columnDefs": [
      { "orderable": false, "targets": 0 }
    ], 
    "order": [],
  });

  table.on( 'order.dt search.dt', function () {
    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
  } ).draw();
});
