$(document).ready(function(){
        $('.lionbars').lionbars();

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

                var etype = $('#entity_type').val();

                var legalName = '';

                if(etype == 'Business'){
                    $('#entity_source').show();
                    $('#loan_proceed').show();
                    legalName = $('#company').val();
                }else{
                    $('#entity_source').hide();
                    $('#loan_proceed').hide();
                    legalName = ui.item.userdata.firstname + ' ' + ui.item.userdata.lastname + ' and or assign';
                }

                $('#legalName').val(legalName);

                var country = ui.item.userdata.countryOfOrigin;

                if(country == 'Australia'){
                    $('.au').show();
                    $('.us').hide();
                    $('.outside').hide();
                }else if(country == 'United States of America'){
                    $('.au').hide();
                    $('.us').show();
                    $('.outside').hide();
                }else{
                    $('.au').hide();
                    $('.us').hide();
                    $('.outside').show();
                }


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

                var etype = $('#entity_type').val();

                var legalName = '';

                if(etype == 'Business'){
                    $('#entity_source').show();
                    $('#loan_proceed').show();
                    legalName = $('#company').val();
                }else{
                    $('#entity_source').hide();
                    $('#loan_proceed').hide();
                    legalName = ui.item.userdata.firstname + ' ' + ui.item.userdata.lastname + ' and or assign';
                }

                $('#legalName').val(legalName);

                var country = ui.item.userdata.countryOfOrigin;

                if(country == 'Australia'){
                    $('.au').show();
                    $('.us').hide();
                    $('.outside').hide();
                }else if(country == 'United States of America'){
                    $('.au').hide();
                    $('.us').show();
                    $('.outside').hide();
                }else{
                    $('.au').hide();
                    $('.us').hide();
                    $('.outside').show();
                }

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

                var etype = $('#entity_type').val();

                var legalName = '';

                if(etype == 'Business'){
                    $('#entity_source').show();
                    $('#loan_proceed').show();
                    legalName = $('#company').val();
                }else{
                    $('#entity_source').hide();
                    $('#loan_proceed').hide();
                    legalName = ui.item.userdata.firstname + ' ' + ui.item.userdata.lastname + ' and or assign';
                }

                $('#legalName').val(legalName);

                var country = ui.item.userdata.countryOfOrigin;

                if(country == 'Australia'){
                    $('.au').show();
                    $('.us').hide();
                    $('.outside').hide();
                }else if(country == 'United States of America'){
                    $('.au').hide();
                    $('.us').show();
                    $('.outside').hide();
                }else{
                    $('.au').hide();
                    $('.us').hide();
                    $('.outside').show();
                }

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

                var etype = $('#entity_type').val();

                var legalName = '';

                if(etype == 'Business'){
                    $('#entity_source').show();
                    $('#loan_proceed').show();
                    legalName = $('#company').val();
                }else{
                    $('#entity_source').hide();
                    $('#loan_proceed').hide();
                    legalName = ui.item.userdata.firstname + ' ' + ui.item.userdata.lastname + ' and or assign';
                }

                $('#legalName').val(legalName);

                var country = ui.item.userdata.countryOfOrigin;

                if(country == 'Australia'){
                    $('.au').show();
                    $('.us').hide();
                    $('.outside').hide();
                }else if(country == 'United States of America'){
                    $('.au').hide();
                    $('.us').show();
                    $('.outside').hide();
                }else{
                    $('.au').hide();
                    $('.us').hide();
                    $('.outside').show();
                }

            }
        });

});