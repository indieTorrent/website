<template>
    <div id="account-info-and-links">
        <div class="navbar-element-group account-and-cart-info">
            <div v-if="emulated">
                You are currently <strong>emulating</strong> &quot;{{user.username}}&quot;.
                <a href="#">Switch back to {{user.name}}</a>
            </div>
            <div v-else-if="authenticated">
               | Logged-In as &quot;<strong>{{user.username}}</strong>&quot;

                <span id="my-account-and-log-out-links">
                    <a href="/my-account">
                        <i class="fa fa-user"></i> my account
                    </a>
                   | <a href="/logout">
                        <i class="fa fa-sign-out"></i> Log Out
                    </a>
                </span>
            </div>

            <a href="/my-cart">
                <i class="fa fa-shopping-cart"></i> Shopping Cart
            </a>
            ({{num_cart_items}} Items, ${{cart_total}})
        </div>

        <div v-if="last_order_id">
            <div class="navbar-element-group auxiliary-links">
                <a href="#">Download Newly-Purchased Songs</a>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                emulated: false,
                authenticated: false,
                user: {
                    username: '',
                    name: ''
                },
                num_cart_items: 0,
                last_order_id: null
            }
        },
        methods: {
            getAccountInfo() {
                axios.get('api/account').then((response) => {

                }).catch((error) => {

                });
            }
        }
    }
</script>