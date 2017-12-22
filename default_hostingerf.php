<?
header('Content-Type: text/html; charset=utf-8');
$host = $_SERVER['HTTP_HOST'];
setlocale(LC_TIME, "in_IN.utf8");
date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Welcome to <? print $host; ?>!</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="http://www.main-hosting.com/hostinger/welcome/css/site.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="main">
    <div id="content">
        <div class="header">
            <a id="logo" href="http://www.hostinger.in/"><img src="http://www.main-hosting.com/hostinger/welcome/images/logo.png" alt="Web hosting" /></a>
        </div>
        <div class="content">
            <h1>Your account has been created!</h1>
            <p>Website <b><? print $host; ?></b> has been successfully installed on the server! Please delete the file <b>default.php</b> from the <b>public_html</b> folder and then upload your website by using FTP or File Manager.</p>
            <div class="clear"></div>
        </div>
        <div class="footer"></div>
        <div class="clear"></div>
    </div>
    <div id="footer">
        <div class="links">
            <a href="http://www.hostinger.in/web-hosting" target="_blank">Web Hosting</a>
            <span class="pipe">|</span>
            <a href="http://www.hostinger.in/free-hosting" target="_blank">Free Hosting</a>
            <span class="pipe">|</span>
            <a href="http://www.hostinger.in/forum" target="_blank">Support Forum</a>
            <span class="pipe">|</span>
            <a href="http://cpanel.hostinger.in/" target="_blank">Client Login</a>
        </div>
        <div class="copyright">Hostinger India &copy; <? print date('Y'); ?>. All rights reserved</div>
        <div class="social-icons">
            <a href="https://www.facebook.com/pages/Hostinger-India/515296155192316"><img src="http://www.main-hosting.com/hostinger/welcome/images/fb.gif" /></a>
            <a href="https://twitter.com/HostingerCOM"><img src="http://www.main-hosting.com/hostinger/welcome/images/twitter.gif" /></a>
        </div>
    </div>
</div>
</body>
</html>