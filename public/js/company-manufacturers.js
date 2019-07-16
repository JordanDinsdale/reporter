$(document).ready(function() {

    $('select#companies').on('change', function() {

        let company_id = this.value;

        let dropdown = $('select#manufacturers');

        dropdown.empty();

        dropdown.append('<option selected="true" value="">Select Manufacturer</option>');
        dropdown.prop('selectedIndex', 0);

        const url = '/api/companies/' + company_id + '/manufacturers';

        // Populate dropdown with list of provinces
        $.getJSON(url, function (data) {

            $.each(data, function (key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.id).text(entry.name));
            })
        });

    });

});