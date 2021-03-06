$(document).ready(function() {

    $('select#countries').on('change', function() {

        let country_id = this.value;

        let dropdown = $('select#groups');

        dropdown.empty();

        dropdown.append('<option selected="true" value="">Select Group</option>');
        dropdown.prop('selectedIndex', 0);

        const url = '/api/countries/' + country_id + '/groups';

        // Populate dropdown with list of groups
        $.getJSON(url, function (data) {

            if(data.length > 0) {

                $.each(data, function (key, entry) {
                    dropdown.append($('<option></option>').attr('value', entry.id).text(entry.name));
                })

            }

            else {

                dropdown.append($('<option disabled="true"></option>').attr('value', '').text('No groups currently available'));

            }

        });

    });

});