<?php
get_header();
?>
    <div class="wrapper" id="wrapper-404">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title">
                        <h1>404 Error - Page Not Found</h1>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="container">
            <div class="row">
                <div class="col-12">
                    <main class="site-main" id="main">
                        <p>Oops… something hasn’t quite gone right!</p>
                        <p>The page you were looking for doesn't exist anymore or might have been moved.</p>
                        <p>Please try the following:</p>
                        <ul>
                            <li>If you typed the page address in the address bar, make sure it is spelled correctly.</li>
                            <li>Open the <a href="<?=get_home_url()?>"><?=substr(get_home_url(), strpos(get_home_url(), '://') + 3)?></a> home page, and then look for links to information you want.</li>
                            <li>Click the <a href="javascript:history.back(1)">back</a> button to try another link.</li>
                        </ul>
                        <p>Or try a search below</p>
                        <?=get_search_form()?>
                    </main><!-- #main -->
                </div>
            </div><!-- .row -->
        </div><!-- #content -->
    </div>
<?php get_footer(); ?>