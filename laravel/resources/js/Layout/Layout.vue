<script>
import {Link} from "@inertiajs/vue3";

export default {
    components: {Link}
}
</script>

<template>
    <nav>
        <ul>
            <li><Link href="/">Home</Link></li>
            <li><Link href="/profiel">Profiel</Link></li>
        </ul>
    </nav>

    <main class="container mx-auto">
        <slot/>
    </main>
</template>

<style scoped>

</style>
