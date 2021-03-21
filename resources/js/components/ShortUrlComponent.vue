<template>
    <div class="container">
        <h1>Url Shortener</h1>
        <div class="card">
            <div class="card-header">
                <form @submit.prevent="createShortLink">
                    <div class="form-group">
                        <label for="long_link">Long Link</label>
                        <input type="text" name="long_link" id="long_link" v-model="fields.long_link"
                               class="form-control"
                               placeholder="Type or past a long link">
                        <div v-if="errors && errors.long_link" class="text-danger">{{ errors.long_link[0] }}</div>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Shorten</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="alert alert-success" v-show="success">
                    <p>Shorten Link Generated Successfully!</p>
                </div>
                <table class="table table-bordered table-sm" v-show="showLink">
                    <thead>
                    <tr>
                        <th>Shorten Link</th>
                        <th>Long Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><a ref:shortenLink id="shorten-link" v-bind:href="linkShort" target="_blank" v-html="">{{ linkShort }}</a></td>
                        <td><a ref:longLink id="long-link" v-bind:href="linkLong" target="_blank" v-html="">{{ linkLong }}</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "ShortUrlComponent",
        data() {
            return {
                fields: {},
                errors: {},
                success: false,
                showLink: false,
                linkShort: '',
                linkLong: '',
            }
        },
        methods: {
            createShortLink() {
                this.errors = {};
                this.linkShort = '';
                this.linkLong = '';
                let longLink = this.fields.long_link;
                axios.post('/api/shortenLink', this.fields).then(response => {
                    if (response.status === 200 && response.statusText === 'OK') {
                        this.success = true;
                        this.showLink = true;
                        this.fields = {};
                        let code = response.data.code;
                        this.linkShort = window.location.origin + '/' + code;
                        this.linkLong = longLink;
                    }
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                        this.success = false;
                        this.showLink = false;
                    }
                })
                ;
            },
        },
    }
</script>

<style scoped>

</style>