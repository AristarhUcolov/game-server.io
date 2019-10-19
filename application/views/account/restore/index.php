<?php
/*
Copyright (c) 2014 LiteDevel

Данная лицензия разрешает лицам, получившим копию данного программного обеспечения
и сопутствующей документации (в дальнейшем именуемыми «Программное Обеспечение»),
безвозмездно использовать Программное Обеспечение в  личных целях, включая неограниченное
право на использование, копирование, изменение, добавление, публикацию, распространение,
также как и лицам, которым запрещенно использовать Програмное Обеспечение в коммерческих целях,
предоставляется данное Программное Обеспечение,при соблюдении следующих условий:

Developed by LiteDevel
*/
?>
<?php echo $loginheader ?>

  <html xmlns="http://www.w3.org/1999/xhtml" lang="ru-RU"><!--<![endif]--><head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="robots" content="noindex,follow">
 </head>
 				    						<section class="content-header no-margin">
                </section>
				<section class="content">
 <body class="login login-action-lostpassword wp-core-ui  locale-ru-ru">
 <div id="login">
<form class="form-signin" id="lostpasswordform" action="#" method="POST">
      <h4 class="heading-desc text-left"> 
          <b>Восстановление пароля</b>
            </h4>
 <p>
  <input type="text" class="form-control" name="email" id="email" class="input" value="" size="20" placeholder="E-Mail"></label>
 </p>
  <input type="hidden" name="redirect_to" value="">
 <p class="submit">
 

<button class="btn btn-lg btn-primary btn-block" type="submit">Восстановить</button>
<div class="other-link"><a href="/">← Войти</a></div>
<div class="other-link"><a href="/account/register">Еще не зарегистрированы?</a></div>
 </form>
</div>

  <script type="text/javascript">
 try{document.getElementById('user_login').focus();}catch(e){}
 if(typeof wpOnload=='function')wpOnload();
 </script>
 
  <div class="clear"></div>
 
 
 </body></html>
  <script>
   $('#lostpasswordform').ajaxForm({ 
    url: '/account/restore/ajax',
    dataType: 'text',
    success: function(data) {
     console.log(data);
     data = $.parseJSON(data);
     switch(data.status) {
      case 'error':
       showError(data.error);
       reloadImage('#captchaimage');
       $('button[type=submit]').prop('disabled', false);
       break;
      case 'success':
       showSuccess(data.success);
       break;
     }
    },
    beforeSubmit: function(arr, $form, options) {
     $('button[type=submit]').prop('disabled', true);
    }
   });
   $('.captcha img').click(function() {
    reloadImage(this);
   });
  </script>
<?php echo $loginfooter ?>
