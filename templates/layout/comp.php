<html>
<head>
	<title>Hello, welcome to our computer store website!</title>
	<link  href="/computer_store/webroot/css/style.css" type="text/css" rel="stylesheet">

</head>

<body>

<div class="main">
	<div class="topbar"></div>
	
	<div class="socmed">
		<div class="container">
			<div class="icon">
				<a href="https://twitter.com/login" target="_blank">
					<img src="/computer_store/webroot/img/twitter.png">
				<a href="https://web.facebook.com/"target="_blank">
					<img src="/computer_store/webroot/img/facebook.png">
				<a href="https://www.instagram.com/accounts/login/" target="_blank">
					<img src="/computer_store/webroot/img/instagram.png">
				<!-- this three link above is directly link to the image button, which 
				mean when they click the image button, it will directly go to the 
				website link above -->

			</div>
		</div>
	</div>
	<div class="header_right">
				<div class="login_reg">
					<a href=<?= $this->Url->build(['controller'=>'users','action'=>'login']); ?> target="_blank"/>
					<span>Login/</span></a>
					<a href="/computer_store/users/register.php" target="_blank">
					<span>Register</span></a>
				</div>
				<div class="cart">
					<a href="/computer_store/templates/cart.php" target="_blank">
					<img src="/computer_store/webroot/img/cart.png">
					<span>Cart (0)</span></a>
				</div>
			</div>
	
	
	<div class="header">
		<div class="container">
			<div class="logo">
				<img src="/computer_store/webroot/img/logo.png">
			</div>
			<div class="navbar">
				
				<?= $this->element('nav'); ?>
				
			</div>
		</div>
	</div>
	
	<div class="welcome_text">
		<div class="container">
			<h1> WELCOME TO OUR PAGE!</h1>

		</div>
	</div>
	
</div>
<br>	
<br>	
<br>	
<br>	
<br>	
<br>	
<br>	
<br>	
<br>	
<br>	
<br>
<br>	
<br>	
<br>	
<br>	
<br>	
<br>	
<br>	
<br>	
<br>	
<br>	
<br>	
	<?= $this->fetch('content'); ?>
	
	<footer>
		
		<div class="footer">
			<div class="container">
				<div class="column3">
					<h4>About us</h4>
					<p>Please follow us in any social media below</p>
					<p>to make you up-to-date with our product</p>
					<br>
					<h4>Socialize with us</h4>
					<p><img src="/computer_store/webroot/img/fb.png"><img src="/computer_store/webroot/img/ig.png"><img src="/computer_store/webroot/img/tw.png">
				</div>	
				<div class="column3 second-row">
				<br>
					<h4>Our Archives</h4>
					<p>March 2012</p>
					<p>February 2013</p>
					<p>January 2014</p>
					<p>July 2015</p>
					<p><b>Contact us at</b> 07-4556368 </p>
				</div>	
			</div>
		</div>

	</footer>


</body>
</html>