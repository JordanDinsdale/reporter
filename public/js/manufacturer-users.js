$(document).ready(function() {

    $('select#manufacturers').on('change', function() {

        let manufacturer_id = this.value;

        let dropdown = $('select#users');

        dropdown.empty();

        dropdown.append('<option selected="true" disabled>Select Sales Executive</option>');
        dropdown.prop('selectedIndex', 0);

        const url = '/api/manufacturers/' + manufacturer_id + '/users';

        // Populate dropdown with list of provinces
        $.getJSON(url, function (data) {
            $.each(data, function (key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.id).text(entry.firstname + ' ' + entry.surname));
            })
        });

    });

});