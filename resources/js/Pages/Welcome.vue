<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import WelcomeSVG1 from "@/assets/svgs/WelcomeSVG1.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>

    <Head title="Welcome" />
    <div class=" bg-unifil text-black/50 ">
        <div
            class="relative flex flex-col items-center justify-start min-h-screen selection:bg-primary selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header
                    class="justify-between w-full fixed top-0  grid grid-cols-2 items-center gap-2 py-10 px-6 lg:grid-cols-3 ">
                    <ApplicationLogo class="block h-16 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black/50 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-primary  dark:focus-visible:ring-white">
                        Dashboard
                        </Link>

                        <template v-else>
                            <Link :href="route('login')"
                                class="rounded-md px-3 py-2 text-black/50 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-primary  dark:focus-visible:ring-white">
                            Log in
                            </Link>

                            <Link v-if="canRegister" :href="route('register')"
                                class="rounded-md px-3 py-2 text-black/50 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-primary  dark:focus-visible:ring-white">
                            Cadastro
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="mt-44">
                    <div class="justify-center flex flex-col items-center">
                        <h1 class=" text-center sm:text-6xl text-4xl font-black">Sistema de Equivalências</h1>
                        <WelcomeSVG1 class="h-96" />
                        <a :href="$page.props.auth.user ? route('dashboard') : route('login')"
                            class="btn btn-primary hover:bg-primary/70 bg-primary w-44 text-center font-bold text-white p-4 text-2xl rounded-lg">Entrar</a>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
