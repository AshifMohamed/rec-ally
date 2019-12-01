$(function () {
    //BEGIN MENU SIDEBAR
    $('#sidebar').css('min-height', '100%');
    $('#side-menu').metisMenu();

    setTimeout(function(){
    if(!$('#global_notification').hasClass('hidden'))
      $('#global_notification').fadeOut(500);
    },3000);

    $(window).bind("load resize", function () {
        if ($(this).width() < 768) {
            $('div.sidebar-collapse').addClass('collapse');
        } else {
            $('div.sidebar-collapse').removeClass('collapse');
            $('div.sidebar-collapse').css('height', 'auto');
        }
        if($('body').hasClass('sidebar-icons')){
            $('#menu-toggle').hide();
        } else{
            $('#menu-toggle').show();
        }
    });
    //END MENU SIDEBAR

    //BEGIN TOPBAR DROPDOWN
    $('.dropdown-slimscroll').slimScroll({
        "height": '250px',
        "wheelStep": 5
    });
    //END TOPBAR DROPDOWN

    //BEGIN CHECKBOX & RADIO
    // if($('#demo-checkbox-radio').length <= 0){
        // $('input[type="checkbox"]:not(".switch")').iCheck({
            // checkboxClass: 'icheckbox_minimal-grey',
            // increaseArea: '20%' // optional
        // });
        // $('input[type="radio"]:not(".switch")').iCheck({
            // radioClass: 'iradio_minimal-grey',
            // increaseArea: '20%' // optional
        // });
    // }
    //END CHECKBOX & RADIO

    //BEGIN TOOTLIP
    $("[data-toggle='tooltip'], [data-hover='tooltip']").tooltip();
    //END TOOLTIP

    //BEGIN POPOVER
    $("[data-toggle='popover'], [data-hover='popover']").popover();
    //END POPOVER

    //BEGIN THEME SETTING
    $('#theme-setting > a.btn-theme-setting').click(function(){
        if($('#theme-setting').css('right') < '0'){
            $('#theme-setting').css('right', '0');
        } else {
            $('#theme-setting').css('right', '-250px');
        }
    });

    // Begin Change Theme Color
    var list_style = $('#theme-setting > .content-theme-setting > select#list-style');
    var list_color = $('#theme-setting > .content-theme-setting > ul#list-color > li');
    // FUNCTION CHANGE URL STYLE ON HEAD TAG
    var setTheme = function (style, color) {
        $.cookie('style',style);
        $.cookie('color',color);
        $('#theme-change').attr('href', 'css/themes/'+ style + '/' + color + '.css');
    }
    // INITIALIZE THEME FROM COOKIE
    // HAVE TO SET VALUE FOR STYLE&COLOR BEFORE AND AFTER ACTIVE THEME
    if ($.cookie('style')) {
        list_style.find('option').each(function(){
            if($(this).attr('value') == $.cookie('style')) {
                $(this).attr('selected', 'selected');
            }
        });
        list_color.removeClass("active");
        list_color.each(function(){
            if($(this).attr('data-color') == $.cookie('color')){
                $(this).addClass('active');
            }
        });
        setTheme($.cookie('style'), $.cookie('color'));
    };
    // SELECT EVENT
    list_style.on('change', function() {
        list_color.each(function() {
            if($(this).hasClass('active')){
                color_active  = $(this).attr('data-color');
            }
        });
        setTheme($(this).val(), color_active);
    });
    // LI CLICK EVENT
    list_color.on('click', function() {
        list_color.removeClass('active');
        $(this).addClass('active');
        setTheme(list_style.val(), $(this).attr('data-color'));
    });
    // End Change Theme Color
    //END THEME SETTING

    //BEGIN FULL SCREEN
    $('.btn-fullscreen').click(function() {

        if (!document.fullscreenElement &&    // alternative standard method
            !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) {
                document.documentElement.msRequestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        }
    });
    //END FULL SCREEN

    // BEGIN FORM CHAT
    $('.btn-chat').click(function () {
        if($('#chat-box').is(':visible')){
            $('#chat-form').toggle('slide', {
                direction: 'right'
            }, 500);
            $('#chat-box').hide();
        } else{
            $('#chat-form').toggle('slide', {
                direction: 'right'
            }, 500);
        }
    });
    $('.chat-box-close').click(function(){
        $('#chat-box').hide();
        $('#chat-form .chat-group a').removeClass('active');
    });
    $('.chat-form-close').click(function(){
        $('#chat-form').toggle('slide', {
            direction: 'right'
        }, 500);
        $('#chat-box').hide();
    });

    $('#chat-form .chat-group a').unbind('*').click(function(){
        $('#chat-box').hide();
        $('#chat-form .chat-group a').removeClass('active');
        $(this).addClass('active');
        var strUserName = $('> small', this).text();
        $('.display-name', '#chat-box').html(strUserName);
        var userStatus = $(this).find('span.user-status').attr('class');
        $('#chat-box > .chat-box-header > span.user-status').removeClass().addClass(userStatus);
        var chatBoxStatus = $('span.user-status', '#chat-box');
        var chatBoxStatusShow = $('#chat-box > .chat-box-header > small');
        if(chatBoxStatus.hasClass('is-online')){
            chatBoxStatusShow.html('Online');
        } else if(chatBoxStatus.hasClass('is-offline')){
            chatBoxStatusShow.html('Offline');
        } else if(chatBoxStatus.hasClass('is-busy')){
            chatBoxStatusShow.html('Busy');
        } else if(chatBoxStatus.hasClass('is-idle')){
            chatBoxStatusShow.html('Idle');
        }


        var offset = $(this).offset();
        var h_main = $('#chat-form').height();
        var h_title = $("#chat-box > .chat-box-header").height();
        var top = ($('#chat-box').is(':visible') ? (offset.top - h_title - 40) : (offset.top + h_title - 20));

        if((top + $('#chat-box').height()) > h_main){
            top = h_main -  $('#chat-box').height();
        }

        $('#chat-box').css({'top': top});

        if(!$('#chat-box').is(':visible')){
            $('#chat-box').toggle('slide',{
                direction: 'right'
            }, 500);
        }
        // FOCUS INPUT TExT WHEN CLICK
        $('ul.chat-box-body').scrollTop(500);
        $("#chat-box .chat-textarea input").focus();
    });
    // Add content to form
    $('.chat-textarea input').on("keypress", function(e){

        var $obj = $(this);
        var $me = $obj.parent().parent().find('ul.chat-box-body');
        var $my_avt = 'https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg';
        var $your_avt = 'https://s3.amazonaws.com/uifaces/faces/twitter/alagoon/48.jpg';
        if (e.which == 13) {
            var $content = $obj.val();

            if ($content !== "") {
                var d = new Date();
                var h = d.getHours();
                var m = d.getMinutes();
                if (m < 10) m = "0" + m;
                $obj.val(""); // CLEAR TEXT ON TEXTAREA

                var $element = ""; 
                $element += "<li>";
                $element += "<p>";
                $element += "<img class='avt' src='"+$my_avt+"'>";
                $element += "<span class='user'>John Doe</span>";
                $element += "<span class='time'>" + h + ":" + m + "</span>";
                $element += "</p>";
                $element = $element + "<p>" + $content +  "</p>";
                $element += "</li>";
                
                $me.append($element);
                var height = 0;
                $me.find('li').each(function(i, value){
                    height += parseInt($(this).height());
                });

                height += '';
                //alert(height);
                $me.scrollTop(height);  // add more 400px for #chat-box position      

                // RANDOM RESPOND CHAT

                var $res = "";
                $res += "<li class='odd'>";
                $res += "<p>";
                $res += "<img class='avt' src='"+$your_avt+"'>";
                $res += "<span class='user'>Swlabs</span>";
                $res += "<span class='time'>" + h + ":" + m + "</span>";
                $res += "</p>";
                $res = $res + "<p>" + "Yep! It's so funny :)" + "</p>";
                $res += "</li>";
                setTimeout(function(){
                    $me.append($res);
                    $me.scrollTop(height+100); // add more 500px for #chat-box position             
                }, 1000);
            }
        }
    });
    // END FORM CHAT

    //BEGIN PORTLET
    $(".portlet").each(function(index, element) {
        var me = $(this);
        $(">.portlet-header>.tools>i", me).click(function(e){
            if($(this).hasClass('fa-chevron-up')){
                $(">.portlet-body", me).slideUp('fast');
                $(this).removeClass('fa-chevron-up').addClass('fa-chevron-down');
            }
            else if($(this).hasClass('fa-chevron-down')){
                $(">.portlet-body", me).slideDown('fast');
                $(this).removeClass('fa-chevron-down').addClass('fa-chevron-up');
            }
            else if($(this).hasClass('fa-cog')){
                //Show modal
            }
            else if($(this).hasClass('fa-refresh')){
                //$(">.portlet-body", me).hide();
                $(">.portlet-body", me).addClass('wait');

                setTimeout(function(){
                    //$(">.portlet-body>div", me).show();
                    $(">.portlet-body", me).removeClass('wait');
                }, 1000);
            }
            else if($(this).hasClass('fa-times')){
                me.remove();
            }
        });
    });
    //END PORTLET

    //BEGIN BACK TO TOP
    $(window).scroll(function(){
        if ($(this).scrollTop() < 200) {
            $('#totop') .fadeOut();
        } else {
            $('#totop') .fadeIn();
        }
    });
    $('#totop').on('click', function(){
        $('html, body').animate({scrollTop:0}, 'fast');
        return false;
    });
    //END BACK TO TOP

    //BEGIN CHECKBOX TABLE
    $('.checkall').on('ifChecked ifUnchecked', function(event) {
        if (event.type == 'ifChecked') {
            $(this).closest('table').find('input[type=checkbox]').iCheck('check');
        } else {
            $(this).closest('table').find('input[type=checkbox]').iCheck('uncheck');
        }
    });
    //END CHECKBOX TABLE

    //BEGIN JQUERY NEWS UPDATE
    $('#news-update').ticker({
        controls: false,
        titleText: ''
    });
    //END JQUERY NEWS UPDATE

    $('.option-demo').hover(function() {
        $(this).append("<div class='demo-layout animated fadeInUp'><i class='fa fa-magic mrs'></i>Demo</div>");
    }, function() {
        $('.demo-layout').remove();
    });
    $('#header-topbar-page .demo-layout').live('click', function() {
        var HtmlOption = $(this).parent().detach();
        $('#header-topbar-option-demo').html(HtmlOption).addClass('animated flash').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $(this).removeClass('animated flash');
        });
        $('#header-topbar-option-demo').find('.demo-layout').remove();
        return false;
    });
    $('#title-breadcrumb-page .demo-layout').live('click', function() {
        var HtmlOption = $(this).parent().html();
        $('#title-breadcrumb-option-demo').html(HtmlOption).addClass('animated flash').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $(this).removeClass('animated flash');
        });
        $('#title-breadcrumb-option-demo').find('.demo-layout').remove();
        return false;
    });
    // CALL FUNCTION RESPONSIVE TABS
    fakewaffle.responsiveTabs(['xs', 'sm']);
    var company_profile_id = $('#company_profile_id').val();
    var candidate_profile_id = $('#candidate_profile_id').val();

    $('.save-company-info').click(function(){
        var thisForm = $(this).parents('form:first');
        var action = thisForm.attr('action');
        //console.log($('#representative_info').serialize());
        $.ajax({
            type:'POST',
            url:action,
            data:thisForm.serialize()+'&company_profile_id='+company_profile_id,
            success:function(result){
                thisForm[0].reset();
                location.reload();
            },
            error:function(err){

            }, 
        });
        return false;
    });
 
    $('.save-candidate-info').click(function(){
        var thisForm = $(this).parents('form:first');
        var action = thisForm.attr('action');
        //console.log($('#representative_info').serialize());
        console.log("Action :",action);
        console.log(thisForm);
        console.log("data :",thisForm.serialize());
        $.ajax({
            type:'POST', 
            url:action,
            data:thisForm.serialize()+'&candidate_profile_id='+candidate_profile_id,
            success:function(result){
              // thisForm[0].reset();
              location.reload();
            },
            error:function(err){

            }, 
        });
        return false;
    });

     $('.edit-basic-company-info').click(function(){
        var section_content = $(this).parents('.row:first').find('.section-content');
        var form = $('#save_basic_company_info');
        //console.log(section_content.html());
        var country_code='',mobile ='';
        var number = section_content.find('#cn_mobile').text().trim().split('-');
        if(number.length)
        {
            country_code = number[0];
            mobile = number[1];
        }
 
        form.find('#name').val(section_content.find('#cn_company_name').text().trim());
        form.find('#website').val(section_content.find('#cn_website').text().trim());
        form.find('#mobile').val(mobile);
        form.find('#country_code').val(country_code);
        form.find('#email').val(section_content.find('#cn_email').text().trim());
        form.find('#gender').val(section_content.find('#cn_gender').text().trim());
        form.find('#date_of_birth').val(section_content.find('#cn_date_of_birth').text().trim());
        form.find('#building_no').val(section_content.find('#cn_building_no').text().trim());
        form.find('#building_name').val(section_content.find('#cn_building_name').text().trim());
        form.find('#street').val(section_content.find('#cn_street').text().trim());
        form.find('#city option:contains("'+section_content.find('#cn_city').text().trim()+'")').attr('selected','selected');
        form.find('#country option:contains("'+section_content.find('#cn_country').text().trim()+'")').attr('selected','selected');
    });

     $('.edit-representative-info').click(function(){
        var section_content = $(this).parents('.row:first').find('.section-content');
        var form = $('#representative_info');
        //console.log(section_content.html());
        form.find('#name').val(section_content.find('#cn_name').text().trim());
        form.find('#email').val(section_content.find('#cn_email').text().trim());
        form.find('#mobile').val(section_content.find('#cn_mobile').text().trim());
        form.find('#position').val(section_content.find('#cn_position').text().trim());
        form.find('#skype').val(section_content.find('#cn_skype').text().trim());
    });

     $('.edit-company-registration-info').click(function(){
        var section_content = $(this).parents('.row:first').find('.section-content');
        var form = $('#company_registration_info');
        //console.log(section_content.html());
        form.find('#owner').val(section_content.find('#cn_owner').text().trim());
        form.find('#license_no').val(section_content.find('#cn_license_no').text().trim());
        form.find('#employee_range option:contains("'+section_content.find('#cn_employee_range').text().trim()+'")').attr('selected','selected');
        form.find('#company_type option:contains("'+section_content.find('#cn_type').text().trim()+'")').attr('selected','selected');
        //form.find('#industry option:contains("'+section_content.find('#industry').text().trim()+'")').attr('selected','selected');
    });

     $('.edit-about-company-info').click(function(){
        var section_content = $(this).parents('.row:first').find('.section-content');
        var form = $('#about_you_form');
        //console.log(section_content.html());
        form.find('#about_company').text(section_content.find('.cn_about_company').text().trim());
    });

    $('.edit-basic-profile-info').click(function(){
        var section_content = $(this).parents('.row:first').find('.section-content');
        var form = $('#basic_profile_info_form');
        //console.log(section_content.html());
        form.find('#first_name').val(section_content.find('#cn_first_name').text().trim());
        form.find('#last_name').val(section_content.find('#cn_last_name').text().trim());
        form.find('#gender').val(section_content.find('#cn_gender').text().trim());
        form.find('#passport_number').val(section_content.find('#cn_passport_number').text().trim());
        form.find('#date_of_birth').val(section_content.find('#cn_date_of_birth').text().trim());
        form.find('#building_no').val(section_content.find('#cn_building_no').text().trim());
        form.find('#building_name').val(section_content.find('#cn_building_name').text().trim());
        form.find('#street').val(section_content.find('#cn_street').text().trim());
        form.find('#city option:contains("'+section_content.find('#cn_city').text().trim()+'")').attr('selected','selected');
        form.find('#country option:contains("'+section_content.find('#cn_country').text().trim()+'")').attr('selected','selected');
        form.find('#nationality option:contains("'+section_content.find('#cn_nationality').text().trim()+'")').attr('selected','selected');
        form.find('#maritial_status option:contains("'+section_content.find('#cn_maritial_status').text().trim()+'")').attr('selected','selected');
        form.find('#gender option:contains("'+section_content.find('#cn_gender').text().trim()+'")').attr('selected','selected');
        form.find('#visa_expiration_date').val(section_content.find('#cn_visa_expiration_date').text().trim());
        // form.find('#number_of_dependants').val(section_content.find('#cn_number_of_dependants').text().trim());
        form.find('#number_of_dependants option:contains("'+section_content.find('#cn_number_of_dependants').text().trim()+'")').first().attr('selected','selected');
        form.find('#visa_status option:contains("'+section_content.find('#cn_visa_status').text().trim()+'")').attr('selected','selected');
    });

    $('.edit-contact-info').click(function(){
        var section_content = $(this).parents('.row:first').find('.section-content');
        var form = $('#profile_contact_info_form');
        //console.log(section_content.html());
        form.find('#email').val(section_content.find('.cn_email').text().trim());
        form.find('#secondary_email').val(section_content.find('.cn_secondary_email').text().trim());

        let mobile = section_content.find('.cn_mobile').text().trim();
        let mobile_arr = mobile.split("-");
        if(mobile_arr.length == 3)
        {
            form.find('#country_code').val(mobile_arr[0]);
            form.find('#network_code').val(mobile_arr[1]);
            form.find('#mobile').val(mobile_arr[2]);
        }
        else
        {
            form.find('#mobile').val(mobile);
        }
        form.find('#skype').val(section_content.find('.cn_skype_id').text().trim());
        form.find('#linkedin').val(section_content.find('.cn_linkedin').text().trim());
        form.find('#website').val(section_content.find('.cn_website').text().trim());
        form.find('#preferred_contact_method option:contains("'+section_content.find('.cn_preffered_contact_method').text().trim()+'")').attr('selected','selected');
    });

    $('.edit-salary-notice-period-info').click(function(){
        var section_content = $(this).parents('.row:first').find('.section-content');
        var form = $('#salary_notice_period_form');
        console.log(section_content.find('.cn-notice-period').text().trim());
        form.find('#current_salary option:contains("'+section_content.find('.cn-current-salary').text().trim()+'")').attr('selected','selected');
        form.find('#expected_salary option:contains("'+section_content.find('.cn-expected-salary').text().trim()+'")').attr('selected','selected');
        form.find('#notice_period option:contains("'+section_content.find('.cn-notice-period').text().trim()+'")').attr('selected','selected');
    });

    $('.edit-about-you-info').click(function(){
        var section_content = $(this).parents('.row:first').find('.section-content');
        var form = $('#about_you_form');
        console.log(section_content.find('.cn-about-you').text().trim());
        form.find('#about_you').text(section_content.find('.cn-about-you').text().trim());
    });

    $('.edit-education').click(function(){
        var section_content = $(this).parents('.seperator:first').find('.section-content');
        var form = $('#education_form');
        //console.log(section_content.find('.cn_degree_type').text().trim());
        form.find('#degree_type option:contains("'+section_content.find('.cn_degree_type').text().trim()+'")').attr('selected','selected');
        form.find('#education_faculty option:contains("'+section_content.find('.cn_education_faculty').text().trim()+'")').attr('selected','selected');
        form.find('#country option:contains("'+section_content.find('.cn_country').text().trim()+'")').attr('selected','selected');
        form.find('#university').val(section_content.find('.cn_university').text().trim());
        form.find('#completion_date').val(section_content.find('.cn_completion_date').text().trim());
        form.find('#grade').val(section_content.find('.cn_grade').text().trim());
        form.find('#degree_id').val(section_content.find('.cn_degree_id').val());
    });

    $('.edit-job-target').click(function(){
        var section_content = $(this).parents('.row:first').find('.section-content');
        var form = $('#job_target_form');
        //console.log(section_content.find('.cn-career-level').text().trim());
        form.find('#career_level option:contains("'+section_content.find('.cn-career-level').text().trim()+'")').attr('selected','selected');
    });

    $('.edit-experience').click(function(){
        var section_content = $(this).parents('.seperator:first').find('.section-content');
        var form = $('#experience_form');
        console.log(section_content.find('.cn-position').text().trim());
        form.find('#position').val(section_content.find('.cn-position').text().trim());
        form.find('#company_name').val(section_content.find('.cn-company-name').text().trim());
        form.find('#company_website').val(section_content.find('.cn-company-website').text().trim());
        form.find('#industry option:contains("'+section_content.find('.cn-industry').text().trim()+'")').attr('selected','selected');
        form.find('#job_description').val(section_content.find('.cn-job-description').text().trim());
        form.find('#start_date').val(section_content.find('.cn-start-date').text().trim());
        if(section_content.find('.cn-end-date').text().trim() == 'Present')
        {
            $('#is_current_working_here').attr('checked','checked');
            SetCurrentlyWorking($('#is_current_working_here'));
        }
        else
            form.find('#end_date').val(section_content.find('.cn-end-date').text().trim());
        form.find('#reference_name').val(section_content.find('.cn-reference-name').text().trim());
        form.find('#reference_position').val(section_content.find('.cn-reference-position').text().trim());
        form.find('#reference_mobile').val(section_content.find('.cn-reference-mobile').text().trim());
        form.find('#country option:contains("'+section_content.find('.cn-country').text().trim()+'")').attr('selected','selected');
        form.find('#experience_level option:contains("'+section_content.find('.cn-experience-level').text().trim()+'")').attr('selected','selected');
        form.find('#experience_id').val(section_content.find('.cn-experience-id').val());
        form.find('#experience_reference_id').val(section_content.find('.cn-experience-reference-id').val());
    });

    $('.edit-certification').click(function(){
        var section_content = $(this).parents('.seperator:first').find('.section-content');
        var form = $('#certification_form');
        console.log(section_content.html());
        form.find('#certificate_id').val(section_content.find('.cn-certificate-id').val());
        form.find('#name').val(section_content.find('.cn-name').text().trim());
        form.find('#number').val(section_content.find('.cn-number').text().trim());
        form.find('#certification_completion_date').val(section_content.find('.cn-completion-date').text().trim());
        form.find('#expiration_date').val(section_content.find('.cn-expiration-date').text().trim());
    });

    $('.edit-language').click(function(){
        var section_content = $(this).parents('.seperator:first').find('.section-content');
        var form = $('#language_form');
        //console.log(section_content.html());
        form.find('#language_expertise_id').val(section_content.find('.cn-language-expertise-id').text().trim());
        form.find('#expertise').val(section_content.find('.cn-expertise').text().trim());
        form.find('#language option:contains("'+section_content.find('.cn-language').text().trim()+'")').attr('selected','selected');
    });

    $('.edit-membership').click(function(){
        var section_content = $(this).parents('.seperator:first').find('.section-content');
        var form = $('#membership_form');
        console.log(section_content.find('.cn-membership-id').text().trim());
        form.find('#membership_id').val(section_content.find('.cn-membership-id').val());
        form.find('#membership').val(section_content.find('.cn-membership').text().trim());
        form.find('#organization').val(section_content.find('.cn-organization').text().trim());
        form.find('#member_since').val(section_content.find('.cn-member-since').text().trim());
        form.find('#membership_description').val(section_content.find('.cn-membership-description').text().trim());
    });

    $('.edit-training').click(function(){
        var section_content = $(this).parents('.seperator:first').find('.section-content');
        var form = $('#training_form');
        //console.log(section_content.html());
        form.find('#training_id').val(section_content.find('.cn-training-id').text().trim());
        form.find('#course_name').val(section_content.find('.cn-course-name').text().trim());
        form.find('#center_name').val(section_content.find('.cn-center-name').text().trim());
        form.find('#training_completion_date').val(section_content.find('.cn-training-completion-date').text().trim());
    });

     $(".edit-btn").click(function(){
         $(".panel-body").find(".bottom-slider").hide();
         $(this).parents(".panel-body").find(".bottom-slider").show();
         $('html,body').animate({
          scrollTop: $(this).parents(".panel-body").find(".bottom-slider").offset().top
        }, 1000);

     }); 

     $(".cancel-btn").click(function(){
         $(".panel-body").find(".bottom-slider").hide();
         $('html,body').animate({
          scrollTop: $(this).parents(".panel-body").offset().top
        }, 1000);
     }); 
    
    $('.test1').click(function(){
        alert('');
        console.log($(this).parents('form:first').html());
        //$(this).parents('form:first').submit();
        return false;
    });

    $('.btn-save-job-profile').click(function(){

        var send_str = '';
        var thisForm = $(this).parents('form:first');
        var action = thisForm.attr('action');
        $('.selectivity-input').not('.competencies_needed').each(function(){
           var id_field = $(this).attr('id') + '=';
           //alert($(this).find('.selectivity-multiple-selected-item').length);
           $(this).find('.selectivity-multiple-selected-item').each(function(){
                id_field += $(this).attr('data-item-id')+',';    
           });
          send_str += '&' + id_field;
          send_str = send_str.replace(/,\s*$/, "");
          //send_str = send_str.replace(/^&/, '');
        });
        var id_field = '&competency=';
        var competency_data = '';
        $('.competencies_needed').each(function(){
           //alert($(this).find('.selectivity-multiple-selected-item').length);
           $(this).find('.selectivity-multiple-selected-item').each(function(){
                competency_data += $(this).attr('data-item-id')+',';    
           });
          
          //send_str = send_str.replace(/^&/, '');
        });
        send_str += id_field + competency_data;
        send_str = send_str.replace(/,\s*$/, "");
        //console.log(send_str);
        //return false;
        // alert('');
        //console.log(JSON.stringify($('#industry').selectivity('data')));
        //return false;
        tinyMCE.triggerSave();
        $.ajax({
            url: action,
            type: 'POST',
            data:$('#job_profile_form').serialize()+send_str,
            success: function(result) {
                console.log("success");
                // location.reload(); 
                location.href = base_url+'employer/job_profile';
            },
            error:function(err) {
                console.log("error");
            }
         });
        return false;
    });

    $('.edit-question').click(function(){
        var section_content = $(this).parents('.seperator:first').find('.section-content');
        var form = $(this).parents(".panel-body:first").find('.question_profile_form:first');
        form[0].reset();
        form.find('#question').text(section_content.find('.cn-question').text().trim());
        form.find('#job_profile_question_id').val(section_content.find('#cn_job_profile_question_id').val());
    }); 
    $('.delete-question').click(function(){
        var result = confirm('Do you want to delete the question?');
        if(result)
            return true;
        return false;  
    });

    $('.add-question').click(function(){
        var form = $('#question_profile_form');
        form.find('#question').text('');
        form.find('#job_profile_question_id').val(0);
    });

    $('.delete_cv_item').click(function(){
        if(confirm('Are you sure you want delete?'))
        {
            return true;
        }
        else
        {
            //e.PreventDefault();
            return false;
        }
    });

    /*$('#btn_save_representative').click(function(){
        
        var thisForm = $(this).parents('form:first');
        //console.log($('#representative_info').serialize());
        $.ajax({
            type:'POST',
            url:'/portal/employer/save_representative',
            data:thisForm.serialize()+'&company_profile_id='+company_profile_id,
            success:function(result){
                thisForm[0].reset();
                location.reload();
            },
            error:function(err){

            },
        });
        return false;
    });*/

    /*$('#btn_save_profile_contact_info').click(function(){
        var thisForm = $(this).parents('form:first');
        //console.log($('#representative_info').serialize());
        $.ajax({
            type:'POST',
            url:'/portal/candidate/save_candidate_contact_info',
            data:thisForm.serialize()+'&candidate_profile_id='+candidate_profile_id,
            success:function(result){
                thisForm[0].reset();
                location.reload();
            },
            error:function(err){

            },
        });
        return false;
    });*/

    //Job Profile Position Filled Toogle
    $('.toggle-position-filled').click(function(){
        if(confirm('Are you sure to update the position status?'))
        {

            var job_profile_id = $(this).parents('tr:first').find('.job_profile_id').val();
            // alert(job_profile_id);
            location.href=base_url+"employer/update_position_filled_status/"+job_profile_id+"?status="+($(this).next().is(':checked') ? 'false':'true');
        }
        else
            return false;
    });

    if($(window).width() < 767)
        $('table').parents('.panel-body').css({'overflowX':'auto'});
    $(window).resize(function(event) {
        if($(window).width() < 767)
            $('table').parents('.panel-body').css({'overflowX':'auto'});
        else
            $('table').parents('.panel-body').css({'overflowX':'initial'});
    });
    
    // //BEGIN COUNTER FOR SUMMARY BOX
    // counterNum($(".profit h4 span:first-child"), 189, 112, 1, 30);
    // counterNum($(".income h4 span:first-child"), 636, 812, 1, 50);
    // counterNum($(".task h4 span:first-child"), 103, 155 , 1, 100);
    // counterNum($(".visit h4 span:first-child"), 310, 376, 1, 500);
});

function RemoveTrailingComma(str)
{
    return str.replace(/(^,)|(,$)/g, "")
}

function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}

function counterNum(obj, start, end, step, duration) {
    $(obj).html(start);
    setInterval(function(){
        var val = Number($(obj).html());
        if (val < end) {
            $(obj).html(val+step);
        } else {
            clearInterval();
        }
    },duration);
}

