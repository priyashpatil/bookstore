@extends('layouts.site')

@section('content')
    <div id="app" class="container py-3" style="max-width: 720px;">
        <h1>Welcome to BookStore</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquam aperiam dolores id, illum
            laudantium molestias obcaecati reprehenderit sed voluptatum? Deserunt dolore dolorum ducimus eius
            exercitationem fuga, nulla omnis vel?</p>

        <hr>

        <form class="d-flex mb-4" role="search">
            <input v-model="query" name="q" class="form-control me-2" type="search"
                   placeholder="Search by title, author, isbn, genre" v-on:input="search()"
                   aria-label="Search by title, author, isbn, genre" value="{{request()->query('q')}}">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

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

{{--        @if(count($books))--}}
{{--            <div class="mb-3">--}}
{{--                {{ $books->links() }}--}}
{{--            </div>--}}

{{--            <div class="mt-3">--}}
{{--                {{ $books->links() }}--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="text-center">--}}
{{--                <div class="fs-3">We seems to run out of titles</div>--}}
{{--                <div>Try searching for another keyword.</div>--}}
{{--            </div>--}}
{{--        @endif--}}
    </div>
@endsection

@push('scripts')
    <script
        src="{{\Illuminate\Support\Facades\App::environment('production') ? 'https://unpkg.com/vue@3/dist/vue.global.prod.js' : 'https://unpkg.com/vue@3/dist/vue.global.js' }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.2/dist/axios.min.js"></script>

    <script type="text/javascript">
        const {createApp} = Vue;
        const searchEndpoint = 'http://localhost/api/books';

        createApp({
            data() {
                return {
                    query: null,
                    books: [],
                }
            },
            methods: {
                search: function () {
                    // Prep URL.
                    let url = new URL(searchEndpoint);
                    url.searchParams.append('q', this.query);

                    // Execute API call.
                    axios.get(url).then((res) => {
                        if (res.status === 200) {
                            console.log(res.data.data);
                            this.books = res.data.data;
                        } else {
                            alert('Failed to load data');
                        }
                        // console.log(res.data);
                    }).catch(e => {
                        alert('Something went wrong.');
                        console.error(e);
                    }).finally(() => {
                        console.log('Data loading completed.');
                    })
                },
            },
            mounted() {
                this.search();
            }
        }).mount('#app')
    </script>
@endpush
