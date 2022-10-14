<template>
    <div>
        This is the welcome page!

        <p>{{ $page.props.appName }}</p>

        <Link href="/another">Another</Link>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'




export default{
    components: {
        Link
    }
}
</script>
