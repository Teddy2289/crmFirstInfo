<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ATTESTATION</title>
    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 0;
            font-family: Arial;
        }

        .logo {
            max-width: 250px;
        }

        .content {
            margin-top: 4rem;
        }

        .title {
            font-size: 32px;
            text-decoration: underline;
            text-align: center;
            line-height: 40px;
            margin-bottom: 2rem;
        }

        .text {
            font-size: 16px;
            line-height: 27px;
            margin-bottom: 24px;
        }

        .text-justify {
            text-align: justify;
        }

        .text-center {
            text-align: center;
        }

        .content-end {
            display: flex;
            justify-content: flex-end;
            margin-top: 2rem;
        }

        .content-footer {
            text-align: center;
            margin-top: 6rem;
        }

        .text-footer {
            margin-bottom: 8px;
            margin-top: 0;
        }

        .text-medium {
            font-size: 14px;
        }

        .text-small {
            font-size: 12px;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
<div class="container">
    <img src="{{ public_path('assets/images/logo.png') }}" alt="logo" class="logo">
    <div class="content">
        <h1 class="title">ATTESTATION</h1>
        <p class="text text-justify">
            Nous soussignés, <strong>{{ $company->name }}</strong>, dont le siège social est sis 05 Parvis de la Bièvre -
            92160
            ANTONY, certifions que Monsieur <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>, est employé au sein de notre
            Société sous contrat à durée @foreach ($posts as $post) <strong>{{ $post->type_contrat }} </strong>  @endforeach depuis
            le @foreach ($posts as $post)  {{ \Carbon\Carbon::parse($post->start_date)->locale('fr')->isoFormat('LL') }} @endforeach.Il occupe
            actuellement
            le poste de <strong>@foreach ($posts as $post){{ $post->name }}@endforeach</strong>.
        </p>
        <p class="text text-justify">
            Nous certifions également qu'à ce jour, Monsieur <strong>{{ $user->name }}</strong> n'est ni
            démissionnaire, ni en préavis de licenciement.
        </p>
        <p class="text text-justify">En foi de quoi, nous délivrons la présente attestation pour servir et valoir ce que
            de droit.</p>
    </div>
    <div class="content-end">
        <p class="text text-right">
            Fait à Antony, <br>
            {{ \Carbon\Carbon::now()->locale('fr')->translatedFormat('j F Y') }}
        </p>
    </div>
    <div class="content-end">
        <p class="text text-right">
            Claude ANDRIANARIJAONA
            <span class="text-center">Président</span>.
        </p>
    </div>
    <div class="content-footer">
        <p class="text-medium text-footer">SAS FIRSTINFO - {{ $company->address }} - {{ $company->postal_code }}</p>
        <p class="text-small text-footer">Immatriculation au {{ $company->rcs }}</p>
        <p class="text-small text-footer">Numéro URSSAF 117 1566947030</p>
    </div>
</div>
</body>

</html>