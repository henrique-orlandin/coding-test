<!DOCTYPE html>
<html lang="en">
<head>

    <!-- meta -->
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <?php echo $template['metadata']; ?>

    <base href="<?php echo site_url(); ?>">

    <style media="all" rel="stylesheet">
        #overlayer {
            width:100%;
            height:100%;
            position:fixed;
            z-index:7100;
            background: white;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .loader {
            z-index:7700;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>

    <!-- fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link media="none" onload="if(media!='all')media='all'" rel="stylesheet" href="<?php echo $_siteUrls["baseCss"]."fonts/fontawesome/font-awesome.min.css"; ?>" />
    <!-- plugins CSS -->
    <link media="none" onload="if(media!='all')media='all'" rel="stylesheet" href="<?php echo $_siteUrls["basePlugins"]; ?>plugins.min.css">
    <!-- main -->
    <link media="none" onload="if(media!='all')media='all'" rel="stylesheet" href="<?php echo $_siteUrls["baseCss"]."style.min.css"; ?>" />
    <!-- custom -->
    <?php echo $template['metadataCss']; ?>

</head>
<body>

    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only"></span>
        </div>
    </div>

    <div class="site-wrap">

        <?php //echo $template['partials']['header']; ?>

        <main class="wrapper">

            <?php echo $template['body']; ?>

        </main>

        <?php //echo $template['partials']['footer']; ?>

    </div>

    <script type="text/javascript">
        var
            baseUrl = '<?php echo $this->config->base_url(); ?>',
            siteUrl = '<?php echo $this->config->site_url(); ?>',
            baseImg = '<?php echo $_siteUrls["baseImg"]; ?>',
            baseCss = '<?php echo $_siteUrls["baseCss"]; ?>',
            baseJs = '<?php echo $_siteUrls["baseJs"]; ?>';
            basePlugins = '<?php echo $_siteUrls["basePlugins"]; ?>';
            moduleImg = '<?php echo $_siteUrls["moduleImg"]; ?>';
            modulePhotos = '<?php echo $_siteUrls["modulePhotos"]; ?>';
    </script>

    <!-- plugins -->
    <script src="<?php echo $_siteUrls["basePlugins"]; ?>plugins.min.js"></script>
    <!-- mais -->
    <script src="<?php echo $_siteUrls["baseJs"]."main.min.js"; ?>"></script>
    <!-- custom -->
    <?php echo $this->_loadedAssets; ?>
    <?php echo $template['metadataJs']; ?>

</body>
</html>
