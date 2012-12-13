$(document).ready(function() {
	
        $.ajaxSetup({
            cache: "false"
        });

        $.ajax({
            url: '/accounts/includes/social-verification.php',
            data: 'action=check_username&username=' + encodeURIComponent(username) + '&api=' + encodeURIComponent(api) + '&bid=' + encodeURIComponent(business_id) + '&bname=' + encodeURIComponent(business_name),
            cache: false,
            dataType: 'json',
            type: 'post',
            success: function (data) {
                login = data;
                // TODO BT Change to switch statement
                if (api == 'facebook') {
                    if (login.name) {
                        // This uses Facebook Query Language to check to see if the handle is a Facebook User or a Page
                        // TODO BT Make calling of window dynamic/a function
                        $.ajax({
                            //url: 'https://graph.facebook.com/fql',
                            url: '/accounts/includes/social-verification.php',
                            //data: 'q=SELECT name, page_id, username FROM page WHERE username = ' + encodeURIComponent(usernameWithQuotes),
                            data: 'action=check_user_or_obj&username=' + encodeURIComponent(username) + '&api=' + encodeURIComponent(api) + '&bid=' + encodeURIComponent(business_id) + '&bname=' + encodeURIComponent(business_name),
                            cache: false,
                            dataType: 'json',
                            type: 'get',
                            success: function (datum) {
                                console.log(datum);
                                if (datum.data[0] !== undefined && datum.data[0].name !== undefined) {
                                    $.nmManual('/accounts/includes/verification-popup.php?api=' + encodeURIComponent(api) + '&username=' + encodeURIComponent(username) + '&fid=' + encodeURIComponent(login.id) + '&name=' + encodeURIComponent(login.name), {
                                        sizes: {
                                                minW:350,
                                                minH:310,
                                                w:350,
                                                h:310
                                                },
                                        showCloseButton: false,
                                        closeOnClick: false
                                    });
                                } else {
                                    alert("You have not entered a valid Facebook Page (Most likely you have entered a personal Facebook page). Please enter a valid Facebook Page");
                                    $('#facebook-handle').val('').focus();
                                    $('#submit-customer-edit').removeAttr('disabled');
                                    return;
                                }
                            }
                        });
                    } else {
                    // @BT: We have an invalid username. Do not allow submission of the page.
                    // Also, make sure to check the disable box
                        alert('You have entered an invalid facebook username/id. Please enter a valid facebook username/id.');
                        $('#facebook-handle').val('').focus();
                        $('#submit-customer-edit').removeAttr('disabled');
                        return;
                    }
                } else if (api == 'twitter') {
                    if (login.name) {
                        $.nmManual('/accounts/includes/verification-popup.php?api=' + encodeURIComponent(api) + '&username=' + encodeURIComponent(username) + '&fid=' + encodeURIComponent(login.id) + '&name=' + encodeURIComponent(login.name), {
                            sizes: {
                                    minW:350,
                                    minH:310,
                                    w:350,
                                    h:310
                                    },
                                    showCloseButton: false,
                                    closeOnClick: false
                        });
                    } else {
                        alert('You have entered an invalid twitter username. Please enter a valid twitter username.');
                        $('#twitter-handle').val('').focus();
                        $('#submit-customer-edit').removeAttr('disabled');
                        return;
                    }
                } else if (api == 'yelp') {
                    yelp = login.yelp;
                    if (yelp) {
                        var imageUrl = '';
                        if (yelp.image_url) {
                            imageUrl = yelp.image_url;
                        }
                        $.nmManual('/accounts/includes/verification-popup.php?api=' + encodeURIComponent(api) + '&image_url=' + encodeURIComponent(imageUrl)
                                    + '&username=' + encodeURIComponent(yelp.url) + '&name=' + encodeURIComponent(yelp.name), {
                                        sizes: {
                                                initW:350,
                                                initH:310,
                                                w:350,
                                                h:310
                                                },
                                                showCloseButton: false,
                                                closeOnClick: false
                                        });
                    } else {
                        alert('You have entered an invalid Yelp URL');
                        $('#yelp-url').val('').focus();
                        $('#submit-customer-edit').removeAttr('disabled');
                        return;
                    }
                } else if (api == "linkedin") {
                    linkedin = login.linkedin;
                    if (linkedin.linkedinname) {
                        $.nmManual('/accounts/includes/verification-popup.php?api=' + encodeURIComponent(api) + '&username=' + encodeURIComponent(username) + '&name=' + encodeURIComponent(linkedin.linkedinname) +
                                    '&desc=' + encodeURIComponent(linkedin.linkedindescription) + '&empCount=' + encodeURIComponent(linkedin.linkedinemployeecount) + '&authURL=' + encodeURIComponent(linkedin.authURL) +
                                    '&linkedinid=' + encodeURIComponent(linkedin.linkedinid), {
                                     sizes: {
                                             minW:350,
                                             minH:310,
                                             w:350,
                                             h:310
                                             },
                                             showCloseButton: false,
                                             closeOnClick: false
                                     });
                    } else {
                        alert("You have entered an invalid LinkedIn domain. Please enter either your company's website registered with linkedin, your business's email registered with linked in, or your linkedin domain.");
                        $('#linkedin-handle').val('').focus();
                        $('#submit-customer-edit').removeAttr('disabled');
                        return;
                    }
                }
            },
           error: function(xhr, ajaxOptions, thrownError) {
                alert("You have provided an invalid entry for " + api + " . Please enter either your company's website registered with Linkedin, or your business's email registered with LinkedIn.");
                $('#linkedin-handle').val('').focus();
                $('#submit-customer-edit').removeAttr('disabled');
                return;
            }
        });
        $(this).attr('current', username);
        $(this).val(username);
});