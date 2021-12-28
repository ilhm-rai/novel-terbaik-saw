/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

if(typeof String.prototype.trim !== 'function') {
  String.prototype.trim = function() {
    return this.replace(/^\s+|\s+$/g, '');
  }
}

$('form#formlogin').on('submit', function(e) {
  e.preventDefault();
  var url = $(this).attr('action');
  var data = $(this).serialize();

  $.ajax({
    url: url,
    data: data,
    dataType: 'JSON',
    type: 'POST',
    beforeSend: function() {
      $('#buttonlogin').html(`
        <div class="spinner-border spinner-border-sm" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      `);
      $('input, #buttonlogin').attr('disable', true);
    },
    success: function(e) {
      if (e.type=='success') {
        location.reload();
      } else {
        $('input').removeClass('is-invalid');
        $('.invalid-feedback').html('');
        if (e.message[0] == 'alert') {
          $(`#${e.message[0]}`).removeClass('d-none');
          $(`#${e.message[0]}`).html(e.message[1]);
        } else {
          $(`#${e.message[0]}`).addClass('is-invalid')
          $(`#${e.message[0]} ~ .invalid-feedback`).html(e.message[1]);
          $('#alert').addClass('d-none');
        }

        $('#buttonlogin').html('Login');
        $('input, #buttonlogin').attr('disable', false);
      }
    }
  }).fail(function (e){
    console.log(e);
  })
})

$('form#form').on('submit', function(e) {
  e.preventDefault();
  var url = $(this).attr('action');
  const data = new FormData( this );

  $.ajax({
    url: url,
    type: 'POST',
    data: data,
    contentType: false,
    cache: false,
    processData: false,
    dataType: 'JSON',
    beforeSend: function() {
      $('#buttonsimpan').html(`
        <div class="spinner-border spinner-border-sm" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      `);
      $('input, #buttonsimpan').attr('disabled', true);
    },
    success: function ( res ) {
      alert(res.message);

      if (res.type == 'update') {
        window.location.href = res.url;
      } else if (res.type == 'success') {
        location.reload();
      }
    },
  }).done(function() {
    $('#buttonsimpan').html('Simpan');
    $('input, #buttonsimpan').attr('disabled', false);
    $('#id').remove();
    if ($('input[name="buku"]')) {
      $('#old_sampul').remove();
    }
    $('#form').attr('action', './proses/tambah.php');
  }).fail(function (e) {
    console.dir(e);
  })
})

$('form#form').on('reset', function(e) {
  e.preventDefault();
  $('input').val = "";
  $('#id').remove();
  $(this).attr('action', './proses/tambah.php');
  $('select').each( function() {
    let id = this.id;
    $(`#${id}`).val($(`#${id} option:first`).val());
  });
  $('input[name="nilai_id[]"]').remove();
})

$(document).on('click', '.btn-edit', function(e) {
  e.preventDefault();
  const id = $(this).data('id');
  const url = $(this).attr('href');

  $.ajax({
    type:'GET',
    url:url,
    data: id,
    dataType:'JSON',
    cache:false,
    beforeSend: function() {
      $(e.currentTarget).html(`
        <div class="spinner-border spinner-border-sm" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      `);
      $("option").attr('selected', false);
    },
    success:function (res) {
      if (res.table != 'nilai_buku') {
        $('#id').remove();
        $('#table').after(`
          <input type="hidden" name="id" id="id" value="${id}">
          `);
      } else {
        $('input[name="nilai_id[]"]').remove();
      }

      switch(res.table) {
        case 'buku':
          $('#id').val(res.data['id']);
          $('#judul').val(res.data['judul']);
          $('#pengarang').val(res.data['pengarang']);
          $('#table').after(`
            <input type="hidden" name="old_sampul" id="old_sampul" value="${res.data['sampul']}">
            `);
          break;
        case 'kriteria':
          $('#id').val(res.data['id']);
          $('#kriteria').val(res.data['nama']);
          break;
        case 'nilai_kriteria':
          $('#id').val(res.data['id']);
          $('#nilai').val(res.data['nilai']);
          $('#keterangan').val(res.data['keterangan']);
          $(`option[value="${res.data['kriteria_id']}"`).attr('selected', true);
          break;
        case 'nilai_buku':
          res.data.forEach(e => {
            $(`#buku_id option[value="${e.buku_id}"]`).attr('selected', true);
            $(`input[name="kriteria_id[]"][value="${e.kriteria_id}"]`).after(`
              <input type="hidden" name="nilai_id[]" value="${e.id}">
            `)
            $(`#KID${e.kriteria_id} option[value="${e.nilai_kriteria_id}"]`).attr('selected', true);
          });
          break;
      }
    }
  }).done(function() {
    $('.btn-edit').html(`<i class="fas fa-pencil-alt"></i>`);
    $('#form').attr('action', './proses/ubah.php');
  }).fail(function(e) {
    console.log(e);
  });
});

$(document).on('click', '.btn-hapus', function(e) {
  e.preventDefault();
  const data = $(this).data('name');
  const url = $(this).attr('href');
  const confirm = window.confirm(`Apakah anda ingin mengahapus data ${data}?`);
  if (confirm) {
    $.ajax({
      type:'GET',
      url:url,
      dataType:'JSON',
      cache:false,
      success:function (res) {
        alert(res.message);

        if (res.type == 'success') {
          location.reload();
        }
      }
    }).fail(function(e) {
      console.log(e);
    });
  }
});