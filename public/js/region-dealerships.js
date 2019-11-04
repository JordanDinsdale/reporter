$(document).ready(function() {

    $('select#levels, select#regions').on('change', function() {

        let region_id = $('select#regions').val();

        let dropdown = $('select#dealerships');

        dropdown.empty();

        dropdown.append('<option selected="true" value="">Select Dealership</option>');
        dropdown.prop('selectedIndex', 0);

        const url = '/api/regions/' + region_id + '/dealerships';

        // Populate dropdown with list of groups
        $.getJSON(url, function (data) {

            if(Object.keys(data).length > 0) {

                $.each(data, function (key, entry) {
                    dropdown.append($('<option></option>').attr('value', entry.id).text(entry.name));
                })

            }

            else {

                dropdown.append($('<option disabled="true"></option>').attr('value', '').text('No dealerships currently available'));

            }

        });

    });

});