<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>{$title|default:'Eduity'} - {$name|default:'Workforce Planning'}</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="assets/css/font-lineicons.css" type="text/css" media="all" />
    <link rel="stylesheet" href="assets/css/animate.css" type="text/css" media="all" />
    <link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all" />
    {$css|default:''}
    <!--[if lt IE 9]>
        <script src="assets/js/html5.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body id="landing-page">

    <!-- Preloader -->
    <div id="mask">
        <div id="loader"></div>
    </div>
        
    <header>
        <nav class="navigation navigation-header">
            <div class="container">
                <div class="navigation-brand">
                    <div class="brand-logo">
						<a href="index.html" class="logo"></a>
						<span class="sr-only">eduity</span>
                    </div>
                    <button class="navigation-toggle visible-xs" type="button" data-toggle="dropdown" data-target=".navigation-navbar">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navigation-navbar">
                    <ul class="navigation-bar navigation-bar-left">
                        <li class="active"><a href="#hero">Home</a></li>
                        <li><a href="#process">Overview</a></li>
                        <li><a href="#levels">Levels</a></li>
						<!--<li><a href="#feedback">Testimonials</a></li>-->
						<li><a href="#team">About</a></li>
						<li><a href="#newsletter">Follow Us</a></li>
						<li><a href="{#base_url#}blog">Blog</a></li>
                    </ul>
                    <ul class="navigation-bar navigation-bar-right">
                        <li><a href="{#base_url#}login">Login</a></li>
                        <!--<li class="featured"><a href="register.html">Sign up</a></li>-->
                    </ul>  
                </div>
            </div>
        </nav>
    </header>