



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<?$this->load->view('common/head');?>
	
<body <?=$id?>>
    <div class="container">
        <div id='fb-root'></div>
        <!-- HEADER -->
        <?$this->load->view('common/header');?>
        <?$this->load->view('content/'.$view);?>
		<?$this->load->view('common/footer');?>
	</div>




<script src='http://pics01.adooscore.com/js/jquery-1.7.1.min.js' type='text/javascript'></script> 
<script src='http://pics01.adooscore.com/js/jquery.center.js' type='text/javascript'></script> 
<script src='http://pics02.adooscore.com/js/jquery.ui.core.js' type='text/javascript'></script> 
<script src='http://pics02.adooscore.com/js/jquery.ui.widget.js' type='text/javascript'></script> 
<script src='http://pics03.adooscore.com/js/jquery.ui.position.js' type='text/javascript'></script> 
<script src='http://pics03.adooscore.com/js/jquery.ui.autocomplete.js' type='text/javascript'></script> 
<script type='text/javascript' src='https://apis.google.com/js/plusone.js'></script> 



	<script>
		$(function() {
			function log( message ) {
				$( "<div/>" ).text( message ).prependTo( "#log" );
				$( "#log" ).scrollTop( 0 );
			}

			$( "#query" ).autocomplete({
				source: "/autocompletedemo/search_data.php",
				minLength: 1,
				select: function( event, ui ) {
					log( ui.item ?
						"Selected: " + ui.item.value + " aka " + ui.item.id :
						"Nothing selected, input was " + this.value );
				}
			});
		});
	</script>


	
<script>

jQuery(document).ready (function() {
	
	$('.fb-login-button').click( function(){
		FB.login(function(response) {
			if (response.authResponse) {
				// User is connected to the application.

			}
		}, {scope: 'email'});
	});
	
	//facebookInit("315450485140425", "en_US", function () {});
	
	$('#fb-logout').click( function(){
		FB.logout();
	});
	
	$('#login_pop .u_facebook').show(); 
});

</script>

<script type="text/javascript" charset="utf-8"> 
	var fb_status = -1;

	window.fbAsyncInit = function() {
		FB.init({
			appId      : '315450485140425', // App ID
			//channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
			status     : true, // check login status
			cookie     : true, // enable cookies to allow the server to access the session
			oauth      : true, // enable OAuth 2.0
			xfbml      : true  // parse XFBML
		});

		FB.Event.subscribe( 'auth.login', function(response) {
			console.log('subscribe login');
			$.post('/posting/accountCheck.php' , {log : 1}  );
			FB_login_events();
		});


		FB.Event.subscribe('auth.logout', function() {
			console.log('subscribe logout');
			$.post('/posting/accountCheck.php' , {logout : 1}  );
			//FB_logout_events();
		});

	};
	
	// Load the SDK Asynchronously
	(function(d){
		var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
		js = d.createElement('script'); js.id = id; js.async = true;
		js.src = "//connect.facebook.net/en_US/all.js";
		d.getElementsByTagName('head')[0].appendChild(js);
	}(document));

	function FB_login_events(){
		$('.fb-login-button').hide();
		$('.home ul.user-login').hide();
		$('li#adoos-login-links').hide();
		$('li.fb-dologin-msg').hide();

		FB.api('/me',function(response){
			// Cargo nombre de usuario
			if( response.first_name ){
				$('#fb-username').html(response.first_name); 
				$('#loggedUserMenu').show(); 
				$('#login_pop .close').click();
				$('ul#userMenu').hide();
			}
		});
	}

	function FB_logout_events(){
		$('.fb-login-button').show();
		$('ul.user-login').show();
		$('li#adoos-login-links').show();
		$('#fb-username').html( '' );
		$('#loggedUserMenu').hide(); 
	}
	

    $(document).ready(function(){
        // Advanced Search
		
		$('a#logout').click( function(event){
			event.preventDefault();
			FB.logout();
			var url = $(this).attr('href');
			setTimeout( function(){ document.location = url;  } , 500 );
		});
		
		
		$('#l_login').click( function() {
			var bck = $('#transp');
			bck.show();
			bck.height($(window).height()*2);
			bck.center();
			bck.click( function() { $(this).hide(); $('#login_pop').hide(); });
			var pop = $('#login_pop');
			pop.show();
			pop.center();
			if ($.browser.msie && $.browser.version.substr(0,1) == 6){
            	$("select").hide();
            }
			return false;
		});
		$('#login_pop form .recover').click( function() {
		    $('#login_pop').hide();
			var pop = $('#recovery_pop');
			pop.show();
			pop.center();
			if ($.browser.msie && $.browser.version.substr(0,1) == 6){
            	$("select").hide();
            }
			return false;
		});
		$('#l_signup').click( function() {
			var bck = $('#transp');
			bck.show();
			bck.height($(window).height()*2);
			bck.center();
			bck.click( function() { $(this).hide(); $('#signup_pop').hide(); });
			var pop = $('#signup_pop');
			pop.show();
			pop.center();
			if ($.browser.msie && $.browser.version.substr(0,1) == 6){
            	$("select").hide();
            }
			return false;
		});
		$('#login_pop .close, #signup_pop .close, #recovery_pop .close').click( function() {
			$(this).parent().parent().hide();
			$('#transp').hide();
			if ($.browser.msie && $.browser.version.substr(0,1) == 6){
            	$("select").show();
            }
			return false;
		});
		$(document).keyup(function(event){
			if (event.keyCode == 27) {
				$('#login_pop').hide();
				$('#signup_pop').hide();
				$('#recovery_pop').hide();
				$('#transp').hide();
				if ($.browser.msie && $.browser.version.substr(0,1) == 6){
                	$("select").show();
                }
				return false;
			}
		});
		
		// Le quito el fondo transparente si es IE6
		if ($.browser.msie && $.browser.version.substr(0,1) == 6){
        	$("#transp").css("background","none");
        }
    });
</script> 
 
<style type="text/css" media="screen"> 
    #transp { background:url(http://staticcache.adoosimg.com/pages/img/aSearch_transparency.png); display:none; position:absolute; height:900px; width:100%; }
    #login_pop { background: url(http://staticcache.adoosimg.com/pages/img/aSearch_transparency.png); clear:both; display:none; padding:10px; position:absolute; left:50px; top:50px; width:605px; }
    #login_pop h3 { background-color:#369; border:1px solid #036; border-width:1px 1px 0; color:#FFF; float:left; font-size:14px; padding:7px 10px; width:583px;margin-bottom:0; font-family:Verdana; }
    #login_pop form { position:relative; }
    #login_pop form h4 { margin-bottom:10px; }
    #login_pop form { background:#FFF; border:1px solid #333; border-width:0 1px 1px; float:left; padding:10px 0 10px 10px; position:relative; width:593px; }
    #login_pop form fieldset { float:left; padding:0 10px; width:300px; }
    #login_pop form fieldset.u_form { border-right:2px solid #369; }
    #login_pop form fieldset.u_facebook { text-align: center; width: 240px;  }
    #login_pop form label { float:left; font-weight:bold; line-height:24px; margin-right:10px; width:100px; }
    #login_pop form input { border:1px solid #97a0b3; font:12px Arial, Helvetica, sans-serif; margin-bottom: 10px; padding:3px; width:150px; }
    #login_pop form button { float:right; font-size:14px; margin-right:33px; padding:4px 10px; }
    #login_pop form .recover { float:left; font-size:11px; line-height:24px; margin-left:40px; }
    #login_pop form .close { background:url(http://staticcache.adoosimg.com/pages/img/aSearch_close.gif) no-repeat 0 0; color:#FFF; font-size:11px; font-weight:bold; padding:0 0 3px 20px; position:absolute; right:15px; text-decoration:underline; top:-22px; }
    #login_pop form .register { background:#d1e7ff; clear:both; float:left; margin-top:20px; padding:10px; text-align: center; width:280px;}
    #login_pop form .register a { font-weight:bold; text-decoration:underline;}
    
    #signup_pop { background: url(http://staticcache.adoosimg.com/pages/img/aSearch_transparency.png); clear:both; display:none; padding:10px; position:absolute; left:50px; top:50px; width:605px; }
    #signup_pop h3 { background-color:#369; border:1px solid #036; border-width:1px 1px 0; color:#FFF; float:left; font-size:14px; padding:7px 10px; width:583px; }
    #signup_pop form h4 { margin-bottom:10px; }
    #signup_pop form { background:#FFF; border:1px solid #333; border-width:0 1px 1px; float:left; padding:10px 0 10px 10px; position:relative; width:593px; }
    #signup_pop form fieldset { float:left; padding:0 10px; width:330px; }
    #signup_pop form fieldset.u_form { border-right:2px solid #369; }
    #signup_pop form fieldset.u_facebook { text-align: center; width: 220px;  }
    #signup_pop form label { float:left; font-weight:bold; line-height:25px; margin-right:10px; width:135px; }
    #signup_pop form input { border:1px solid #97a0b3; font:12px Arial, Helvetica, sans-serif; margin-bottom: 10px; padding:3px; width:150px; }
    #signup_pop form label.checkbox { margin-right:0; font-size:11px; font-weight:normal; line-height:14px; margin-bottom: 10px; width:100%; }
    #signup_pop form label.checkbox input { border:none; float:left; margin:0 10px 0 0; width:auto; }
    #signup_pop form label.checkbox p { float:left; width:280px; }
    #signup_pop form button { float:right; font-size:14px; margin-right:33px; padding:4px 10px; }
    #signup_pop form .close { background:url(http://staticcache.adoosimg.com/pages/img/aSearch_close.gif) no-repeat 0 0; color:#FFF; font-size:11px; font-weight:bold; padding:0 0 3px 20px; position:absolute; right:15px; text-decoration:underline; top:-22px; }
    
    #recovery_pop { background: url(http://staticcache.adoosimg.com/pages/img/aSearch_transparency.png); clear:both; display: none; padding:10px; position:absolute; left:50px; top:50px; width:375px; }
    #recovery_pop h3 { background-color:#369; border:1px solid #036; border-width:1px 1px 0; color:#FFF; float:left; font-size:14px; padding:7px 10px; width:353px; }
    #recovery_pop form h4 { margin-bottom:10px; }
    #recovery_pop form { background:#FFF; border:1px solid #333; border-width:0 1px 1px; float:left; padding:10px 0 10px 10px; position:relative; width:363px;}
    #recovery_pop form fieldset { float:left; padding:0 10px; width:330px; }
    #recovery_pop form label { float:left; font-weight:bold; line-height:25px; margin-right:10px; width:75px; }
    #recovery_pop form input { border:1px solid #97a0b3; font:12px Arial, Helvetica, sans-serif; margin-bottom: 10px; padding:3px; width: 235px; }
    #recovery_pop form button { float:right; font-size:14px; margin-right:4px; padding:4px 10px; }
    #recovery_pop form .close { background:url(http://staticcache.adoosimg.com/pages/img/aSearch_close.gif) no-repeat 0 0; color:#FFF; font-size:11px; font-weight:bold; padding:0 0 3px 20px; position:absolute; right:15px; text-decoration:underline; top:-22px; }
    
</style> 
 
<div id="transp"></div> 
<div id="login_pop"> 
    <h3>Acceso Cuenta</h3> 
    <form action="http://www.adoos.com.pe/accounts/" method="post"> 
    <fieldset class="u_form"> 
        <h4>Acceso Cuenta</h4> 
        <label for="email">Email:</label><input type="text" name="user" value="" id="user" /><br /> 
        <label for="pass">Contraseña:</label><input type="password" name="passwordname" value="" id="passwordname" /><br /> 
        <a class="recover" href="#">Olvidé mi contraseña</a> 
        <button type="submit" name="action_publish">Acceso</button> 
		<input type="hidden" name="PageBackName" value="http://www.adoos.com.pe/">
		
        <p class="register">No account? <a href="http://www.adoos.com.pe/accounts//signup/">Abrir cuenta gratuita</a>.</p> 
    </fieldset> 
	
    <fieldset class="u_facebook" style='display: none;'> 
        <h4>¿Eres usuario de Facebook? Accede utilizando tu cuenta</h4> 
        <!--<a href="#"><img src="img/facebook_connect.gif" alt="Facebook connect" /></a> -->
		<fb:login-button scope="email" autologoutlink="true" ></fb:login-button>
    </fieldset> 
    <a href="#" class="close">Close</a> 
    </form> 
</div> 
<div id="recovery_pop"> 
    <h3>Olvidé mi contraseña </h3> 
    <form action="http://www.adoos.com.pe/accounts//home/forget.php" method="post"> 
    <fieldset class="u_form"> 
        <h4>Olvidé mi contraseña</h4> 
        <label for="email">Email:</label><input type="text" name="user" value="" id="user" /><br /> 
        <button type="submit">Acceso</button> 
    </fieldset> 
    <a href="#" class="close">Close</a> 

    </form> 
</div> 


<script type="text/javascript">
// When the Document Object Model is ready
jQuery(document).ready(function(){
	var formTopPosition = jQuery('#content').offset().top;
	
	// When .gotoContent is clicked
	jQuery('.gotoContent').click(function(){
		jQuery('html, body').animate({scrollTop:formTopPosition}, 'slow');
		return false;
	});
     
	// When .tgoggleHeader is clicked
	jQuery('.tgoggleHeader').click(function(){
		jQuery('#header').toggle();
		jQuery(this).toggleClass('collapsed');
		return false;
	});
        $("#hero-search-input").click(function() {
          $("#hero-search-input").attr("placeholder","");
        });
        $("#hero-search-input").blur(function() {
          $("#hero-search-input").attr("placeholder","¿Qué estás buscando?");
});
});
  
</script>

                      
            
        
           
