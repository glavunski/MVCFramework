<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="/content/styles.css" />
    <title><?php echo htmlspecialchars($this->title) ?></title>
</head>

<body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">My Blog</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php if (!$this->auth->isLoggedIn()): ?>
                        <li>
                            <a href="/login">Login</a>
                        </li>
                        <li>
                            <a href="/register">Register</a>
                        </li>
                        <?php endif ?>
                        <?php if ($this->auth->isAdmin()): ?>
                        <li>
                            <a href="/admin">Admin</a>
                        </li>
                        <?php endif ?>
                    </ul>
                    <?php if ($this->auth->isLoggedIn()): ?>
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#"><?php echo $this->auth->get_logged_user()[0]; ?></a>
                        </li>
                        <li>
                            <a href="/posts/create">New Post</a>
                        </li>
                        <li>
                            <a href="/logout">Logout</a>
                        </li>
                    </ul>
                    <?php endif ?>
                </div>
            </div>
        </nav>
    <?php include_once('views/layouts/messages.php'); ?>
