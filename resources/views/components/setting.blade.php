@props(['heading'])

<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{ $heading }}
    </h1>

    <div class="flex">
        <aside class="w-48 flex-shrink-0">

            <h4 class="font-semibold mb-4">Links</h4>

            <ul>
                @can('admin')
                    <li>
                        <a href="/admin/posts" class="{{ request()->is('admin/posts') ? 'text-blue-500' : '' }}">Manage
                            Cottages</a>
                    </li>

                    <li>
                        <a href="/admin/posts/create"
                            class="{{ request()->is('admin/posts/create') ? 'text-blue-500' : '' }}">Add Cottage</a>
                    </li>

                    <li>
                        <a href="/admin/posts/users"
                            class="{{ request()->is('admin/posts/users') ? 'text-blue-500' : '' }}">Manage Users</a>
                    </li>

                    <li>
                        <a href="/admin/posts/bookings"
                            class="{{ request()->is('admin/posts/bookings') ? 'text-blue-500' : '' }}">Manage Bookings</a>
                    </li>
                @endcan
                @can('user')
                    <li>
                        <a href="/user/posts/details"
                            class="{{ request()->is('user/posts/details') ? 'text-blue-500' : '' }}">My Details</a>
                    </li>
                    
                    <li>
                        <a href="/user/posts/bookings"
                            class="{{ request()->is('user/posts/bookings') ? 'text-blue-500' : '' }}">Manage Bookings</a>
                    </li>
                @endcan
            </ul>
        </aside>

        <main class="flex-1">
            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>
    </div>
</section>
