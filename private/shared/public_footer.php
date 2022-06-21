<!-- Footer -->
<footer>
    <div class="row">
        <div class="col-lg-12">
            <p>Copyright &copy; <?php echo date('Y'); ?> Fionn Ross. Part of the original design concept for this page is from Kevin Skoglund.</p>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="<?php echo url_for('/assets/js/jquery.js'); ?>"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo url_for('/assets/js/bootstrap.min.js'); ?>"></script>

</body>

</html>
<?php
db_disconnect($db);
?>