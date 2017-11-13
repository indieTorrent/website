<!DOCTYPE html>
<html lang="en">
{{-- todo: break this layout up into partials and Vue Components where possible -mike --}}
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="57x57" href="/images/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/images/favicons/favicon-194x194.png" sizes="194x194">
    <link rel="icon" type="image/png" href="/images/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/images/favicons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/images/favicons/manifest.json">
    <link rel="mask-icon" href="/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#cbef4f">
    <meta name="msapplication-TileImage" content="/images/favicons/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic'
          rel='stylesheet'
          type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,800italic,300,600,800,400'
          rel='stylesheet'
          type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Noto+Serif:400,700,400italic,700italic'
          rel='stylesheet'
          type='text/css'>

    <title>@yield('title')</title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="css/app.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="app">
    <div class="bg"></div>

    <div id="main-content" class="container content-container rounded-corners">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div id="container-account-and-cart-info">
                <div class="container-fluid container-primary-nav">
                    <div id="site-stats" class="navbar-element-group">


                        <div class="site-stat"><strong>3638</strong> customers have created accounts.</div>
                        <div class="site-stat">Fans have spent <strong>$6203.66</strong> on music.</div>

                    </div>


                    <form id="navbar-login-form" class="navbar-form navbar-right" method="post" action="/login/">
                        <div class="form-group">
                            <input id="login-username" class="form-control" name="username" type="text" value=""
                                   placeholder="Username" maxlength="255"/>
                        </div>
                        <div class="form-group">
                            <input id="login-password" class="form-control" name="password" type="password" value=""
                                   placeholder="Password" maxlength="255"/>
                        </div>

                        <input type="hidden" name="action" value="logIn"/>
                        <input type="hidden" name="nextPage" value=""/>

                        <button id="global-sign-in-button" type="submit" class="btn btn-success">Sign in</button>
                    </form>


                    <div id="account-info-and-links">
                        <div class="navbar-element-group account-and-cart-info">

                            <a href="/cart/"><i class="fa fa-shopping-cart"></i> Shopping Cart</a> (0 Items, $0.00)
                        </div>

                    </div>
                </div>
            </div>

            <div class="container-fluid container-primary-nav primary-nav">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand indietorrent-logo" href="/"><img src="/images/shell/indietorrent-logo.png"
                                                                            alt="indieTorrent.org Logo"/></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false">Music <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/catalog/">Search or Browse</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/catalog/artists/page/1/">Artists</a></li>
                                <li><a href="/catalog/albums/page/1/">Albums</a></li>
                                <li><a href="/catalog/labels/page/1/">Labels</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/catalog/genres/">All Genres</a></li>
                                <li role="separator" class="divider"></li>
                                <li class="dropdown-header">Popular Genres</li>
                                <li><a href="/catalog/albums/genre/96/">Other</a></li>
                                <li><a href="/catalog/albums/genre/48/">Electronic</a></li>
                                <li><a href="/catalog/albums/genre/8/">Ambient</a></li>
                                <li><a href="/catalog/albums/genre/117/">Rock</a></li>
                            </ul>
                        </li>
                        <li><a href="/auxiliary/create-account/">Sign-Up</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false">About <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/docs/">General Info</a></li>
                                <li role="separator" class="divider"></li>
                                <li class="dropdown-header">The Project</li>
                                <li><a href="/docs/manifesto/">Manifesto</a></li>
                                <li role="separator" class="divider"></li>
                                <li class="dropdown-header">The Website</li>
                                <li><a href="/docs/terms-of-use/">Terms of Use</a></li>
                                <li><a href="/docs/privacy-policy/">Privacy Policy</a></li>
                                <li><a href="/docs/online-security-policy/">Online Security Policy</a></li>
                                <li role="separator" class="divider"></li>
                                <li class="dropdown-header">The Company</li>
                                <li><a href="/legal/">Legal Information</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-haspopup="true"
                               aria-expanded="false">Help <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/docs/faq/">FAQs</a></li>
                                <li><a href="https://forum.indietorrent.org">Community Forum</a></li>
                                <li><a href="/tutorials/">Tutorials</a></li>
                                <li role="separator" class="divider"></li>
                                <li class="dropdown-header">Audio Tools</li>
                                <li><a href="/auxiliary/flac-validator/">FLAC &amp; WAV Validator</a></li>
                            </ul>
                        </li>
                        <li><a href="/contact/">Contact Us</a></li>
                        <li><a href="/login/">Sign In</a></li>
                        <li><a href="/donate/">Donate!</a>
                    </ul>
                    <form id="global-search-form-container" class="navbar-form navbar-right" method="get"
                          action="/catalog/"
                          role="search">
                        <div id="global-search-form" class="form-group">
                            <input name="q" type="text" class="form-control" placeholder="Search">
                        </div>
                        <button id="global-search-button" type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div id="breadcrumb-container"
             class="breadcrumb-container rounded-corners rounded-corners-top-only inner-box-shadow-bottom">
            <ul class="breadcrumb-item-container">
                <li><i class="fa fa-compass fa-2x"></i> You are here:</li>
                <li v-for="bc in breadcrumbs">
                    <a :href="bc.path" class="linksNav">@{{ bc.text }}</a>
                </li>
            </ul>
        </div>

        <a class="anchor" id="top-of-page">Top of Page</a>

        <div class="row">
            <div class="col-md-8">
                <div class="grid-item-container clearfix">

                    @yield('page-content')

                </div>
            </div>
            <div class="col-md-4">
                <div class="grid-item-container">
                    {{-- todo: create TopFiveArtists.vue -mike --}}
                    <div class="top-artists-albums-container">
                        <h3 class="featured-label">Top 5 <span class="skinny">Artists</span></h3>

                        <div class="featured-album-container">
                            <div class="featured-album">
                                <div class="featured-album-item">
                                    <div class="featured-rank">
                                        <a href="/catalog/albums/artist/504/page/1/">1</a>
                                    </div>

                                    <div class="album-component-group proper-float">
                                        <div class="image-container">
                                            <a href="/catalog/albums/artist/504/page/1/">
                                                <img class="featured-image"
                                                     src="https://cdn.indiehosting.org/images/library/b8/504-b862f2-artist-photo-thumb.jpg"
                                                     alt="Photo of SOL SEPPY"/>
                                            </a>
                                        </div>

                                        <div>
                                            <div class="album">
                                                <a class="album-title" href="/catalog/albums/artist/504/page/1/">SOL
                                                    SEPPY</a>
                                                <br/>
                                                <span class="genre">
										<span class="genre-label">Genre</span> <a
                                                            href="/catalog/albums/genre/96/page/1/"
                                                            class="genre-link">Other</a>
									</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-album">
                                <div class="featured-album-item">
                                    <div class="featured-rank">
                                        <a href="/catalog/albums/artist/19/page/1/">2</a>
                                    </div>

                                    <div class="album-component-group proper-float">
                                        <div class="image-container">
                                            <a href="/catalog/albums/artist/19/page/1/">
                                                <img class="featured-image"
                                                     src="https://cdn.indiehosting.org/images/library/39/19-3909a4-artist-photo-thumb.jpg"
                                                     alt="Photo of Alpha Rev"/>
                                            </a>
                                        </div>

                                        <div>
                                            <div class="album">
                                                <a class="album-title" href="/catalog/albums/artist/19/page/1/">Alpha
                                                    Rev</a>
                                                <br/>
                                                <span class="genre">
										<span class="genre-label">Genre</span> <a
                                                            href="/catalog/albums/genre/73/page/1/"
                                                            class="genre-link">Indie</a>
									</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-album">
                                <div class="featured-album-item">
                                    <div class="featured-rank">
                                        <a href="/catalog/albums/artist/164/page/1/">3</a>
                                    </div>

                                    <div class="album-component-group proper-float">
                                        <div class="image-container">
                                            <a href="/catalog/albums/artist/164/page/1/">
                                                <img class="featured-image"
                                                     src="https://cdn.indiehosting.org/images/library/30/164-30d64a-artist-photo-thumb.jpg"
                                                     alt="Photo of Analog Rebellion"/>
                                            </a>
                                        </div>

                                        <div>
                                            <div class="album">
                                                <a class="album-title" href="/catalog/albums/artist/164/page/1/">Analog
                                                    Rebellion</a>
                                                <br/>
                                                <span class="genre">
										<span class="genre-label">Genre</span> <a
                                                            href="/catalog/albums/genre/73/page/1/"
                                                            class="genre-link">Indie</a>
									</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-album">
                                <div class="featured-album-item">
                                    <div class="featured-rank">
                                        <a href="/catalog/albums/artist/90/page/1/">4</a>
                                    </div>

                                    <div class="album-component-group proper-float">
                                        <div class="image-container">
                                            <a href="/catalog/albums/artist/90/page/1/">
                                                <div class="album-cover album-cover-placeholder small border"></div>
                                            </a>
                                        </div>

                                        <div>
                                            <div class="album">
                                                <a class="album-title" href="/catalog/albums/artist/90/page/1/">Charles
                                                    Bates</a>
                                                <br/>
                                                <span class="genre">
										<span class="genre-label">Genre</span> <a href="/catalog/albums/genre/5/page/1/"
                                                                                  class="genre-link">Acoustic</a>
									</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-album">
                                <div class="featured-album-item">
                                    <div class="featured-rank">
                                        <a href="/catalog/albums/artist/13/page/1/">5</a>
                                    </div>

                                    <div class="album-component-group proper-float">
                                        <div class="image-container">
                                            <a href="/catalog/albums/artist/13/page/1/">
                                                <img class="featured-image"
                                                     src="https://cdn.indiehosting.org/images/library/d9/13-d9992f-artist-photo-thumb.jpg"
                                                     alt="Photo of Vialka"/>
                                            </a>
                                        </div>

                                        <div>
                                            <div class="album">
                                                <a class="album-title"
                                                   href="/catalog/albums/artist/13/page/1/">Vialka</a>
                                                <br/>
                                                <span class="genre">
										<span class="genre-label">Genre</span> <a
                                                            href="/catalog/albums/genre/150/page/1/" class="genre-link">Turbo Folk Micro-Orchestra</a>
									</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- todo: create TopFiveAlbums.vue -mike --}}
                    <div class="top-artists-albums-container">
                        <h3 class="featured-label">Top 5 <span class="skinny">Albums</span></h3>

                        <div class="featured-album-container">
                            <div class="featured-album">
                                <div class="featured-album-item">
                                    <div class="featured-rank">
                                        <a href="/catalog/songs/album/703/">1</a>
                                    </div>

                                    <div class="album-component-group proper-float">
                                        <div class="image-container">
                                            <a href="/catalog/songs/album/703/">
                                                <img class="featured-image"
                                                     src="https://cdn.indiehosting.org/images/library/0d/703-0dc9a7-album-cover-thumb.jpg"
                                                     alt="SOL SEPPY - The Bells Of 1 2 Cover Art"/>
                                            </a>
                                        </div>
                                        <div class="album">
                                            <a class="album-title" href="/catalog/songs/album/703/">The Bells Of 1 2 -
                                                SOL
                                                SEPPY</a>
                                            <br/>
                                            <span class="genre">
									<span class="genre-label">Genre</span> <a href="/catalog/albums/genre/96/page/1/"
                                                                              class="genre-link">Other</a>
								</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-album">
                                <div class="featured-album-item">
                                    <div class="featured-rank">
                                        <a href="/catalog/songs/album/702/">2</a>
                                    </div>

                                    <div class="album-component-group proper-float">
                                        <div class="image-container">
                                            <a href="/catalog/songs/album/702/">
                                                <img class="featured-image"
                                                     src="https://cdn.indiehosting.org/images/library/81/702-81d5d5-album-cover-thumb.jpg"
                                                     alt="SOL SEPPY - The Bird Calls, and Its Song Awakens the Air, and I Call Cover Art"/>
                                            </a>
                                        </div>
                                        <div class="album">
                                            <a class="album-title" href="/catalog/songs/album/702/">The Bird Calls, and
                                                Its
                                                Song Awakens the Air, and I Call - SOL SEPPY</a>
                                            <br/>
                                            <span class="genre">
									<span class="genre-label">Genre</span> <a href="/catalog/albums/genre/96/page/1/"
                                                                              class="genre-link">Other</a>
								</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-album">
                                <div class="featured-album-item">
                                    <div class="featured-rank">
                                        <a href="/catalog/songs/album/342/">3</a>
                                    </div>

                                    <div class="album-component-group proper-float">
                                        <div class="image-container">
                                            <a href="/catalog/songs/album/342/">
                                                <img class="featured-image"
                                                     src="https://cdn.indiehosting.org/images/library/a7/342-a76f24-album-cover-thumb.jpg"
                                                     alt="Analog Rebellion - Dogs Are Better Than Cats Cover Art"/>
                                            </a>
                                        </div>
                                        <div class="album">
                                            <a class="album-title" href="/catalog/songs/album/342/">Dogs Are Better Than
                                                Cats - Analog Rebellion</a>
                                            <br/>
                                            <span class="genre">
									<span class="genre-label">Genre</span> <a href="/catalog/albums/genre/73/page/1/"
                                                                              class="genre-link">Indie</a>
								</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-album">
                                <div class="featured-album-item">
                                    <div class="featured-rank">
                                        <a href="/catalog/songs/album/89/">4</a>
                                    </div>

                                    <div class="album-component-group proper-float">
                                        <div class="image-container">
                                            <a href="/catalog/songs/album/89/">
                                                <img class="featured-image"
                                                     src="/images/catalog/cover-placeholder-thumb.jpg"
                                                     alt="Charles Bates (CharlieOver9000) - Just Me Cover Art"/>
                                            </a>
                                        </div>
                                        <div class="album">
                                            <a class="album-title" href="/catalog/songs/album/89/">Just Me - Charles
                                                Bates</a>
                                            <br/>
                                            <span class="genre">
									<span class="genre-label">Genre</span> <a href="/catalog/albums/genre/5/page/1/"
                                                                              class="genre-link">Acoustic</a>
								</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-album">
                                <div class="featured-album-item">
                                    <div class="featured-rank">
                                        <a href="/catalog/songs/album/145/">5</a>
                                    </div>

                                    <div class="album-component-group proper-float">
                                        <div class="image-container">
                                            <a href="/catalog/songs/album/145/">
                                                <img class="featured-image"
                                                     src="https://cdn.indiehosting.org/images/library/b1/145-b1e9ae-album-cover-thumb.jpg"
                                                     alt="Alpha Rev - Limited Releases (Blue Songs) Cover Art"/>
                                            </a>
                                        </div>
                                        <div class="album">
                                            <a class="album-title" href="/catalog/songs/album/145/">Limited Releases -
                                                Alpha
                                                Rev</a>
                                            <br/>
                                            <span class="genre">
									<span class="genre-label">Genre</span> <a href="/catalog/albums/genre/73/page/1/"
                                                                              class="genre-link">Indie</a>
								</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>    </div> <!-- /container -->

    <div class="container why-indietorrent">
        <h4>Why indieTorrent?</h4>

        <p>
            The indieTorrent.org project provides an e-commerce framework that enables independent musicians to sell
            their
            own music while keeping all profits. Artists may join the indietorrent.org community free of charge, and are
            free to close their accounts at any time — no long-term contract, no fine-print. <a href="/docs/">Learn More
                &#187;</a>
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
                            <i class="fa fa-rss-square"></i> <a
                                    href="https://forum.indietorrent.org/feed.php?mode=news">RSS
                                Feed</a>
                        </li>
                        <li>
                            <i class="fa fa-facebook-square"></i> <a
                                    href="https://www.facebook.com/pages/indieTorrentorg/122218187797892">Facebook</a>
                        </li>
                        <li>
                            <i class="fa fa-twitter-square"></i> <a href="https://twitter.com/indietorrent">Twitter</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-sm-7 stat-container">
                <ul class="totals">
                    <li>
                        Total Albums
                        <div class="stat-value">280</div>
                    </li>
                    <li>
                        Total Tracks
                        <div class="stat-value">2.6<span class="stat-total-unit">K</span></div>
                    </li>
                    <li>
                        Total Downloads
                        <div class="stat-value">2<span class="stat-total-unit">K</span></div>
                    </li>


                </ul>
            </div>

            <div class="col-sm-3">
                <span class="newsletter-text">Get our Newsletter</span>

                <form class="form-inline newsletter" method="post" action="/newsletter-signup/">
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
                    <img class="grayscale-logo" src="/images/shell/indietorrent-logo-bw.svg"
                         alt="indieTorrent Logo (Grayscale and Faded)"/>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <ol class="breadcrumb">
                    <li><a href="/catalog/">Browse Music</a></li>
                    <li><a href="/auxiliary/create-account/">Sign-Up</a></li>
                    <li><a href="/docs/">About</a></li>
                    <li><a href="/help/">Help</a></li>
                    <li><a href="/contact/">Contact Us</a></li>
                    <li><a href="/login/">Sign In</a></li>
                    <li><a href="/docs/privacy-policy/">Privacy Policy</a></li>
                    <li><a href="/docs/online-security-policy/">Security Policy</a></li>
                    <li><a href="/docs/terms-of-use/#9a">DMCA Info</a></li>
                </ol>
            </div>

            <div class="col-sm-4">
                <div class="copyright">
                    <a href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img class="cc-logo"
                                                                                     src="/images/shell/cc-by-nc-nd.svg"
                                                                                     alt="Creative Commons by-nc-nd Logo"/></a>
                    <div class="copyright-text">
                        <ul>
                            <li>Copyleft 2008 - 2017 indieTorrent.org, LLC.</li>
                            <li>Some rights reserved.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- END VUE APP CONTAINER --}}
</div>

<script src="js/app.js"></script>

<script>

    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {

            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),

            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)

    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');


    ga('create', 'UA-2800180-3', 'indietorrent.org');

    ga('send', 'pageview');

</script>

@yield('scripts')
</body>
</html>
