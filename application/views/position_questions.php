<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="http://recruitment-ally.com/assets/front/css/profession-blue-navy.css" rel="stylesheet" type="text/css">
    <link href="http://recruitment-ally.com/assets/front/fonts/profession/style.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/favicon.png">
    <title>Recruitment Ally</title>
    <script type="text/javascript">
    var base_url = 'http://recruitment-ally.com/';
    </script>
</head>
<body class="hero-content-dark footer-dark">
    <div class="page-wrapper">
        <!-- /.header-wrapper-->

        <div class="main-wrapper">
            <div class="main container">
              <div style="background-color:#e7e7e7;margin:0px auto" class="col-lg-9">
                <?php if(empty($success)) : ?>
                        <?php if(isset($question_link->code)): ?>
                        <h5>Please answer the quetions below</h5>
                        <hr style="background-color:#000!important;color:#000!important">
                        <br>
                        <div id="questions">
                            <div class="panel panel-blue col-lg-12 left-padding right-padding" style="background:#FFF;">
                             <div class="panel-heading">Please complete the following quetions accurately so that we can proceed with next process</div>
                             <div class="panel-body">
                                <form method="POST" action="<?=base_url()?>save_position_questions/<?=$question_link->code?>?process=question">
                                <input type="hidden" value="<?=$question_link->candidate_profile_id?>" name="candidate_profile_id" id="candidate_profile_id"/>
                                <input type="hidden" value="<?=$question_link->job_profile_id?>" name="job_profile_id" id="job_profile_id"/>
                                <ul>
                                 <?php foreach ($questions as $key => $question) { ?>
                                 <li style="list-style-type:none;">
                                     <p style="padding:15px 0;margin:0;font-weight:bold;"><?=$question->question?> </p>
                                     <input style="width:22px" type="radio" checked value="yes_5" name="<?=$question->job_profile_question_id?>[]"> Yes 
                                     <input style="width:22px" type="radio" value="no_0" name="<?=$question->job_profile_question_id?>[]"> No 
                                 </li>
                                 <?php } ?>
                             </ul> 
                            <button class="btn btn-primary pull-right" type="submit">Save Answers/Feedback</button>
                            </form>
                         </div>
                     </div>
                 </div>
             <?php else: ?>
                <br/>
                <div class="alert alert-danger" role="alert">You have already answered the questions</div>
            <?php endif; ?>
          <?php else: ?>
            <br/>
            <div class="alert alert-success" role="alert">You answers have been successfully saved.</div>
          <?php endif; ?>
     </div>
 </div><!-- /.main -->
</div><!-- /.main-wrapper -->


</div>
</html>
