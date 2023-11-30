@extends('layouts.site')

@section('content')
    <div id="app" class="container py-3" style="max-width: 720px;" data-api-endpoint="{{route('api.books.index')}}">
        <h1>Welcome to BookStore</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquam aperiam dolores id, illum
            laudantium molestias obcaecati reprehenderit sed voluptatum? Deserunt dolore dolorum ducimus eius
            exercitationem fuga, nulla omnis vel?</p>

        <hr>

        <form class="d-flex mb-4" role="search">
            <input v-model="query" name="q" class="form-control me-2" type="search"
                   placeholder="Search by title, author, isbn, genre" v-on:input="meta.current_page=1; search();"
                   aria-label="Search by title, author, isbn, genre" value="{{request()->query('q')}}">
            {{--            <button class="btn btn-outline-success" type="submit">Search</button>--}}
        </form>

        <div class="text-center" v-if="loading">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <div id="booksContainer" class="d-none">
            <div class="text-center" v-if="books.length === 0 && loading === false">
                <h2 class="h3">Oops! We looks like there's a typo.</h2>
                <p>Try searching with other keyword</p>
            </div>

            <div v-if="books.length !== 0">
                <div class="mb-2">
                    Showing @{{ meta.from }} to @{{ meta.to }} of @{{ meta.total }}
                </div>

                <nav class="mt-b" aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item" :class="{ disabled: !link.url, active: link.active }"
                            v-for="(link, index) in meta.links" :key="index">
                            <a class="page-link" href="#" v-html="link.label" v-on:click="changePage(link)"></a>
                        </li>
                    </ul>
                </nav>

                <div class="card mb-2" v-for="book in books">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img class="img-fluid" :src="book.image" :alt="book.title">
                            </div>
                            <div class="col-md-9">
                                <h3><a :href="'/' + book.id">@{{ book.title }}</a></h3>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div><b>Author:</b> @{{ book.author }}</div>
                                        <div><b>Genre:</b> @{{ book.genre }}</div>
                                        <div><b>Published:</b> @{{book.published}}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div><b>Publisher:</b> @{{book.publisher}}</div>
                                        <div><b>ISBN:</b> @{{book.isbn}}</div>
                                        <div><b>Price:</b> ₹@{{book.sale_price}}
                                            <del>@{{book.price}}</del>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <nav class="mt-3" aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item" :class="{ disabled: !link.url, active: link.active }"
                            v-for="(link, index) in meta.links" :key="index">
                            <a class="page-link" href="#" v-html="link.label" v-on:click="changePage(link)"></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script
        src="{{\Illuminate\Support\Facades\App::environment('production') ? 'https://unpkg.com/vue@3/dist/vue.global.prod.js' : 'https://unpkg.com/vue@3/dist/vue.global.js' }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.2/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>

    <script type="text/javascript" defer>
        const {createApp} = Vue;
        const searchEndpoint = document.querySelector('#app').dataset.apiEndpoint;

        createApp({
            data() {
                return {
                    loading: false,
                    query: '',
                    books: [],
                    meta: {
                        per_page: 15,
                        current_page: 1,
                        from: 0,
                        to: 0,
                        total: 0,
                        links: [],
                    },
                }
            },
            methods: {
                search: _.throttle(function () {
                    // Prep URL.
                    let url = new URL(searchEndpoint);
                    url.searchParams.append('q', this.query);
                    url.searchParams.append('page', this.meta.current_page);

                    // Execute API call.
                    this.loading = true;
                    axios.get(url).then((res) => {
                        if (res.status === 200) {
                            this.books = res.data.data;
                            this.meta = res.data.meta;
                            // console.log(res);
                        } else {
                            alert('Failed to load data');
                        }
                    }).catch(e => {
                        alert('Something went wrong.');
                        console.error(e);
                    }).finally(() => {
                        this.loading = false;
                        // console.log('Data loading completed.');
                    })
                }, 1000),
                changePage(link) {
                    if (link.url) {
                        let url = new URL(link.url);
                        this.meta.current_page = url.searchParams.get('page');
                        this.search();
                    }
                },
            },
            mounted() {
                this.search();
                document.querySelector('#booksContainer').classList.remove('d-none');
            }
        }).mount('#app')
    </script>
@endpush
