<!doctype html>

<title>Scotland Cottages</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<link rel="stylesheet" href="/public/css/app.css">


<!--Calendar-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<!--Calendar-->


<style>
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        display: none;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rated:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    .star-rating-complete {
        color: #c59b08;
    }

    .rating-container .form-control:hover,
    .rating-container .form-control:focus {
        background: #fff;
        border: 1px solid #ced4da;
    }

    .rating-container textarea:focus,
    .rating-container input:focus {
        color: #000;
    }

    .rated {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rated:not(:checked)>input {
        position: absolute;
        display: none;
    }

    .rated:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ffc700;
    }

    .rated:not(:checked)>label:before {
        content: '★ ';
    }

    .rated>input:checked~label {
        color: #ffc700;
    }

    .rated:not(:checked)>label:hover,
    .rated:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rated>input:checked+label:hover,
    .rated>input:checked+label:hover~label,
    .rated>input:checked~label:hover,
    .rated>input:checked~label:hover~label,
    .rated>label:hover~input:checked~label {
        color: #c59b08;
    }
</style>

<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">

            <div id="links">
                @auth
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button class="text-xs font-bold uppercase">Welcome {{ auth()->user()->name }}!</button>
                        </x-slot>

                        @can('admin')
                            <x-dropdown-item href="/cottages" :active="request()->is('user/posts/details')">Cottages</x-dropdown-item>
                            <x-dropdown-item href="/admin/posts" :active="request()->is('admin/posts')">Manage Cottages</x-dropdown-item>
                            <x-dropdown-item href="/admin/posts/create" :active="request()->is('admin/posts/create')">Add Cottages</x-dropdown-item>
                            <x-dropdown-item href="/admin/posts/users" :active="request()->is('admin/posts/users')">Manage Users</x-dropdown-item>
                            <x-dropdown-item href="/admin/posts/bookings" :active="request()->is('admin/posts/bookings')">ManageBookings</x-dropdown-item>
                        @endcan

                        @can('user')
                            <x-dropdown-item href="/cottages" :active="request()->is('user/posts/details')">Cottages</x-dropdown-item>
                            <x-dropdown-item href="/user/posts/details" :active="request()->is('user/posts/details')">My Details</x-dropdown-item>
                            <x-dropdown-item href="/user/posts/bookings" :active="request()->is('user/posts/bookings')">Manage Bookings</x-dropdown-item>
                        @endcan

                        <x-dropdown-item href="#" x-data="{}"
                            @click.prevent="document.querySelector('#logout-form').submit()">Log Out</x-dropdown-item>

                        <form id="logout-form" method="POST" action="/logout" class="hidden">
                            @csrf
                            <button type="sumbit">Log Out</button>
                        </form>

                    </x-dropdown>
                @else
                    <a href="/cottages" class="text-xs font-bold uppercase">Cottages</a>
                    <a href="/register" class="ml-6 text-xs font-bold uppercase">Register</a>
                    <a href="/login" class="ml-6 text-xs font-bold uppercase">Log In</a>
                @endauth
            </div>
        </nav>
        <a href="/">
            <h1 id="title">
                Scotland Cottages
            </h1>
        </a>
        {{ $slot }}

    </section>
    <x-flash />
</body>
