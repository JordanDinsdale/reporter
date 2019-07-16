$(document).ready(function() {

    $('select#groups').on('change', function() {

        let group_id = this.value;

        let dropdown = $('select#dealerships');

        dropdown.empty();

        dropdown.append('<option selected="true" value="">Select Dealership</option>');
        dropdown.prop('selectedIndex', 0);

        const url = '/api/groups/' + group_id + '/dealerships';

        // Populate dropdown with list of groups
        $.getJSON(url, function (data) {

            if(data.length > 0) {

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