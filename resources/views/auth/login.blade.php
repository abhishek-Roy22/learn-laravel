<x-layout>
    <form action="{{ route('login')}}" method="POST">
    @csrf

    <h2>Log In to Your Account</h2>

    <label for="email">Email:</label>
    <input 
        type="email"
        name="email"
        value="{{ old('email') }}"
        required
        class="border-2 border-gray-400"
    >

    <label for="password">Password:</label>
    <input 
        type="password"
        name="password"
        required
        class="border-2 border-gray-400"
    >

    <button type="submit" class="btn mt-4">Log in</button>


    </form>
</x-layout>