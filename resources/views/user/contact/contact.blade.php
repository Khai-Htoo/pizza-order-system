<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div
        class="flex justify-center items-center h-screen bg-gradient-to-r from-indigo-500 from-10% via-sky-500 via-30% to-emerald-500 to-90% ...">
        <div class="">
            <div class=" rounded-lg p-10 bg-slate-100 bg-opacity-30 shadow-lg">

                <form action="{{ route('user#sent') }}" method="post">
                    @csrf
                    <a href="{{ route('user#home') }}"><i class="fa-solid fa-arrow-left"></i></a>
                    <h1 class="text-center text-2xl">Contact Us</h1>
                    <p class="text-center text-xl mt-2 mb-3">
                        Got a question?We'd love to hear from you.Sent us a message!
                        <hr>
                    </p>

                    <label for="">Name</label><br />
                    <input type="text" name="name" placeholder="Enter Your name.."
                        class="w-full border py-1 px-2 rounded-lg mt-1" />
                    @error('name')
                        <small class="text-red-700">{{ $message }}</small><br>
                    @enderror

                    <label for="">Email</label><br />
                    <input type="email" name="email" placeholder="Enter Your Email..."
                        class="w-full border py-1 px-2 rounded-lg " />
                    @error('email')
                        <small class="text-red-700">{{ $message }}</small><br>
                    @enderror
                    <label for="">Message</label><br />
                    <textarea name="message" class="w-full p-2 border rounded-md" placeholder="Enter Your message for us.." cols="30"
                        rows="10"></textarea>
                    @error('message')
                        <small class="text-red-700">{{ $message }}</small>
                    @enderror
                    <button type="submit" class="w-full border py-2 bg-blue-900 text-white rounded-md">
                        Sent
                    </button>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
