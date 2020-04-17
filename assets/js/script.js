jQuery(document).ready(function($) {

  if ($('#add-more').length) {
    var remove_buttons;
    $('#add-more').on('click', function(event) {
      event.preventDefault();
      var entries = $('.website-url-entry');
      var add_to = $('.website-url-entry-wrap').last();
      var entry_length = entries.length - 1;
      var i, add_entry;
      for (i = 0; i < entries.length; i++) {
        if (i == entry_length) {
          let new_id = i + 1;
          add_entry = '<div class="form-row website-url-entry-wrap mt-3"><div class="col-sm-5"><input type="url" name="website-url[]" class="form-control website-url-entry " id="website-url-' +
              new_id + '" data-entry="id-' + new_id +
              '" placeholder="Enter website url"></div><div class="col-sm-5"><input type="text" name="website-name[]" class="form-control website-name-entry" id="website-name-0" placeholder="Enter website name"></div><div class="col-sm-2"><button type="button" class="btn btn-danger remove-me" data-remove="id-' +
              new_id + '">Remove</button></div></div>';
        }
      }
      add_entry = $(add_entry);
      add_to.after(add_entry);

      remove_buttons = $('.remove-me');

      if (remove_buttons.length) {
        remove_buttons.each(function() {
          $(this).on('click', function(event) {
            event.preventDefault();
            $(this).parent().parent().remove();
          });
        });
      }
    });

    $('#submit').on('click', function(event) {
      event.preventDefault();
      var count_data = 0;
      $('.website-url-entry').each(function() {
        count_data++;
      });

      if (count_data > 0) {
        console.log('I am doing the ajax submit');
        var form_data = $('#submit-website-addition').serialize();
        console.log(form_data);
        $.ajax({
          url: 'addingWebsiteEntries.php',
          method: 'POST',
          data: form_data,
          success: function(data) {
            $('#form-adding-websites').remove();
            console.log(data);
            $('#submit-website-addition').
                html('<p>Data inserted successfully</p>');
            $('#submit-website-addition').html('<p>' + data + '</p>');
            location.reload();
          },
          error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
          },
        });
      }
      else {
        console.log('not doing it');
      }

    });

  }

  if ($('.close-website-entry').length) {
    $('.close-website-entry').on('click', function() {
      var entryID = {
          entryWebsiteId: $(this).data('close'),

      };
      $.ajax({
        url: 'removeWebsiteEntry.php',
        method: 'POST',
        data: entryID,
        success: function(data) {
          $('#'+entryID.entryWebsiteId).remove();
        },
        error: function(xhr, status, error) {
          console.log(xhr);
          console.log(status);
          console.log(error);
        },
      })
    });
  }

  if ($('#sidebarToggle').length){
    $('#sidebarToggle').on('click', function() {
      $('#page-top').toggleClass('sidebar-toggled');
      $('#accordionSidebar').toggleClass('toggled');
    })
  }

});