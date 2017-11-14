<template>
    <div id="featured-songs">
        <ul v-for="song in songs" class="featured-songs">
            <li class="play">
                <i :id="`audioPreview${song.id}`"
                   class="fa fa-play-circle-o audio-preview-play"
                   :data-player-id="`audioPreview${song.id}`">

                </i>
            </li>
            <li class="title">{{song.name}} <span class="play-time">(song.fileData.playTimeString)</span></li>
            <li class="price">${{song.sku.price}}</li>
            <li class="add">
                <button @click="addToCart(song.sku.id)" class="btn btn-custom">
                    <i class="fa fa-plus"></i> Add to Cart
                </button>
            </li>
        </ul>
    </div>
</template>
<script>
    import { soundManager } from 'soundmanager2';
    require('Resources/assets/js/songs');

    export default {
        data() {
            return {
                songs: []
            }
        },
        watch: {
            songs() {
                if(this.songs.length > 0) {
                    soundManager.setup({
                        url: '/assets/sound-manager-2/swf/',

                        flashVersion: 9, // optional: shiny features (default = 8)
                        // optional: ignore Flash where possible, use 100% HTML5 mode
                        // preferFlash: false,

                        onready() {
                            // SM2 has started - now you can create and play sounds!

                            // Featured Songs
                            _.each(this.songs, (song) => {
                                let el = $(`#audioPreview${song.id}`);

                                soundManager.createSound({
                                    id: `audioPreview${song.id}`, // optional: provide your own unique id
                                    url: `https://cdn.indiehosting.org/public_media/mp3_preview/${song.id}.mp3`,

                                    // todo: lets do this jQuery stuff in a Vue way -mike

                                    onfinish() {
                                        el.removeClass('fa-pause playing').addClass('fa-play-circle-o');
                                    },

                                    whileloading() {
                                        el.removeClass('playing').addClass('loading');
                                    },

                                    whileplaying() {
                                       el.removeClass('loading').addClass('playing');
                                    }
                                });
                            });
                        },

                        // optional: ontimeout() callback for handling start-up failure

                        ontimeout: function () {

                            // Hrmm, SM2 could not start. Missing SWF? Flash blocked? No HTML5 audio support? Show an error, etc.?
                            // See the flashblock demo when you want to start getting fancy.

                        }
                    });
                }
            }
        },
        methods: {
            getFeaturedSongs() {
                // todo: examples of api featured endpoints below -mike
                // 'api/featured/artists'
                // 'api/fetaured/albums'
                // 'api/featured/songs'

                axios.get('api/featured/songs').then((response) => {
                    this.songs = response.data;
                }).catch((error) => {
                    // todo: create standard error responses to follow this pattern -mike
                    //alert(`Error: ${error.response}`)
                });
            },
            addToCart(sku_id) {
                // todo: make ajax request to add song to cart by 'songs.sku.id' -mike
            }
        },
        created() {
            this.getFeaturedSongs();
        }
    }
</script>
