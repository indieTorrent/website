<template>
    <div id="site-stats" class="navbar-element-group">
        <div class="site-stat"><strong>{{num_accounts}}</strong> customers have created accounts.</div>
        <div class="site-stat">Fans have spent <strong>${{sum_spent}}</strong> on music.</div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                num_accounts: 0,
                sum_spent: ''
            }
        },
        methods: {
            getAccounts() {
                axios.get('accounts').then((response) => {
                    // todo: count the returned collection of objects
                    // this.num_accounts = response.data.length;
                    this.num_accounts = 2000;
                }).catch((error) => {

                });
            },
            getTotalSpent() {
                axios.get('imnotsure').then((response) => {
                    // todo: do logic for this .. haha
                    this.sum_spent = 6000;
                }).catch((error) => {

                });
            },
        },
        created() {
            this.getAccounts();
            this.getTotalSpent();
        }
    }
</script>