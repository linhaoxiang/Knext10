<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once('model/head.php'); ?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-67534499-5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-67534499-5');
</script>

</head>
<body>

    <script>
    window.fbAsyncInit = function() {
        FB.init({
        appId      : '600546143671419',
        xfbml      : true,
        version    : 'v3.0'
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>

    <div id="langsetting" language="en"></div>
    <div class="container-fluid">
        <?php require_once('model/navbar.php'); ?>
        <div class="main-content">
            <?php require_once('model/s1.php'); ?>
            <?php require_once('model/s2.php'); ?>
            <?php require_once('model/s3.php'); ?>
            <?php require_once('model/s4.php'); ?>
            <?php require_once('model/s5.php'); ?>
            <?php require_once('model/s6.php'); ?>
            <?php require_once('model/s7.php'); ?>
        </div> 
        <?php require_once('model/footer.php'); ?>
        
    </div>
    <script src="js/imkosovo.js?t=<?php echo time(); ?>"></script>
    <script src="js/kosovowall.js?t=<?php echo time(); ?>"></script>
    <script src="js/mission.js?t=<?php echo time(); ?>"></script>
</body>
</html>


