<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Introduction</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    <!-- jQuery then DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
</head>

<body class="min-h-screen bg-gray-100 flex flex-col">
    @include('homepage.layouts.header')

    <section class="max-w-7xl mx-auto px-6 py-16 grid">
        <div class="flex flex-col justify-center px-8 md:px-16 py-12 text-black">
            <h2 class="md:text-5xl font-bold leading-tight mb-4">
                <span class="whitespace-nowrap block text-center text-4xl">HIGH COURT LEGAL SERVICES COMMITTEE</span>
                <span class="text-[#FFD700] block mt-4 text-2xl">INTRODUCTION</span>
            </h2>
            <p class="mt-3 text-xl indent-4 md:indent-8 text-justify">
                The High Court Legal Services Committee gives free Legal Aid for filing or defending a Case before the
                Hon'ble High Court of Manipur.
                The Service of Legal aid panel Lawyers is made available to the parties in deserving Cases upon
                receiving the application from them for the same.
                Persons eligible for Legal Aid as per Section 12 of The Legal Services Authority Act, 1987, which is as
                follows: (a) a member of a Scheduled Caste
                or Scheduled Tribe; (b) a victim of trafficking in human beings or beggar as referred to in article 23
                of the Constitution; (c) a woman or a
                child; (d) a person with disability as defined in clause (i) of section 2 of the Persons With
                Disabilities (Equal Opportunities, Protection of Rights and Full Participation) Act, 1995 (1 of 1996);
                (e) a person under circumstances of underserved want such as being a victim of a mass disaster, ethnic,
                violence, caste atrocity, flood, drought, earthquake or industrial disaster; or (f) an industrial
                workman; or (g) in custody, including custody in a protective home within the meaning of clause (g) of
                section 2 of the Immoral Traffic (Prevention) Act, 1956 (104 of 1956), or in a juvenile home within the
                meaning of clause (j) of section 2 of the Juvenile Justice Act, 1986 (53 of 1986), or in a psychiatric
                hospital or psychiatric nursing home within the meaning of clause (g) of section 2 of the Mental Health
                Act, 1987 (14 of 1987); or (h) in receipt of annual income less than rupees nine thousand or such other
                higher amount as may be prescribed by the State Government, if the case is before a court other than the
                Supreme Court, and less than rupees twelve thousand or such other higher amount as may be prescribed by
                the Central Government, if the case is before the Supreme Court.
            </p>

            <span class="text-[#FFD700] block mt-5 text-2xl font-bold">AIM & OBJECTIVE</span>
            <p class="mt-3 text-xl indent-4 md:indent-8 text-justify">
                To provide free and competent legal services to the weaker sections of the society to ensure that
                opportunities for securing justice are not denied to any citizen because of economic or other
                disabilities and to organise Lok Adalats to secure the operation of the legal system promotes justice
                based on equal opportunity.
            </p>
        </div>
        <div class="mt-6 flex justify-center">
            <button
                class="bg-black text-white text-xl md:text-md font-semibold px-3 py-1.5 rounded-md shadow-[0_2px_0_0_#facc15] hover:translate-y-[1px] transition-all duration-200">
                How to apply for Legal Aid & Eligibility
            </button>
        </div>
    </section>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a2e0e6ad52.js" crossorigin="anonymous"></script>

    @include('homepage.layouts.footer')
</body>
