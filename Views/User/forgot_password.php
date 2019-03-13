<div class="wrapper-box">

    <div class="box">
		<br />
        <h1 class="center title">Send a new password.</h1>
        <br />
        <?php 
        if (isset($error)) {
            echo '<p class="error-msg center">' . $error . '</p><br />';
        }
		?>
		<p class="center">
			We will send you a new password on your email adress. <br />
			Please change it back in your account's settings once connected.
		</p>
		<br>
            <form action="<?php echo WEBROOT . 'index.php/user/forgot_password'; ?>" method="post">
                <input type="email" class="input" name="email" placeholder="Account email" value="<?php if (isset($_SESSION['email'])) { echo $_SESSION['email']; } ?>" required>
				<br />
				<br />
				<input class="button is-info" type="submit" value="Send reset email">
				<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                <br />
            </form>
	</div>
	
    <div class="box">
        <p class="center"> <a href="/index.php/<?php echo (empty($_SESSION['pseudo']) ? 'login' : 'profile/edit'); ?>">Cancel</a></p>
    </div>

</div>