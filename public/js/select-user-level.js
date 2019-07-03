$(document).ready(function() {

    $('select#levels').on('change', function() {

        let level = this.value;

        switch(level) {
            case 'Manufacturer':
                $('#manufacturerContainer').removeClass('d-none');
                $('#countryContainer').addClass('d-none');
                $('#regionContainer').addClass('d-none');
                $('#groupContainer').addClass('d-none');
                $('#dealershipContainer').addClass('d-none');
            break;
            case 'National':
                $('#manufacturerContainer').removeClass('d-none');
                $('#countryContainer').removeClass('d-none');
                $('#regionContainer').addClass('d-none');
                $('#groupContainer').addClass('d-none');
                $('#dealershipContainer').addClass('d-none');
            break;
            case 'Regional':
                $('#manufacturerContainer').removeClass('d-none');
                $('#countryContainer').removeClass('d-none');
                $('#regionContainer').removeClass('d-none');
                $('#groupContainer').addClass('d-none');
                $('#dealershipContainer').addClass('d-none');
            break;
            case 'Group':
                $('#manufacturerContainer').addClass('d-none');
                $('#countryContainer').removeClass('d-none');
                $('#regionContainer').addClass('d-none');
                $('#groupContainer').removeClass('d-none');
                $('#dealershipContainer').addClass('d-none');
            break;
            case 'Dealership':
                $('#manufacturerContainer').addClass('d-none');
                $('#countryContainer').removeClass('d-none');
                $('#regionContainer').addClass('d-none');
                $('#groupContainer').removeClass('d-none');
                $('#dealershipContainer').removeClass('d-none');
            break;
            case 'Sales Executive':
                $('#manufacturerContainer').addClass('d-none');
                $('#countryContainer').removeClass('d-none');
                $('#regionContainer').addClass('d-none');
                $('#groupContainer').removeClass('d-none');
                $('#dealershipContainer').removeClass('d-none');
            break;
            default:
        }           

    });

});