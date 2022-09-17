<script>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
  books: {
    type: Object,
    default: () => ({}),
  },
});

const form = useForm({
  title: "",
  author: "",
  genre: "",
});

const submit = () => {
  form.post(route("books.store"));
};
</script>

<template>
  <Head title="Book Create" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Book Create
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <form>
              <div class="mb-6">
                <label
                  for="Title"
                  class="
                    block
                    mb-2
                    text-sm
                    font-medium
                    text-gray-900
                    dark:text-gray-300
                  "
                  >Title</label
                >
                <input
                  type="text"
                  v-model="form.title"
                  name="title"
                  class="
                    bg-gray-50
                    border border-gray-300
                    text-gray-900 text-sm
                    rounded-lg
                    focus:ring-blue-500 focus:border-blue-500
                    block
                    w-full
                    p-2.5
                  "
                  placeholder=""
                />
                <div v-if="form.errors.title" class="text-sm text-red-600">
                  {{ form.errors.title }}
                </div>
              </div>
              <div class="mb-6">
                <label
                  for="Author"
                  class="
                    block
                    mb-2
                    text-sm
                    font-medium
                    text-gray-900
                    dark:text-gray-300
                  "
                  >Author</label
                >
                <input
                  type="text"
                  v-model="form.author"
                  name="title"
                  class="
                    bg-gray-50
                    border border-gray-300
                    text-gray-900 text-sm
                    rounded-lg
                    focus:ring-blue-500 focus:border-blue-500
                    block
                    w-full
                    p-2.5
                  "
                  placeholder=""
                />
                <div v-if="form.errors.author" class="text-sm text-red-600">
                  {{ form.errors.author }}
                </div>
              </div>
              <div class="mb-6">
                <label
                  for="author"
                  class="
                    block
                    mb-2
                    text-sm
                    font-medium
                    text-gray-900
                    dark:text-gray-300
                  "
                  >Content</label
                >
                <textarea
                  type="text"
                  v-model="form.content"
                  name="content"
                  id=""
                  class="
                    bg-gray-50
                    border border-gray-300
                    text-gray-900 text-sm
                    rounded-lg
                    focus:ring-blue-500 focus:border-blue-500
                    block
                    w-full
                    p-2.5
                  "
                ></textarea>

                <div v-if="form.errors.content" class="text-sm text-red-600">
                  {{ form.errors.content }}
                </div>
              </div>

              <div class="mb-6">
                <label
                  for="Genre"
                  class="
                    block
                    mb-2
                    text-sm
                    font-medium
                    text-gray-900
                    dark:text-gray-300" >Genre</label>
                 
                <input
                  type="text"
                  v-model="form.genre"
                  name="genre"
                  class="
                    bg-gray-50
                    border border-gray-300
                    text-gray-900 text-sm
                    rounded-lg
                    focus:ring-blue-500 focus:border-blue-500
                    block
                    w-full
                    p-2.5
                  "
                  placeholder=""
                />
                <div v-if="form.errors.genre" class="text-sm text-red-600">
                  {{ form.errors.genre }}
                </div>
              </div>

              <div class="mb-6">
                <label
                  for="Isbn"
                  class="
                    block
                    mb-2
                    text-sm
                    font-medium
                    text-gray-900
                    dark:text-gray-300
                  "
                  >Isbn</label
                >
                <input
                  type="isbn"
                  v-model="form.isbn"
                  name="isbn"
                  class="
                    bg-gray-50
                    border border-gray-300
                    text-gray-900 text-sm
                    rounded-lg
                    focus:ring-blue-500 focus:border-blue-500
                    block
                    w-full
                    p-2.5
                  "
                  placeholder=""
                />
                <div v-if="form.errors.isbn" class="text-sm text-red-600">
                  {{ form.errors.isbn }}
                </div>
              </div>

                  <div class="mb-6">
                <label
                  for="Image"
                  class="
                    block
                    mb-2
                    text-sm
                    font-medium
                    text-gray-900
                    dark:text-gray-300
                  "
                  >Image Path</label
                >
                <input
                  type="text"
                  v-model="form.image_path"
                  name="image_path"
                  class="
                    bg-gray-50
                    border border-gray-300
                    text-gray-900 text-sm
                    rounded-lg
                    focus:ring-blue-500 focus:border-blue-500
                    block
                    w-full
                    p-2.5
                  "
                  placeholder=""
                />
                <div v-if="form.errors.image_path" class="text-sm text-red-600">
                  {{ form.errors.image_path }}
                </div>
              </div>

              <button
                type="submit"
                class="
                  text-white
                  bg-blue-700
                  focus:outline-none
                  font-medium
                  rounded-lg
                  text-sm
                  px-5
                  py-2.5
                "
                :disabled="form.processing"
                :class="{ 'opacity-25': form.processing }"
              >
                Submit
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>
