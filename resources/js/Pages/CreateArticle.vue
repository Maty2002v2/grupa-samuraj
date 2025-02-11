<script setup>
import axios from 'axios';
import { ref } from 'vue';

const title = ref();
const content= ref();
const errors = ref({});

const createArticle = async () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    errors.value = {};

    try {
        const responseJSON = await axios.post('/articles', {
            title: title.value,
            content: content.value
        },
        {
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        const response = await responseJSON.json();

        if (response.redirect) {
            window.location.href = response.redirect;
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
