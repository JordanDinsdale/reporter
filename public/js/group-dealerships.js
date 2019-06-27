$(document).ready(function() {

    $('select#groups').on('change', function() {

        let group_id = this.value;

        let dropdown = $('select#dealerships');

        dropdown.empty();

        dropdown.append('<option selected="true" disabled>Dealership</option>');
        dropdown.prop('selectedIndex', 0);

        const url = '/api/groups/' + group_id + '/dealerships';

        // Populate dropdown with list of groups
        $.getJSON(url, function (data) {

            $.each(data, function (key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.id).text(entry.name));
            })

        });

    });

});