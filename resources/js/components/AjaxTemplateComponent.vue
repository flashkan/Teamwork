<template>
    <div>
        <button id="some">User Email</button>
        <slot>
            {{ data }}
        </slot>
    </div>
</template>
<script>
    export default {
        props: ['url'],
        data() {
            return {
                data: null
            }
        },
        mounted() {
            let btn = document.querySelector('#some');
            btn.addEventListener('click', () => {
                axios
                    .post(this.url, {a: 1, b: 2})
                    .then(response => {
                        if (response.status === 200) {
                            return response.data;
                        }
                    })
                    .then((data) => {
                        this.data = data;
                    })
            })
        },

        methods: {},
    }
</script>
