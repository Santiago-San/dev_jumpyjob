<x-navbar>
<div class="h-[calc(100vh-6.75rem)] bg-[#FFB800]">
    <div class="pt-10 max-w-lg mx-auto">
        <h1 class="text-5xl font-bold text-center mt-20 mb-10 text-[#720942]"> Anmelden</h1>
        <form method="POST" action="/users/authenticate">
            @csrf

            <div class="mb-6">
                <input type="email" class="border border-gray-200 rounded-3xl p-2 w-full" name="email" placeholder="E-Mail Adresse" value="{{old('email')}}" />

                @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <input type="password" class="border border-gray-200 rounded-3xl p-2 w-full" name="password" placeholder="Passwort"/>

                @error('password')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6 text-center">
                <button type="submit" class="text-white rounded-3xl py-3 px-6 bg-[#720942] font-bold text-2xl">
                Anmelden
                </button>
            </div>

           <!--  <div class="mt-8">
                <p>
                Already have an account?
                <a href="/login" class="">Login</a>
                </p>
            </div> -->
        </form>
    </div>
</div>
</x-navbar>