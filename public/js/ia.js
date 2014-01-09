$(document).ready(function(){
        $( '.autoid' ).autocomplete({
            source: base + 'ajax/buyerid',
            select: function(event, ui){
                $('#buyerId').val(ui.item.id);
                $('#salutation').val(ui.item.userdata.salutation);
                $('#firstname').val(ui.item.userdata.firstname);
                $('#lastname').val(ui.item.userdata.lastname);
                $('#company').val(ui.item.userdata.company);
                $('#phone').val(ui.item.userdata.phone);
                $('#email').val(ui.item.userdata.email);

                $('#phone').val(ui.item.userdata.phone);
                $('#address').val(ui.item.userdata.address);
                $('#city').val(ui.item.userdata.city);
                $('#country').val(ui.item.userdata.countryOfOrigin);
                $('#other_state').val(ui.item.userdata.state);
                $('#au_state').val(ui.item.userdata.state);
                $('#us_state').val(ui.item.userdata.state);
                $('#zip').val(ui.item.userdata.zipCode);

            }
        });

        $( '.autofirstname' ).autocomplete({
            source: base + 'ajax/buyerfirstname',
            select: function(event, ui){
                $('#buyerId').val(ui.item.id);
                $('#customerId').val(ui.item.userdata.customerId);
                $('#salutation').val(ui.item.userdata.salutation);
                $('#lastname').val(ui.item.userdata.lastname);
                $('#company').val(ui.item.userdata.company);
                $('#phone').val(ui.item.userdata.phone);
                $('#email').val(ui.item.userdata.email);

                $('#phone').val(ui.item.userdata.phone);
                $('#address').val(ui.item.userdata.address);
                $('#city').val(ui.item.userdata.city);
                $('#country').val(ui.item.userdata.countryOfOrigin);
                $('#other_state').val(ui.item.userdata.state);
                $('#au_state').val(ui.item.userdata.state);
                $('#us_state').val(ui.item.userdata.state);
                $('#zip').val(ui.item.userdata.zipCode);

            }
        });

        $( '.autolastname' ).autocomplete({
            source: base + 'ajax/buyerlastname',
            select: function(event, ui){
                $('#buyerId').val(ui.item.id);
                $('#customerId').val(ui.item.userdata.customerId);
                $('#salutation').val(ui.item.userdata.salutation);
                $('#firstname').val(ui.item.userdata.firstname);
                $('#company').val(ui.item.userdata.company);
                $('#phone').val(ui.item.userdata.phone);
                $('#email').val(ui.item.userdata.email);

                $('#phone').val(ui.item.userdata.phone);
                $('#address').val(ui.item.userdata.address);
                $('#city').val(ui.item.userdata.city);
                $('#country').val(ui.item.userdata.countryOfOrigin);
                $('#other_state').val(ui.item.userdata.state);
                $('#au_state').val(ui.item.userdata.state);
                $('#us_state').val(ui.item.userdata.state);
                $('#zip').val(ui.item.userdata.zipCode);

            }
        });

        $( '.autoemail' ).autocomplete({
            source: base + 'ajax/buyeremail',
            select: function(event, ui){
                $('#buyerId').val(ui.item.id);
                $('#customerId').val(ui.item.userdata.customerId);
                $('#salutation').val(ui.item.userdata.salutation);
                $('#firstname').val(ui.item.userdata.firstname);
                $('#lastname').val(ui.item.userdata.lastname);
                $('#company').val(ui.item.userdata.company);
                $('#phone').val(ui.item.userdata.phone);

                $('#phone').val(ui.item.userdata.phone);
                $('#address').val(ui.item.userdata.address);
                $('#city').val(ui.item.userdata.city);
                $('#country').val(ui.item.userdata.countryOfOrigin);
                $('#other_state').val(ui.item.userdata.state);
                $('#au_state').val(ui.item.userdata.state);
                $('#us_state').val(ui.item.userdata.state);
                $('#zip').val(ui.item.userdata.zipCode);

            }
        });

});