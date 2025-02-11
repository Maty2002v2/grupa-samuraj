<script setup>
const props = defineProps(['articles']);
</script>

<template>
    <div>
        <h1>Articles</h1>

        <section>
            <h2>Add article</h2>
            <a :href="route('articles.create')">new</a>
        </section>

        <section>
            <h2>Our articles</h2>
            <article v-for="article in articles">
                <h3>{{ article.title }}</h3>
                <p>{{ article.content }}</p>
            </article>
        </section>
    </div>
</template>
