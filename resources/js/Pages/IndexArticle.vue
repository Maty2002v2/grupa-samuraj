<script setup>
import axios from 'axios';
import Swal from 'sweetalert2'
import { computed } from 'vue';
import Pagination from '../Components/Pagination.vue';

const props = defineProps(['articlesPaginate']);

const articles = computed(() => props.articlesPaginate.data);

const deleteArticle = async (id) => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    try {
        const alert = await Swal.fire({
            title: 'Wait',
            text: 'Are you sure you want to delete?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        });

        if (!alert.isConfirmed) return;

        const response = await axios.delete(`/articles/${id}`,
        {
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        await Swal.fire({
            title: 'Deleted!',
            text: response.data.message,
            icon: 'success'
        });

        // Refresh to update the view, it would also be possible to filter the current articles so that they do not contain the removed id
        window.location.reload();
    } catch(error) {
        Swal.fire({
            title: 'Error!',
            text: error.response.data.message,
            icon: 'error'
        });
    }
}
</script>

<template>
    <div class="container">
        <h1>Articles</h1>

        <section class="d-flex mt-5">
            <h2 class="m-0">Add article</h2>
            <a :href="route('articles.create')" class="btn btn-md btn-primary ms-3">new</a>
        </section>

        <section class="mt-5">
            <h2>Our articles</h2>

            <Pagination :paginationlinks="articlesPaginate.links" :currentPage="articlesPaginate.current_page" />

            <article v-for="article in articles" class="mt-3 shadow-sm p-3 mb-5 bg-light rounded">
                <h3>{{ article.title }}</h3>
                <p>{{ article.content }}</p>
                <p>
                    <a :href="route('articles.edit', article.id)">
                        <button class="btn btn-sm btn-primary">Edit</button>
                    </a>
                    <button class="btn btn-sm btn-danger ms-2" @click="deleteArticle(article.id)">Delete</button>
                </p>
            </article>
            <Pagination :paginationlinks="articlesPaginate.links" :currentPage="articlesPaginate.current_page" />
        </section>
    </div>
</template>
