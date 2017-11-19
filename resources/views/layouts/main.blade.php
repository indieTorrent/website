<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head-meta')

<body>
<div id="app">
    <div class="bg"></div>

    <div id="main-content" class="container content-container rounded-corners">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div id="container-account-and-cart-info">
                <div class="container-fluid container-primary-nav">

                    {{-- site stats component --}}
                    <site-stats></site-stats>

                    {{-- top nav login form --}}
                    @include('layouts.partials.top-login')


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
        </div>
    </div> <!-- /container -->

    @include('layouts.partials.footer')

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
