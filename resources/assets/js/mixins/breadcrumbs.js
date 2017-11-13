export default {
    methods: {
        addBreadcrumb(path, text) {
            this.$root.breadcrumbs.push({
                path: path,
                text: text
            });
        }
    }
}