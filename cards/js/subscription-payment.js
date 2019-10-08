'use strict';

$(function() {
    let firstName = $('#fname');
    let middleName = '';
    let lastName = $('#lname');
    let birthday = '2019-10-03';
    let sex = 'M';
    let email = $('#email');
    let password = $('#password');
    let contactNo = $('#contact_num');
    let line1 = 'billing address line 1';
    let line2 = 'billing address line 2';
    let city = 'billing address city';
    let state = 'billing address state';
    let countryCode = $('#country');
    let zipCode = $('#postal');

    let cardNo = $('#cardNumber');
    let cvvNo = $('#cvv');
    let expMonth = $('#month');
    let expYear = $('#year');

    let subsOption1 = $('#exampleRadios1');
    let subsOption2 = $('#exampleRadios2');
    let subsOption3 = $('#exampleRadios3');

    let buttonSubscribe = $('#subscribe');

    buttonSubscribe.on('click', function(e) {
        let selectedSubscriptionPlan = $('input[name="exampleRadios"]:checked').val();

        /* Create payment token */
        $.ajax({
            async: true,
            type: 'POST',
            // dataType: 'JSONP',
            cache: false,
            url: '/_subs/subscription-payment.php?q=subscribe',
            data: {
                /* Card details */
                cardNo: $.trim(cardNo.val()),
                expMonth: $.trim(expMonth.val()),
                expYear: $.trim(expYear.val()),
                cvvNo: $.trim(cvvNo.val()),
                /* Customer details */
                firstName: $.trim(firstName.val()),
                middleName: $.trim(middleName),
                lastName: $.trim(lastName.val()),
                birthday: $.trim(birthday),
                sex: $.trim(sex),                
                email: $.trim(email.val()),
                contactNo: $.trim(contactNo.val()),
                line1: $.trim(line1),
                line2: $.trim(line2),
                city: $.trim(city),
                state: $.trim(state),
                zipCode: $.trim(zipCode.val()),
                countryCode: $.trim(countryCode.val()),
                /* Subscription Option */
                subscriptionPlan: $.trim(selectedSubscriptionPlan)
            },
            beforeSend: function() {
                // Loader here.
                console.log('(beforeSend) : Subscribing...');
            }
        }).done(function(response, textStatus, xhr) {
            // Place error handler here.
            console.log('DONE');
            console.log('(response): ' + response);
            console.log('(textStatus): ' + textStatus);
            console.log('(xhr): ' + xhr);

            window.location.href = response;
        }).fail(function(xhr, textStatus, errorThrown) {
            console.log('FAIL');
            console.log('(xhr): ' + xhr);
            console.log('(textStatus): ' + textStatus);
            console.log('(errorThrown): ' + errorThrown);
        }).always(function() {
            console.log('ALWAYS');
            // Close loader here.
        });
    });
});