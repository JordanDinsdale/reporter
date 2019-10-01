$(document).ready(function() {

    let company_id = $('select#companies').val();

    let dropdown = $('select#countries');

    dropdown.empty();

    dropdown.append('<option selected="true" value="">Select Country</option>');
    dropdown.prop('selectedIndex', 0);

    const url = '/api/companies/' + company_id + '/countries/';

    // Populate dropdown with list of groups
    $.getJSON(url, function (data) {

        if(data.length > 0) {

            $.each(data, function (key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.id).text(entry.name));
            })

        }

        else {

            dropdown.append($('<option disabled="true"></option>').attr('value', '').text('No countries currently available'));

        }

    });

});