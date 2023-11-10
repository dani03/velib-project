<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= , initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" />

    @vite('resources/css/app.css')

</head>

<body class="bg-gradient-to-r from-green-100">
    <div class="container mx-auto">
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

    <header class="flex justify-center align-text-bottom text-3xl mt-6">
        <h4>editer la station <b>{{ $station['Nom station'] }}</b> id: {{ $station['Identifiant'] }} </h4>
    </header>
    <div class="w-1/2 m-8 rounded">
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
    <div class="w-full flex justify-center">
        <form action="{{ route('update.station', ['station' => $station['theid']]) }}"
            class="w-full max-w-lg mt-16 align-center" method="post">
            @csrf
            @method('put')
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-first-name">
                        Nom de la station
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="grid-first-name" name="ville" value="{{ $station['Nom station'] }}" type="text"
                        placeholder="Jane">
                </div>

            </div>

            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                        Commune
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-city" type="text" name="commune" value="{{ $station['ville'] }}"
                        placeholder="Albuquerque">
                </div>


            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">valider</button>
        </form>

    </div>

</body>

</html>
