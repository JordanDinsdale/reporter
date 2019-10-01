$(document).ready(function() {

    $('select#countries').on('change', function() {

        let country_id = this.value;
        let company_id = $('select#companies').val();

        let dropdown = $('select#dealerships');

        dropdown.empty();

        dropdown.append('<option selected="true" value="">Select Dealership</option>');
        dropdown.prop('selectedIndex', 0);

        const url = '/api/companies/' + company_id + '/countries/' + country_id + '/dealerships';

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