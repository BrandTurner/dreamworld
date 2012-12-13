<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>A Simple and Elegant Login Page</title>

		<link href="css/stylesheet.css" rel="stylesheet">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
		<script src="js/main.js" type="text/javascript"></script>
	</head>
	<body>
		
		<header>
			<!-- later change to quirky style -->
			<div id="container-header" class="container">
				
				<div class="logo"></div>
				<hgroup>
					<h2>Responsively Designed for Irresponsible Enjoyment</h2>
				</hgroup>

				

			</div>

		</header> 

		<div id="container-main" class="container">
			
			<div id="content" class="home" style="">

				<article>
					<a href="#"><h3>Existing Users - Log In Here</h3></a>

					
					<p>This site is responsively designed so that it looks great whether you're on your laptop, ipad, or iphone. </p>
					<p>This is a single page site that handles CRUD/Account Creation, login, and editing with AJAX/JSON.</p>
					<p>This site uses PDO to connect to a MySQL DB for greater flexibility and scalability.</p>
					<p>The code can be found on my github acct: <a href="#">Click here</a></p>
					<p><div id="login">
					<form class="login-main" id="login_form" method="post">
						<input type="hidden" name="login_submit" id="login_submit" />
						<div class="field">
							<label for="username">Username</label>
							<input type="text" name="username" />
						</div>
						<div class="field">
							<label for="password">Password</label>
							<input type="password" name="password" />
						</div>
						<button class="btn btn-primary" type="button" id="login_btn" style="margin-top: 29px;">Log-in</button>
					</form>
				</div></p>
				</article>

			</div>

			<div id="sidebar" class="home" style="">
				
				<aside id="brief">
					<h4><b>Want to demo my login script?</b> Sign up.</h4>

					<form id="signup" method="post">
						<input type="hidden" name="check_submit" value="1" id="check_submit" />
						<div class="field">
							<label for="firstName">First Name:</label>
							<input name="firstName" size="50" type="text" />
						</div>

						<div class="field">
							<label for="lastName">Last Name:</label>
							<input name="lastName" size="50" type="text" />
						</div>

						<div class="field">
							<label for="username">Username:</label>
							<input name="username" size="50" type="text" />
						</div>

						<div class="field">
							<label for="password">Password:</label>
							<input name="password" size="50" type="password" />
						</div>

						<div class="field">
							<label for="email">Email:</label>
							<input name="email" size="50" type="text" />
						</div>

						<div class="field">
							<label for="address">Address:</label>
							<input name="address" size="50" type="text" />
						</div>

						<div class="field">
							<label for="city">City:</label>
							<input name="city" size="50" type="text" />
						</div>

						<div class="field">
							<label for="state">State:</label>
							<input name="state" size="50" type="text" />
						</div>

						<div class="field">
							<label for="zip">Zip:</label>
							<input name="zip" size="50" type="text" />
						</div>

						<div class="field">
							<input type="submit" />
						</div>

					</form>
				</aside>
				
				
			</div>

			<div id="profile" style="display: none;">
				<form id="update" method="post">
					<h1>Profile Settings</h1>
					<input type="hidden" name="update" id='updateType' />
					<input type="hidden" name="userID" id='userID' />

					<div style="height:75px;">
						<div class="field">
							<label for="firstname">First Name</label>
							<input type="text" name="firstname" id='firstname' />
						</div>

						<div class="field">
							<label for="lastname">Last Name</label>
							<input type="text" name="lastname" id='lastname' />
						</div>

						<div class="field">
							<label for="email">Email Address</label>
							<input type="text" name="email" id='email' />
						</div>
					</div>
					<!-- margin-bottom set -->
					<div style="height:75px;">
						<div class="field">
							<label for="username">Username</label>
							<input type="text" name="username" id='username' />
						</div>

						<div class="field">
							<label for="password">Password</label>
							<input type="text" name="password" id='password' />
						</div>
					</div>

					<div style="height:75px;">
						<div class="field">
							<label for="address">Address</label>
							<input type="text" name="address" id='address' />
						</div>

						<div class="field">
							<label for="city">City</label>
							<input type="text" name="city" id='city' />
						</div>

						<div class="field">
							<label for="state">State</label>
							<input type="text" name="state" id='state' />
						</div>

						<div class="field">
							<label for="zip">Zip</label>
							<input type="text" name="zip" id='zip' />
						</div>

					</div>

					<button class="btn btn-primary" id="updateProfile" type="button">Update Profile</button>
					<button class="btn btn-primary" id="deleteProfile" type="button">Delete Profile</button>
					<!--<article>
						<a href="#"><h3>Looky Here!</h3></a>
						<img src="http://www.wired.com/images_blogs/dangerroom/2012/12/070931-M-5827M-011-660x440.jpg" />
						<p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna.</p>
						<p>Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis libero dolor a purus. Sed vel lacus. Mauris nibh felis, adipiscing varius, adipiscing in, lacinia vel, tellus. Suspendisse ac urna. Etiam pellentesque mauris ut lectus. Nunc tellus ante, mattis eget, gravida vitae, ultricies ac, leo. Integer leo pede, ornare a, lacinia eu, vulputate vel, nisl.</p>
						<p><a href="#">Read More...</a></p>
					</article>-->
				</form>
			</div>


			<footer>
			
				<nav>
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Projects</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
				</nav>
				
				<p>&copy; Copyright 2011. All Rights Reserved</p>
			
			</footer>
		</div>
		
	</body>
</html>