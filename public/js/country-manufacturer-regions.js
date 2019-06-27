$(document).ready(function() {

    $('select#manufacturers').on('change', function() {

        let country_id = $('select#countries').val();
        let manufacturer_id = this.value;

        let dropdown = $('select#regions');

        dropdown.empty();

        dropdown.append('<option selected="true" disabled>Region</option>');
        dropdown.prop('selectedIndex', 0);

        const url = '/api/countries/' + country_id + '/manufacturers/' + manufacturer_id + '/regions';

        // Populate dropdown with list of groups
        $.getJSON(url, function (data) {

            $.each(data, function (key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.id).text(entry.name));
            })

        });

    });

});