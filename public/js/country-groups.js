$(document).ready(function() {

    $('select#countries').on('change', function() {

        let country_id = this.value;

        let dropdown = $('select#groups');

        dropdown.empty();

        dropdown.append('<option selected="true" disabled>Group</option>');
        dropdown.prop('selectedIndex', 0);

        const url = '/api/countries/' + country_id + '/groups';

        // Populate dropdown with list of groups
        $.getJSON(url, function (data) {

            $.each(data, function (key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.id).text(entry.name));
            })

        });

    });

});