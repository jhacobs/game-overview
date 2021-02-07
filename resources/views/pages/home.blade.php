<x-layout>
    <div>
        <div class="page flex">
            <nav class="h-screen w-1/4 border-r border-opacity-20 border-gray-200 pt-8 px-12">
                <h1 class="text-center font-bold text-white font-bold text-2xl">Games</h1>
                <input type="text" placeholder="zoeken" class="w-full mt-4 h-10 pl-3 rounded outline-none">
            </nav>
            <main class="h-screen py-8 px-12 w-3/4">
                <livewire:popular-games />
            </main>
        </div>
    </div>
</x-layout>
