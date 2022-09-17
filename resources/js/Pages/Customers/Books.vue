<style>
.form-control::placeholder {
    font-size: 0.95rem;
    color: #aaa;
    font-style: italic;
}
</style>
<script>
import { ref } from "vue";
import Pagination from '@/Components/Pagination.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import { watch } from "vue";

export default {
   components: {
    Pagination
  },

    props: {
        books: Object,
    },
    data() {
        return {
            search: null,
           
        };
    },
}
let search = ref('');
watch(search, (value) => {
  Inertia.get(
    "/searchBooks",
    { search: value },
    {
      preserveState: true,
    }
  );
  console.log("ww");
}); 


</script>

<template>
<head>
    <link rel="stylesheet" href="https://templates.iqonic.design/booksto/html/css/style.css">
    <link rel="stylesheet" href="https://templates.iqonic.design/booksto/html/css/responsive.css">
    <link rel="stylesheet" href="https://templates.iqonic.design/booksto/html/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://templates.iqonic.design/booksto/html/css/typography.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<layout title="Books">
    <div class="container mt-5">
        <h2 class="text-primary text-uppercase">Bookstore</h2>
        <img src="https://templates.iqonic.design/booksto/html/images/logo.png" class="img-fluid rounded-normal" alt="">
        <input type="text" placeholder="Search here..." aria-describedby="button-addon8" class="form-control" id="q" name="q" v-model="search">
        <!-- <div class="input-group-append mb-3">
            <button id="button-addon5" type="submit" class="btn btn-primary" > <i class="fa fa-search"> </i> </button>
        </div> -->

        <div class="iq-card-body">
            <div class="row">

                <div class="col-sm-6 col-md-4 col-lg-3" v-for="item in books.data" :key="item.id">
                    <div class="iq-card iq-card-block iq-card-stretch iq-card-height search-bookcontent">
                        <div class="iq-card-body p-0">
                            <div class="d-flex align-items-center">
                                <div class="col-6 p-0 position-relative image-overlap-shadow">
                                    <a href="javascript:void();">
                                        <img class="img-fluid rounded w-100" :src="item.image_path">
                                    </a>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-2">
                                        <h6 class="mb-2">{{ item.title }}</h6>
                                        <p class="font-size-13 line-height mb-3" style="width: 200px;">{{ item.author }}</p>

                                        <div class="d-block">
                                            <span class="font-size-13 text-warning">
                                                {{item.isbn}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="position-relative">
                                        <b>{{item.publication_date}}</b>
                                    </div>
                                    <div class="d-flex align-items-center" style="width: 200px;">
                                        Genre:
                                        <h6><b>{{ item.genre }}</b></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  <pagination class="mt-6" :links="books.links" />
            </div>
        </div>

    </div>
</layout>
</template>
