<div class="wrapper-box">
    <div class="box">
        <h1 class="title center">Mail activation</h1>
        <br />
        <?php if (isset($error)) : ?>
            <p class="error"><?= $error ?></p>
            <br />
            <p>No activation link received ? <a href="index.php/activation/resend">Send a new confirmation mail.</a></p>
        <?php endif; if (isset($success)) :?>
            <p><?= $success ?></p>
        <?php endif; if (isset($already_confirmed)) : ?>
            <p><?= $already_confirmed ?></p>
        <?php endif; ?>
    </div>
</div>