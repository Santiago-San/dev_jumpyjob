<?php
use App\Http\Controllers\PipedriveController;
?>
<x-navbar>
<div class="bg-[#FFB800]">
    <?php
    
    $pipedrive = new PipedriveController();
    $pipedrive->deal('12162');
    var_dump($pipedrive->result);
    $users = DB::table('user_data')->get();
    var_dump($users);
    
    $user_id = auth()->id();
    $check_complete = DB::table('user_data')->whereIn('user_id', array($user_id))->get('DoB');
   /*  var_dump($check_complete);

    if(empty($check_complete[0])){
        echo 'incomplete';
    }
    else{
        echo 'complete';
    } */
    ?>
    
    @if (empty($check_complete[0]))
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

                <div class="mb-6">
                    <p> Hast du schon die Sachkundeprüfung §34a? </p>
                        <div>
                            
                            <input type="radio" class="" id="" name="34a" value="ja" />
                            <label for=""> Ja </label>
                        </div>
                        <div>
                            
                            <input type="radio" class="" id="no34a" name="34a" value="nein" />
                            <label for=""> Nein </label>
                        </div>
                        <div id="readyforclass" class="hidden">
                            <div>
                                <p>Bist du bereit eine kostenfreie 60-tägige Weiterbildung zu machen?</p>
                                <input type="radio" class="" id="" name="" value="ja" />
                                <label for=""> Ja </label>
                                <input type="radio" class="" id="" name="" value="nein" />
                                <label for=""> Nein </label>
                            </div>
                        </div>

                    @error('handynummer')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="mb-6 text-center">
                    <button type="submit" class="text-white rounded-3xl py-3 px-6 bg-[#720942] font-bold text-2xl">
                    Absenden
                    </button>
        </div>

    @else
    <p>User Profile Complete, Frontend folgt...</p>
    @endif
    
        
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