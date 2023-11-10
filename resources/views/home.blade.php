<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')

    <title>station velib</title>
</head>

<body class="bg-gradient-to-r from-green-100">


    <div class="container-fuild mx-auto">
        <nav class="px-2 w-full sm:px-4 py-2.5 bg-gradient-to-r from-green-300">
            <div class="flex flex-wrap justify-between items-center">
                <img class="w-12 h-auto"
                    src="https://play-lh.googleusercontent.com/jcLhIO935p_hAmpc75ovKn611o8IQHWGG4_rXT1JZCARnUlmjS24owTrBb79i9otFmg"
                    alt="">

                <div class="hidden w-full md:block md:w-auto">
                    <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                        <li>
                            <a href="{{ route('create.velib') }}" class="block py-2 pr-4 pl-3 text-black  md:p-0 "
                                aria-current="page">Créer une station</a>
                        </li>
                        <li>
                            <a href="{{ url('/') }}"
                                class="block py-2 pr-4 pl-3  text-black  rounded md:bg-transparent md:text-blue-700 md:p-0 "
                                aria-current="page">Rechercher</a>
                        </li>
                        <li>
                            <a href="{{ route('index.velib') }}"
                                class="block py-2 pr-4 pl-3 text-dark rounded md:bg-transparent md:p-0 dark:text-white"
                                aria-current="page">Toutes les stations</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <header class="text-center m-4">
        <h1 class="text-3xl text-green-700">trouve ta station velib'</h1>
    </header>

    <div class="flex justify-center">
        <div class="w-1/2  m-8 rounded">
            @if (session()->has('success'))
                <div class="alert alert-success bg-green-400">
                    {{ session()->get('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger bg-red-500 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>

    </div>

    <form action="{{ route('find.velib') }}" class="text-center m-4" method="post">
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>

                <input type="text" id="first_name"
                    class=" ml-80 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="entrez une station ou une ville" name="velib_name">
            </div>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Rechercher</button>
    </form>


    <div class="flex justify-center flex-wrap">

        @isset($stations)

            @forelse($stations as $station)
                <div class="max-w-sm rounded overflow-hidden shadow-lg m-4">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $station['Nom station'] }}</div>
                        <h5>ville de : {{ $station['ville'] }}</h5>
                        <p class="text-gray-700 text-base">
                            vélos disponibles : {{ $station['Nombre total vélos disponibles'] }}
                            mécaniques : {{ $station['Vélos mécaniques disponibles'] }}
                        </p>
                        <span>Nbres de places: {{ $station['Capacité de la station'] }}</span>
                    </div>
                </div>
            @empty
                <h2 class="text-red-500 text-4xl "> no station found bro!</h2>
            @endforelse

        @endisset
        <!-- Card 1 -->

    </div>

</body>

</html>
