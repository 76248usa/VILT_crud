<template>
    <div>
        This is another page!

        <p>{{ $page.props.appName }}</p>

        <Link href="/">Welcome page</Link>
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
