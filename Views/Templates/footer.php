</main>
<footer>
	<div id="footer-links">
        <div class="footer-child">
            <p class="home">Home</p>
            <a class="logo" href="http://github.com/naplouvi" target="_blank">naplouvi <i>&copy; 2019</i></a>
        </div>
        <div  class="footer-child" >
            <p class="reachus">Reach us</p>

            <div>
                <p><a href="mailto:naplouvi@student.le-101.fr">Email</a></p>
                <p><a href="#">Twitter</a></p>
                <p><a href="#">Facebook</a></p>
            </div>
        </div>
        <div class="footer-child">
            <p class="clients">Miscellaneous</p>

            <div>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin')
                    echo '<p><a href="/index.php/admin/">Admin Panel</a></p>';
                ?>
                <?php if (isset($_SESSION['pseudo']))
                    echo '<p><a href="' . WEBROOT . 'index.php/user/disconnect">Disconnect</a></p>';
                ?>
            </div>
        </div>
	</div>
</footer>



</body>
</html>