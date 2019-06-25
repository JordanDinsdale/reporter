$(document).ready(function() {

    $('select#manufacturers').on('change', function() {

        let manufacturer_id = this.value;

        let dropdown = $('select#regions');

        dropdown.empty();

        dropdown.append('<option selected="true" disabled>Select Region</option>');
        dropdown.prop('selectedIndex', 0);

        const url = '/api/manufacturers/' + manufacturer_id + '/regions';

        // Populate dropdown with list of provinces
        $.getJSON(url, function (data) {

            if(data.length > 0) {
                $('#regionContainer').removeClass('d-none');
            }

            else {
                $('#regionContainer').addClass('d-none');
            }

            $.each(data, function (key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.id).text(entry.name));
            })
        });

    });

});