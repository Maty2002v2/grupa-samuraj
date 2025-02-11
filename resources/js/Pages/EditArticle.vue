<script setup>
import axios from 'axios';
import { ref } from 'vue';

const props = defineProps(['article']);

const title = ref(props.article.title);
const content= ref(props.article.content);
const errors = ref({});

const createArticle = async () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    errors.value = {};

    try {
        const response = await axios.post(`/articles/${props.article.id}`, {
            title: title.value,
            content: content.value
        },
        {
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        if (response.data.redirect) {
            window.location.href = response.data.redirect;
        }
    } catch(error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        }
    }
}
</script>

<template>
    <div class="container">
        <h1 class="mt-4">Edit</h1>
        <form method="post" @submit.prevent="createArticle" class="mt-5 needs-validation" novalidate>
            <div class="form-group">
                <label for="Title">Title</label>
                <input v-model="title" type="text" :class="['form-control', errors.title ? 'is-invalid' : '']" id="title" aria-describedby="titleHelp" required />
                <small id="titleHelp" class="form-text text-muted">Make sure the title is interesting.</small>
                <div v-if="errors.title">{{ errors.title[0] }}</div>
            </div>
            <div class="mt-4 form-group ">
                <label for="content">Content</label>
                <span v-if="errors.content">{{ errors.content[0] }}</span>
                <textarea v-model="content" :class="['form-control', errors.content ? 'is-invalid' : '']" id="content" rows="3" maxlength="2000" required></textarea>
            </div>
            <button type="submit" class="mt-4 btn btn-primary">Submit</button>
        </form>
    </div>
</template>
