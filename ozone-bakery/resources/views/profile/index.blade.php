@extends('layouts.main')

@section('content')
    <section class="w-100 px-4 py-5">
        <div class="row d-flex justify-content-center snipcss0-0-0-1">
            <div class="col col-lg-7 mb-4 mb-lg-0 snipcss0-1-1-2">
                <div class="card mt-20">
                    <div class="col-md-8 snipcss0-4-4-10">
                        <div class="card-body p-4 snipcss0-5-10-11">
                            <h6 class="text-2xl font-bold">
                                Profile
                            </h6>
                            <hr class="mt-0 mb-2 snipcss0-6-11-13">
                            <div class="row pt-1 snipcss0-6-11-14">
                                <div class="col-6 mb-3 snipcss0-7-14-15">
                                    <h6 class="font-bold">
                                        Firstname
                                    </h6>
                                    <p class="text-muted snipcss0-8-15-17">
                                        {{ $user->name }}
                                    </p>
                                </div>
                                <div class="col-6 mb-3 snipcss0-7-14-18">
                                    <h6 class="font-bold">
                                        Lastname
                                    </h6>
                                    <p class="text-muted snipcss0-8-18-20">
                                        {{ $user->lastname }}
                                    </p>
                                </div>
                            </div>
                            <h6 class="text-xl font-bold">
                                Personal
                            </h6>
                            <hr class="mt-0 mb-2 snipcss0-6-11-22">
                            <div class="row pt-1 snipcss0-6-11-23">
                                <div class="col-6 mb-3 snipcss0-7-14-18">
                                    <h6 class="font-bold">
                                        Phone
                                    </h6>
                                    <p class="text-muted snipcss0-8-18-20">
                                        {{ $user->tel }}
                                    </p>
                                </div>
                                <div class="col-6 mb-3 snipcss0-7-23-24">
                                    <h6 class="font-bold">
                                        Email
                                    </h6>
                                    <p class="text-muted snipcss0-8-24-26">
                                        {{ $user->email }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

<style>
    * {
        box-sizing: border-box;
    }

    .row>* {
        flex-shrink: 0;
        width: 100%;
        max-width: 100%;
        padding-right: calc(var(--mdb-gutter-x)*0.5);
        padding-left: calc(var(--mdb-gutter-x)*0.5);
        margin-top: var(--mdb-gutter-y);
    }

    .row {
        --mdb-gutter-x: 1.5rem;
        --mdb-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(var(--mdb-gutter-y)*-1);
        margin-right: calc(var(--mdb-gutter-x)*-0.5);
        margin-left: calc(var(--mdb-gutter-x)*-0.5);
    }

    .justify-content-center {
        justify-content: center !important;
    }

    @media (min-width: 200px) {
        .col-lg-7 {
            width: 35%;
        }
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    /*noinspection ALL*/
    .card {
        --mdb-card-border-radius: 0.5rem;
        --mdb-card-box-shadow: 0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04);
        --mdb-card-bg: #fff;

        height: var(--mdb-card-height);
        background-color: var(--mdb-card-bg);
        border: var(--mdb-card-border-width) solid var(--mdb-card-border-color);
        border-radius: var(--mdb-card-border-radius);
        box-shadow: var(--mdb-card-box-shadow);
    }

    .col-6 {
        flex: 0 0 auto;
        width: 50%;
    }
</style>
