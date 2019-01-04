<footer id="footer">
    <div class="page">&copy; Copyright <?= date("Y"); ?> Jean Forteroche Tous droits réservés</div>
</footer>


<!-- JS Files -->
<?php if($redirectAccount): ?>
	<script>_getUserAct = true; _valableDue = <?= $userActualId; ?></script>
<?php endif; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?= PATH?>src/js/main.js?v=<?= time(); ?>"></script>