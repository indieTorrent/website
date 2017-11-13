<template>
    <div class="featured-artist-container">
        <h3 class="featured-artist">Featured Artist - Pony Music</h3>

        <span class="genre"><i>Genre</i>: <a href="genre/167/">Liquid Dubstep</a></span>

        <a href="/catalog/albums/artist/1106/page/1/"><img class="featured-artist" src="images/home/featured-artist.jpg" alt="Featured Artist - Pony Music" /></a>

        <p class="roomier-margin">
            <i>Pony Music</i>, from Switzerland, is sending shockwaves through the <abbr title="Eletronic Dance Music">EDM</abbr> scene,
            garnering <a href="https://www.youtube.com/user/OfficialPonyMusic">over 144,000 plays on YouTube</a> in recent months.
            This unique act melds several genres ([Liquid] Dubstep, DnB, Glitch-Hop, and Electro) into a pulse-pounding
            journey across the electronic spectrum, while featuring some killer samples and
            beautifully-ethereal vocals. We talk one-on-one with the genius and gentleman behind the Pony,
            Roger Westermann, in an <a href="/interviews/2015/12/15/pony-music">exclusive interview with indieTorrent.org</a>.
        </p>

        <div class="panel panel-default">
            <div class="panel-heading">Featured Songs</div>

            <featured-songs></featured-songs>

        </div>
    </div>

</template>
<script>
    import breadcrumbs from 'Mixins/breadcrumbs';
    import { soundManager } from 'soundmanager2';

    import FeaturedSongs from 'Components/FeaturedSongs.vue';

    export default {
        mixins: [breadcrumbs],
        components: {
            FeaturedSongs,
        },
        created() {
            this.addBreadcrumb('/', 'Home');
        }
    }
</script>
<style>

</style>