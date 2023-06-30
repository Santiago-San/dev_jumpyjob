<x-navbar>

<div class="bg-[#FFB800]">

    <div class="pt-10 max-w-lg mx-auto">
        <h1 class="text-4xl font-bold text-center mb-10 text-[#720942]"> Profil Vervollständigen</h1>
        <form method="POST" action="/user/profile">
            @csrf

            <div class="mb-6">
                <label for="DoB" class="font-medium"> Geburtsdatum </label>
                <input type="date" class="border border-gray-200 rounded-3xl p-2 w-full" name="DoB" value="{{old('DoB')}}" />

                @error('DoB')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="handynummer" class="font-medium"> Handynummer </label>
                <input type="text" class="border border-gray-200 rounded-3xl p-2 w-full" name="handynummer" value="{{old('handynummer')}}" />

                @error('handynummer')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            
            <div class="mb-6 text-center">
                <button type="submit" class="text-white rounded-3xl py-3 px-6 bg-[#720942] font-bold text-2xl">
                Absenden
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