$(document).ready(function() {

    $('select#levels').on('change', function() {

        let level = this.value;

        switch(level) {
            case 'Company':
                $('#companyContainer').removeClass('d-none');
                $('#companyContainer select').prop('required',true);
                $('#manufacturerContainer').addClass('d-none');
                $('#manufacturerContainer select').prop('required',false);
                $('#countryContainer').addClass('d-none');
                $('#countryContainer select').prop('required',false);
                $('#regionContainer').addClass('d-none');
                $('#regionContainer select').prop('required',false);
                $('#groupContainer').addClass('d-none');
                $('#groupContainer select').prop('required',false);
                $('#dealershipContainer').addClass('d-none');
                $('#dealershipContainer select').prop('required',false);
            break;
            case 'Manufacturer':
                $('#companyContainer').removeClass('d-none');
                $('#companyContainer select').prop('required',false);
                $('#manufacturerContainer').removeClass('d-none');
                $('#manufacturerContainer select').prop('required',true);
                $('#countryContainer').addClass('d-none');
                $('#countryContainer select').prop('required',false);
                $('#regionContainer').addClass('d-none');
                $('#regionContainer select').prop('required',false);
                $('#groupContainer').addClass('d-none');
                $('#groupContainer select').prop('required',false);
                $('#dealershipContainer').addClass('d-none');
                $('#dealershipContainer select').prop('required',false);
            break;
            case 'Country':
                $('#companyContainer').removeClass('d-none');
                $('#companyContainer select').prop('required',false);
                $('#manufacturerContainer').removeClass('d-none');
                $('#manufacturerContainer select').prop('required',true);
                $('#countryContainer').removeClass('d-none');
                $('#countryContainer select').prop('required',true);
                $('#regionContainer').addClass('d-none');
                $('#regionContainer select').prop('required',false);
                $('#groupContainer').addClass('d-none');
                $('#groupContainer select').prop('required',false);
                $('#dealershipContainer').addClass('d-none');
                $('#dealershipContainer select').prop('required',false);
            break;
            case 'Region':
                $('#companyContainer').removeClass('d-none');
                $('#companyContainer select').prop('required',false);
                $('#manufacturerContainer').removeClass('d-none');
                $('#manufacturerContainer select').prop('required',true);
                $('#countryContainer').removeClass('d-none');
                $('#countryContainer select').prop('required',true);
                $('#regionContainer').removeClass('d-none');
                $('#regionContainer select').prop('required',true);
                $('#groupContainer').addClass('d-none');
                $('#groupContainer select').prop('required',false);
                $('#dealershipContainer').addClass('d-none');
                $('#dealershipContainer select').prop('required',false);
            break;
            case 'Group':
                $('#companyContainer').addClass('d-none');
                $('#companyContainer select').prop('required',false);
                $('#manufacturerContainer').addClass('d-none');
                $('#manufacturerContainer select').prop('required',false);
                $('#countryContainer').removeClass('d-none');
                $('#countryContainer select').prop('required',false);
                $('#regionContainer').addClass('d-none');
                $('#regionContainer select').prop('required',false);
                $('#groupContainer').removeClass('d-none');
                $('#groupContainer select').prop('required',true);
                $('#dealershipContainer').addClass('d-none');
                $('#dealershipContainer select').prop('required',false);
            break;
            case 'Dealership':
                $('#companyContainer').addClass('d-none');
                $('#companyContainer select').prop('required',false);
                $('#manufacturerContainer').addClass('d-none');
                $('#manufacturerContainer select').prop('required',false);
                $('#countryContainer').removeClass('d-none');
                $('#countryContainer select').prop('required',false);
                $('#regionContainer').addClass('d-none');
                $('#regionContainer select').prop('required',false);
                $('#groupContainer').removeClass('d-none');
                $('#groupContainer select').prop('required',false);
                $('#dealershipContainer').removeClass('d-none');
                $('#dealershipContainer select').prop('required',true);
            break;
            default:
        }           

    });

    $('select#levels').trigger('change');

});