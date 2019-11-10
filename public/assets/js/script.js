$(document).ready(function() {
	'use strict';

    setTimeout(function(){
    if(!$('#global_notification').hasClass('hidden'))
      $('#global_notification').fadeOut(500);
    },3000);

    // $('img').each(function(){
    //   if(!$(this).is('[width]'))
    //     $(this).attr('width','100%');
    //   if(!$(this).is('[height]'))
    //     $(this).attr('height','100%');
    // });

	/**
	 * Count Up
	 */
	$('.stat-item').each(function() {
		var numAnim = new CountUp($('strong', this).attr('id'), 0, $(this).data('to'), 0, 1.5, {
			useEasing : true,
			useGrouping : true,
			separator : ',',
			decimal : '.',
			prefix : '',
			suffix : ''
		});
		numAnim.start();
	});

	/**
	 * Action Bar
	 */
	// Switch the body classes
	$('.action-bar-chapter a').on('click', function(e) {
		e.preventDefault();

		$(this).closest('ul').find('a').removeClass('active');
		$(this).closest('ul').find('a').each(function() {
			$('body').removeClass($(this).attr('data-action'));
		});
		$('body').addClass($(this).attr('data-action'));
		$(this).addClass('active');
	});

	// Change color combination
	$('.action-bar-chapter table a').on('click', function(e) {
		e.preventDefault();
		$(this).closest('table').find('a').removeClass('active');
		$(this).addClass('active');

		var uri = $(this).attr('href');
		$('#style-primary').attr('href', uri);
	});

	// Hide/Show
	$('.action-bar-title').on('click', function(e) {
		$('.action-bar-content').toggleClass('open');
	});

	/**
	 * ezMark
	 */
//	$('input[type=radio], input[type=checkbox]').ezMark();

	/**
	 * Bootstrap select
	 */
	// $('select').selectpicker({
	// 	style: 'btn',
	// 	template: {
 //      		caret: '<i class="fa fa-chevron-down"></i>'
 //    	},
	// });

	// /**
	//  * Bootstrap wysiwyg
	//  */
	// $('#editor').wysihtml5();;

	// /**
	//  * Fileinput
	//  */
	// $("#form-register-photo").fileinput({
	// 	dropZoneTitle: '<i class="fa fa-photo"></i><span>Upload Photo</span>',
	// 	uploadUrl: '/',
	// 	maxFileCount: 1,
	// 	showUpload: false,
	// 	browseLabel: 'Browse',
	// 	browseIcon: '',
	// 	removeLabel: 'Remove',
	// 	removeIcon: '',
	// 	uploadLabel: 'Upload',
	// 	uploadIcon: ''
	// });

  $(".news-btn").click(function(){
      $(".newsletter").slideToggle(300);
  });

  $('.company-card-image .website-url').click(function(event) {
      var id = $(this).attr('data-id');
      $.ajax({
        url: base_url+'update_website_clicked_count?id='+id,
        type: 'POST',
        success:function(result)
        {
            console.log(result);
            // ProcessMessage(result,ajax_message_div);
        },
        error:function(err)
        {
            // ProcessMessage(err,ajax_message_div);
        }
      });
  });

  $(document).on('click','#reset_password_modal #reset_password_request',function(){
            if(!$(this).hasClass('disabled'))
            {
                if($('#reset_email').val() != '')
                {
                    $('#reset_email').css('border','1px solid #b3b3b3');
                    var thisBtn = $(this);
                    thisBtn.addClass('disabled');
                    $.ajax({
                        url:base_url+'reset_password',
                        data:{reset_email:$('#reset_email').val()},
                        type:'POST',
                        success:function(data){
                            if(data == "1")
                            {
                                $('#reset_password_modal').find('#step_2').removeClass('hidden');
                                $('#reset_password_modal').find('#step_1').remove();
                            }
                            thisBtn.removeClass('disabled');
                        },
                        error:function(data){
                            thisBtn.removeClass('disabled');
                        },
                    });
                }
                else
                {
                    $('#reset_email').css('border','1px solid red');
                } 
            }
            return false; 
        });

        $(document).on('click','#reset_password_modal #reset_password',function(){
            if(($('#reset_new_password').val() != '' && $('#reset_confirm_new_password').val()!= '') && ($('#reset_new_password').val() == $('#reset_confirm_new_password').val()))
            {
                if(!$(this).hasClass('disabled'))
                {
                    var thisBtn = $(this);
                    thisBtn.addClass('disabled');
                    $('#reset_new_password,#reset_confirm_new_password').css('border','1px solid #b3b3b3');
                    $.ajax({
                        url:'/account/change_password',
                        data:{password:$('#reset_new_password').val(),reset_password_code:$('#reset_password_code').val()},
                        type:'POST',
                        success:function(data){
                            if(data == "1")
                            {
                                $('#reset_password_modal').find('#step_4').removeClass('hidden');
                                $('#reset_password_modal').find('#step_3').remove();                        
                                //$(this).parents('.modal-body:first').fadeOut(500).delay(500).remove();
                            }
                            thisBtn.removeClass('disabled');
                            //console.log(data);
                        },
                        error:function(data){
                            thisBtn.removeClass('disabled');
                        },
                    });
                }
            }
            else
            {
                $('#reset_new_password,#reset_confirm_new_password').css('border','1px solid red');
            }
        });
        $('#login_modal [data-target="#reset_password_modal"]').on('click', function () {
            $('#login_modal').modal('hide');
        });
        $('#reset_password_modal [data-target="#login_modal"]').on('click', function () {
            $('#reset_password_modal').modal('hide');
        });

  $("#btn_candidate_register_form,#btn_employer_register_form").click(function(e){
        if(!$(this).hasClass('disabled'))
        {
          var thisBtn = $(this);
          thisBtn.addClass('disabled');
          //thisBtn.text('Registering...');
          var ajax_message_div = '#register_modal';
          var this_form = $(this).parents('form:first');
          var url=base_url+'register/';
          var register_type='candidate';
          //console.log(this_form.attr('name'));
          if(this_form.attr('name') == 'employer_register_form')
          {
            var register_type='employer';
          }
          
          console.log(register_type);

          $.ajax({
            type:'POST',
            url:url+register_type,
            data:this_form.serialize(),
            success:function(result)
            {
              console.log(result); 
              var parsed_result = JSON.parse(result);
              if(parsed_result.error_code == 0)
              {
//                    $(ajax_message_div).find('.modal-body').find('ul.nav-tabs,.tab-content').hide();
                    $('#register_modal').modal('show');
                    if(register_type == 'candidate')
                      $(ajax_message_div).find('.modal-body').find('.registration_confirmation_verification.candidate_message').removeClass('hidden');
                    else
                      $(ajax_message_div).find('.modal-body').find('.registration_confirmation_verification.employer_message').removeClass('hidden');
              }
              else
              {
                //thisBtn.text('Register');
                $("#err_log").html(parsed_result.message);
                ProcessMessage(result,ajax_message_div);
                return 'error';
              }
              thisBtn.removeClass('disabled');
            },
            error:function(err)
            {
               thisBtn.removeClass('disabled');
               ProcessMessage(err,ajax_message_div);
            }
          });
        }
        e.preventDefault(); 
        return false;
     });

	
	$('#btn-login').click(function(){
	 //return false;
    if(!$(this).hasClass('disabled'))
    {
     var thisBtn = $(this);
     var ajax_message_div = '#login_modal';
     thisBtn.addClass('disabled');
     $.ajax({
        url:base_url+'login/validate/',
        type:'POST',
        data: $(this).parents('form:first').serialize(),
        success:function(result)
        {
        	//console.log(result);
          thisBtn.removeClass('disabled');
          ProcessMessage(result,ajax_message_div);
        },
        error:function(err)
        {
          thisBtn.removeClass('disabled');
          ProcessMessage(err,ajax_message_div);
        }
     });
    }
    return false;
  });

  $(document).on('click','a',function(){
      if($(this).attr('href') == '#')
	return false;
  });

  $('.modal').on('hidden.bs.modal', function(){
    $(this).find('form .alert').addClass('hidden').text('');
    $(this).find('form')[0].reset();
  });

  $(".drop-btn").click(function(){
    $(this).parent().find(".log-dropdown-menu").toggle();
  });

  $(".btn-reset-filter").click(function(){
  	// console.log('reset..');
  	// $("#filter_search_form").find('input').each(function(index, el) {
  	// 	$(this).find('[type="text"]').val('');
  	// 	$(this).find('[type="checkbox"]').prop('checked',false);
  	// 	//$(this).removeAttr('selected');
  	// });
  	// return false;
  	//return false;
  	location.reload();
  });
  $("#filter_results button").click(function(e){
        e.preventDefault();
        filter_jobs_listed();
        return false;
    });
  $(".pagination a").attr('href','#');
  $(document).on('click','[data-ci-pagination-page]',function(){
  	current_page = $(this).attr('data-ci-pagination-page');
  	filter_jobs_listed();
  	return false;
  });
  $('#keyword,[name="country[]"],[name="employment_status[]"],[name="career_level[]"],[name="salary_range[]"]').on('keyup change',function(e)
    {
      if($(this).attr("id") == 'keyword' && e.type=='change')
        return false; 
      filter_jobs_listed();
      return false;
    });	

   $('.save_position a').click(function(){
   		var thisObj= $(this);
      if(thisObj.attr('href') != "#")
      {
     		$.ajax({
     			url: thisObj.attr('href'),
     			type: 'POST',
     			success : function(result) {
     			thisObj.attr('href','#').text('Position Saved');
     			console.log("success");
     			},
  	   		error : function() {
  	   			console.log("error");
  	   		}
     		});
   		}
   		return false;
   });

      $('.like-job').click(function(){
      var thisObj= $(this);
      if(thisObj.attr('href') != "#")
      {
        $.ajax({
          url: thisObj.attr('href'),
          type: 'POST',
          success : function(result) {
          thisObj.attr('href','#').text('Job Liked');
          console.log("success");
          },
          error : function() {
            console.log("error");
          }
        });
      }
      
      return false;
   });


});
var current_page = 0;
function filter_jobs_listed()
{
	var get_params = location.search.replace('?','');         
		if(get_params != '')
			get_params = '&' + get_params;
        //var keyword = $('#keyword').val();
        //console.log()
        if($('.search_loader').length == 0)
        {
          $('.main-wrapper').append('<img class="search_loader" style="position:fixed;top:50%;left:50%;z-index:25001;" src="'+base_url+'assets/front/img/preloader.gif" />')
          $('.main-wrapper').append('<div class="loader-overlay" style="background-color: rgba(255, 255,255, 0.50);height: 100%;position: fixed;top: 0;width: 100%;z-index: 25000;"></div>')
        }
        $.ajax({
            url: base_url+'filter_results',
            type: 'POST',
            data: $("#filter_search_form").serialize()+get_params+'&page='+current_page,
            success:function(results){
                //console.log(results);
                UpdateSearchFunction(results);
                $('.search_loader,.loader-overlay').remove();
            },
            error:function(err){
                console.log("error");
                $('.search_loader,.loader-overlay').remove();
            }
        });
}

function UpdateSearchFunction(results)
{
	var parsed_results = JSON.parse(results);
	var result_html = '';
	parsed_results.jobs.forEach(function(result){
		//console.log(result);
		var posted_date = new Date(result.posted_date);
		console.log(result.posted_date);
//		result_html += '<div class="positions-list-item"><h2><a href="'+base_url+'posting/'+result.job_ref_no+'">'+result.position+'</a></h2><p style="margin-bottom:0px!important;"><h3>Job Ref:'+result.job_ref_no+'</h3> </p><h3 style="margin-top:0px!important;">'+result.country+', '+result.company_name+' <br></h3><div class="position-list-item-date">'+(result.posted_date.replace('00:00:00','')).replace('/-/g','/')+'</div><!-- /.position-list-item-date --><div class="position-list-item-action"><a href="#">Save Position</a></div></div>';
//		
		result_html += '<div class="positions-list-item">',
                result_html += '<div class="item-block">',
                result_html += '    <header>',
                result_html += '        <div class="hgroup">',
                result_html += '            <a href="'+base_url+'posting/'+result.job_ref_no+'"><h4>'+result.position+'</h4></a>',
                result_html += '            <h5>'+result.company_name+'<span class="label label-success"><a href="#">Save Position</a></span></h5>',
                result_html += '        </div>',
                result_html += '        <time>'+(result.posted_date.replace('00:00:00','')).replace('/-/g','/')+'</time>',
                result_html += '    </header>',
                result_html += '    ',
                result_html += '    <footer>',
                result_html += '        <ul class="details cols-3">',
                result_html += '            <li>',
                result_html += '                <i class="fa fa-map-marker"></i>',
                result_html += '                <span>'+result.country+'</span>',
                result_html += '            </li>',
                result_html += '            ',
                result_html += '            <li>',
                result_html += '                <i class="fa fa-clock-o"></i>',
                result_html += '                <span>',
                result_html += '                    Full Time',
                result_html += '                </span>',
                result_html += '            </li>',
                result_html += '            ',
                result_html += '            <li>',
                result_html += '                <i class="fa fa-suitcase"></i>',
                result_html += '                <span>Job Ref:'+result.job_ref_no+'</span>',
                result_html += '            </li>',
                result_html += '        </ul>',
                result_html += '    </footer>',
                result_html += '</div>',
                result_html += '</div>'
//		
        //console.log(result_html);
	});
  //console.log(parsed_results.jobs.length);
	$("#listing_total").html(parsed_results.jobs.length);
	$('.positions-list').html('');
//	$('.pagination').remove();
	$('.positions-list').next().html(parsed_results.pagination);
	$(document).find(".pagination a").attr('href','#');
	$('.pagination').find('li').removeClass('active').eq(current_page-1).addClass('active');
	$('.pagination li').each(function(index, el) {
		$(this).find('a').attr('data-ci-pagination-page',index+1);
	});
    $(result_html).appendTo('.positions-list');
}

var danger_div = '.alert.alert-danger';
var success_div = '.alert.alert-success';

function ProcessMessage(json_message,ajax_message_div)
{
  var result = JSON.parse(json_message);
  //window.location="/"
  if(result.redirect != undefined)
  {
    window.location = result.redirect;
    return;
  }
  if(result.error_code == 1)
     DisplayErrorMessage(result.message,ajax_message_div);
  else
    DisplaySuccessMessage(result.message,ajax_message_div);
}

function DisplayErrorMessage(message,ajax_message_div)
{
  $(ajax_message_div).find(success_div).remove();
  if($(ajax_message_div).find(danger_div).length == 0)
  {
    
    $(ajax_message_div).find('.alert').addClass('alert-danger').removeClass('alert-success').removeClass('hidden').text(message);
  }
  else
  {
    $(ajax_message_div).find('.alert').addClass('alert-danger').show().text(message);
  }
}

function DisplaySuccessMessage(message,ajax_message_div)
{
  $(ajax_message_div).find(danger_div).remove();
  if($(ajax_message_div).find(success_div).length == 0)
  {
    $(ajax_message_div).find('.alert').addClass('alert-success').removeClass('alert-danger').removeClass('hidden').text(message);
  }
  else
  {
    $(ajax_message_div).find('.alert').addClass('alert-success').show().text(message);
  }
  location.reload();
}

function RemoveTrailingComma(str)
{
	return str.replace(/(^,)|(,$)/g, "")
}

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-73721047-1', 'auto');
  ga('send', 'pageview');