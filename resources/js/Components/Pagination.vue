<script setup>
const props = defineProps(['paginationlinks', 'currentPage']);
</script>

<template>
    <nav aria-label="navigation">
        <ul class="pagination pagination justify-content-end">
            <li class="page-item" v-for="(link, index) in props.paginationlinks">
                <a :class="['page-link', props.currentPage === index ? 'active' : '']" :href="link.url" v-html="link.label"></a>
            </li>
        </ul>
    </nav>
</template>
