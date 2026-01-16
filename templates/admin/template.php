<div class="wrapper">
    <?php //include __DIR__ . "/components/navbar.php"; 
    ?>
    <?php include __DIR__ . "/components/sidebar.php"; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 792px;">
        <?php include __DIR__ . "/views/" . $view; ?>
    </div>
    <!-- /.content-wrapper -->

    <?php include __DIR__ . "/components/control_sidebar.php"; ?>
    <?php include __DIR__ . "/components/footer.php"; ?>

</div>