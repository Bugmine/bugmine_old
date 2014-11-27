<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <link href="<?php echo base_url('assets/css/bootstrap-paper.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/prism.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">
        <title><?php echo $title; ?> - Bugmine</title>
    </head>
    <body>
        <div class="container">

            <!-- Static navbar -->
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?= site_url() ?>">Bugmine</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="<?php if ($active_controller == "/"): ?>
                                active
                                <?php endif; ?>"><a href="<?= site_url("") ?>">Project info</a>
                            </li>
                            <li class="<?php if ($active_controller == "tickets/"): ?>
                                    active
                                <?php endif; ?>"><a href="<?= site_url("tickets") ?>">Tickets</a>
                            </li>
                            <li class="<?php if ($active_controller == "newticket/"): ?>
                                    active
                                <?php endif; ?>"><a href="<?= site_url("newticket") ?>">New Ticket</a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="<?php if ($active_controller == "authentication/register"): ?>
                                    active
                                <?php endif; ?>"><a href="<?= site_url("authentication/register") ?>">Register</a>
                            </li>
                            <li class="<?php if ($active_controller == "authentication/login"): ?>
                                    active
                                <?php endif; ?>"><a href="<?= site_url("authentication/login") ?>">Login</a>
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
            </nav>
            <div class="container">