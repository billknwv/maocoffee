@extends('layouts.auth')

@section('auth-content')
<div class="flex items-stretch gap-2 p-4 h-screen">
    <!-- section welcome -->
    <div class="flex flex-col justify-center items-center gap-8 p-6 flex-1 self-stretch bg-[#2E4239] rounded-[40px] h-full">
        <div class="flex flex-col items-center gap-4 w-[400px]">
            <div class="text-7xl font-medium text-center text-white leading-[120%] tracking-[-2.88px] w-full">Hello Welcome</div>
            <div class="text-2xl font-normal text-center text-white leading-[120%] tracking-[-0.96px] w-full">If You Don't Have an Account Please Sign Up</div>
        </div>
        <div class="w-fit flex justify-center items-center border border-white rounded-2xl px-6 py-3 text-white text-center text-2xl font-normal leading-[120%] tracking-[-0.96px]">
            <a href="{{ route('signup') }}">Sign Up</a>
        </div>
    </div>

    <!-- section form -->
    <div class="flex flex-col justify-center items-center gap-10 self-stretch flex-1 w-full h-full">
        <div class="flex flex-col items-center justify-center gap-12 w-full max-w-2xl">
            <div class="flex flex-col items-center gap-4">
                 <img src="{{ asset('image/LOGO.png') }}" alt="">
                <div class="w-[362px] text-[#212121] text-5xl text-center font-semibold leading-[120%] tracking-[-1.92px]">Make Your Journey Better</div>
            </div>  

            <!-- Tampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative w-full" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.process') }}" method="POST" class="flex flex-col items-start gap-12 w-full">
                @csrf
                <div class="flex flex-col items-start gap-8 w-full">
                    <!-- Email Field -->
                    <div class="flex flex-col items-start self-stretch gap-2 w-full">
                        <label for="email" class="text-[#212121] text-2xl font-normal leading-[120%] tracking-[-0.64px]">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter your Email" 
                               class="w-full h-16 flex px-6 justify-center items-start self-stretch bg-[#F2F2F2] rounded-4xl @error('email') border border-red-500 @enderror">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="flex flex-col items-start self-stretch gap-2 w-full">
                        <label for="password" class="text-[#212121] text-2xl font-normal leading-[120%] tracking-[-0.64px]">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your Password" 
                               class="w-full h-16 flex px-6 justify-center items-start self-stretch bg-[#F2F2F2] rounded-4xl @error('password') border border-red-500 @enderror">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Tampilkan error umum -->
                @if($errors->has('email'))
                    <div class="text-red-500 text-sm w-full text-center">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <button type="submit" class="flex w-full justify-center py-4 bg-[#2E4239] text-2xl font-normal text-center text-white leading-[120%] tracking-[-0.96px] rounded-2xl hover:bg-[#1a2a22] transition duration-200">
                    Login
                </button>
            </form>

            <div class="text-2xl font-normal text-center text-[#212121] leading-[120%] tracking-[-0.96px]">
                Don't Have an Account? 
                <a href="{{ route('signup') }}" class="text-2xl font-semibold text-[#212121] leading-[120%] tracking-[-0.54px] hover:underline">Sign Up First</a>
            </div>
        </div>
    </div>
</div>
@endsection