<div class="container why-indietorrent">
    <h4>Why indieTorrent?</h4>

    <p>
        The indieTorrent.org project provides an e-commerce framework that enables independent musicians to sell their own music while keeping all profits. Artists may join the indietorrent.org community free of charge, and are free to close their accounts at any time — no long-term contract, no fine-print. <a href="{$navData.url.10.alias}">Learn More &#187;</a>
    </p>
</div>

<footer class="container content-container rounded-corners container-container-border">
    <div class="row">
        <div class="col-sm-2">
            <div class="social-media-container">
                <div class="follow-us">
                    Follow Us
                </div>

                <ul class="social-media">
                    <li>
                        <i class="fa fa-rss-square"></i> <a href="https://forum.indietorrent.org/feed.php?mode=news">RSS Feed</a>
                    </li>
                    <li>
                        <i class="fa fa-facebook-square"></i> <a href="https://www.facebook.com/pages/indieTorrentorg/122218187797892">Facebook</a>
                    </li>
                    <li>
                        <i class="fa fa-twitter-square"></i> <a href="https://twitter.com/indietorrent">Twitter</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-sm-7 stat-container">
            <ul class="totals">
                {{-- todo: add dynamic data --}}
            </ul>
        </div>

        <div class="col-sm-3">
            <span class="newsletter-text">Get our Newsletter</span>

            {{-- todo: add "action" or ajax api request --}}
            <form class="form-inline newsletter" method="post" action="">
                <div class="form-group">
                    <div class="input-group">
                        <input name="email" type="text" class="form-control" placeholder="Enter your email">
                        <span class="input-group-btn">
							<button class="btn btn-success" type="submit">ok</button>
						</span>
                    </div><!-- /input-group -->
                </div>
            </form>
        </div>
    </div>
</footer>

<footer class="container content-container rounded-corners container-container-border short">
    <div class="row">
        <div class="col-sm-2 hidden-xs">
            <div class="grayscale-logo-container">
                <img class="grayscale-logo" src="{{asset('images/shell/indietorrent-logo-bw.svg')}}" alt="indieTorrent Logo (Grayscale and Faded)" />
            </div>
        </div>

        <div class="col-sm-6 hidden-xs">
            <ol class="breadcrumb">
                <li><a href="{$navData.url.131.alias}">Browse Music</a></li>
                <li><a href="{$navData.url.79.alias}">Sign-Up</a></li>
                <li><a href="{$navData.url.10.alias}">About</a></li>
                <li><a href="{$navData.url.23.alias}">Help</a></li>
                <li><a href="{$navData.url.2.alias}">Contact Us</a></li>
                <li><a href="{$navData.url.76.alias}">Sign In</a></li>
                <li><a href="{$navData.url.38.alias}">Privacy Policy</a></li>
                <li><a href="{$navData.url.42.alias}">Security Policy</a></li>
                <li><a href="{$navData.url.35.alias}#9a">DMCA Info</a></li>
            </ol>
        </div>

        <div class="col-sm-4">
            <div class="copyright">
                <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img class="cc-logo" src="{$ROOT}images/shell/cc-by-nc-nd.svg" alt="Creative Commons by-nc-nd Logo" /></a>
                <div class="copyright-text">
                    <ul>
                        <li>Copyleft 2008 - {$smarty.now|date_format:"%Y"} indieTorrent.org, LLC.</li>
                        <li>Some rights reserved.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

{include file='shell/foot-responsive.tpl'}
