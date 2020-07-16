<template>
    <button
        type="button"
        :id="this.config.id"
        :class="this.config.class"
        @click="toggle"
    >
        <span class="navbar-toggler-icon"></span>
    </button>
</template>

<script>
    export default {
        props: ['config'],
        methods: {
            toggle() {
                this.$root.$emit(this.config.eventName);
            }
        }
    }
</script>
