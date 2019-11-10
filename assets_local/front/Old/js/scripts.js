$(function(){
	
	$('input[name="btn-login"]').click(function(){

     ajax_message_div = '#login-modal';
     $.ajax({
        url:'login/validate',
        type:'POST',
        data: $(this).parents('form:first').serialize(),
        success:function(result)
        {
            ProcessMessage(result,ajax_message_div);
        },
        error:function(err)
        {
           ProcessMessage(err,ajax_message_div);
        }
        
     });
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
    $(".log-dropdown-menu").toggle();
  });

  $("")

});

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
}