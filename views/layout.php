<?php

/* @var \Symfony\Component\Translation\Translator $locale */
/* @var String                                    $appName */

?>

<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title><?php echo $appName ?></title>
    <link rel="stylesheet" href="css/normalize.min.css" />
    <link rel="stylesheet" href="css/foundation.min.css" />
    <link rel="stylesheet" href="css/screen.css" />
    <link rel="stylesheet" href="css/icons/general_enclosed_foundicons.css" />
    <link rel="stylesheet" href="css/icons/general_enclosed_foundicons_ie7.css" />
    <script src="index.php/assets/js"></script>
</head>
<body class="antialiased">

<div id="ajax-loader"></div>

<script type="text/template" id="navigation-template">
    <nav class="top-bar">
        <section class="top-bar-section">
            <ul class="left list"></ul>
            <ul class="right">
                <li class="has-form">
                    <div class="row collapse">
                        <div class="small-10 columns">
                            <form>
                                <input type="text" required />
                            </form>
                        </div>
                        <div class="small-2 text-center columns">
                            <i class="foundicon-plus add" data-key="c"></i>
                            <i class="foundicon-remove cancel"></i>
                        </div>
                    </div>
                </li>
            </ul>
        </section>
    </nav>
</script>


<script type="text/template" id="card-template">
    <a href="#card/<%- id %>"><%- name %></a>
</script>


<script type="text/template" id="app">
    <div class="navigation"></div>

    <div class="row">
        <div class="small-10 large-10 large-centered small-centered columns">

            <div class="form"></div>
            <div class="list"></div>
            <footer></footer>

            <div id="app-loader"></div>
        </div>
    </div>
</script>


<script type="text/template" id="form-template">
    <form id="add-task" class="custom">
        <div class="row collapse">
            <div class="small-11 columns">
                <input type="text" class="name" placeholder="<?php echo $locale->trans('new-task') ?>" data-key="n" required />
            </div>
            <div class="small-1 columns">
                <input type="submit" class="button prefix secondary" value="+" />
            </div>
        </div>
    </form>
</script>


<script type="text/template" id="list-template">
    <form class="custom list"></form>
    <div class="row no-tasks">
        <div class="small-12 columns">
            <?php echo $locale->trans('no-tasks') ?>
        </div>
    </div>
</script>


<script type="text/template" id="task-template">
    <div class="row task">
        <div class="small-10 columns">
            <label>
                <span class="custom checkbox"></span>
                <span class="name"><%- name %></span>
            </label>
            <form>
                <input type="text" class="name" required />
            </form>
        </div>
        <div class="small-2 columns actions">
            <i class="foundicon-remove cancel"></i>
            <i class="foundicon-edit update"></i>
            <i class="foundicon-trash delete"></i>
        </div>
    </div>
</script>


<script type="text/template" id="footer-template">
    Dingbat 0.4.0.1 -
    <a href="https://github.com/pklink/Dingbat" target="_blank">pow</a>,
    <a href="https://sourceforge.net/projects/dingbat/" target="_blank">pow</a>, pow!
</script>


<script type="text/template" id="sidebar-template">
    <div id="sidebar">
        <div class="icons">
            <i class="foundicon-idea help" data-key="h"></i>
        </div>
        <div class="content help">
            <h3><?php echo $locale->trans('shortcut') ?></h3>
            <p><?php echo $locale->trans('priority-desc') ?></p>
            <p><?php echo $locale->trans('priority-default') ?></p>
            <p><?php echo $locale->trans('priority-done') ?></p>

            <h3><?php echo $locale->trans('hints') ?></h3>
            <p><?php echo $locale->trans('hint-dbl-click') ?></p>
            <p><?php echo $locale->trans('hint-new-task') ?></p>
            <p><?php echo $locale->trans('hint-new-card') ?></p>
            <p><?php echo $locale->trans('hint-help') ?></p>
            <p><?php echo $locale->trans('hint-cancel') ?></p>
            <p><?php echo $locale->trans('hint-save') ?></p>
        </div>
        <br style="clear: both" />
    </div>
</script>

<noscript>
    <div class="noscript row">
        <div class="small-12 large-12 text-center columns">c'mon... javascript... enable it... pow! roflcopter! pow!</div>
    </div>
</noscript>

</body>
</html>