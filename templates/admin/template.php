<div class="wrapper">
    <?php //include __DIR__ . "/components/navbar.php"; 
    ?>
    <?php include __DIR__ . "/utils/elementsGenerator.php"; ?>
    <?php include __DIR__ . "/components/sidebar.php"; ?>
    <div class="content-wrapper" style="min-height: 792px; max-width: 95.5vw;">
        <?php include __DIR__ . "/views/" . $view; ?>
    </div>
    <?php include __DIR__ . "/components/control_sidebar.php"; ?>
    <?php include __DIR__ . "/components/footer.php"; ?>

</div>