<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.admin')] class extends Component {};

?>

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{-- START - BREADCRUMBS --}}
            <x-admin-breadcrumbs />

            {{-- END - BREADCRUMBS --}}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- START SECTION --}}

                    <h1>Item: Laptop</h1>
                    <h1>Price: PHP500</h1>
                    <h1>Quantity: 1</h1>

                    <form action="{{ route('paypal.payment.paypal') }}">
                        @csrf
                        <input type="hidden" name="price" value="500">
                        <input type="hidden" name="product_name" value="Laptop">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit">Submit</button>
                    </form>


                    {{-- END SECTION --}}


                    {{-- ---------------------- --}}
                </div>
            </div>
        </div>
    </div>
</div>
