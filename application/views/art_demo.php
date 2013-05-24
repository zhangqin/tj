<!DOCTYPE HTML>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="<?php echo base_url();?>js/artDialog/skins/blue.css" type="text/css"/>
    </head>
    <body>
        <a href="#"  onclick="myArt1.addContent('hello world').addWidth('400px').addHeight('400px').addTime(4).dialog();">跟踪</a>
        <script src="<?php echo base_url();?>js/artDialog/artDialog.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>js/artDialog/plugins/iframeTools.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>js/artDialog/art.class.js" type="text/javascript"></script>
        <script>
            var myArt2 = new myArt();
            myArt2.addUrl('<?php echo base_url();?>js/artDialog/_doc/login_iframe.html').addTime(2).open();
            var myArt1 = new myArt();
        </script>
    </body>
</html>
