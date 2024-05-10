
    function generateEquivalenciasQueries($codigosArray)
    {
        $queries = [];

        $i = 1;

        foreach ($codigosArray as $codigosString) {
            
            $codigos = explode(',', $codigosString);

            foreach ($codigos as $codigo) {
                // $j =1 ;
                // Retrieve the disciplina by codigo
                $disciplina = Disciplinas::where('codigo', $codigo)->first();

                if ($disciplina) {
                    // Construct the SQL query
                    $query = "INSERT INTO disciplinas_equivalencias (disciplinas_id, value) VALUES ('{$disciplina->id}', 'equivalencia {$i}');";
                    // Add the query to the array
                    $queries[] = $query;
                }
                // $j++;
            }
            
            $i++;
        }
        // Dump the array of queries
        dd($queries);
    }



    public function index()
    {
        $codigos1 = "COMP4001,COAP230027,COAP230026,COAP230013,COAP230033,COAP230034,COAP230029,COAP230011,COAP230012,COAP230030,COAP230031,COAP230032,COAP230028,ADS@5018";
        $codigos2 = "COMP3019,COMP4002,EGSW221005,EGSW221001,EGSW221006,EGSW221003,EGSW230028,COAP230027,ADS@5006";
        $codigos3 = "COMP3010,COMP4003,FCOM220003,FCOM221002,ADS@5007";
        $codigos4 = "COMP3006,COMP4004,ALLP221001,ALLP221002,ALLP221003,ALLP221004,ADS@5007";
        $codigos5 = "COMP3005,COMP4005,COAP221003,COAP221008,ADS@5007";
        $codigos6 = "COMP3004,COMP4006,PRIN221001,PRIN221002";
        $codigos7 = "COMP4011,PRIN221003,PRIN221004";
        $codigos8 = "COMP3002,COMP4007,ALLP221006,ALLP221008,ADS@5012";
        $codigos9 = "COMP3007,COMP4008,FCOM221003,FCOM221004,ADS@5004";
        $codigos10 = "COMP3011,COMP4009,ALLP230012,ALLP230008,ADS@5009";
        $codigos11 = "COMP3003,COMP4010,MATE221001,MATE221002,MATE230018";
        $codigos12 = "COMP3016,COMP4016,PRIN220001,PRIN220003";
        $codigos13 = "COMP4022,PRIN220010,PRIN220004";
        $codigos14 = "COMP3020,COMP3014,COMP4022,,ALLP230011,ALLP230014,ALLP230015,ALLP230007,ADS@5015";
        $codigos15 = "COMP3017,COMP4013,EGSW230031,EGSW230005,EGSW230033,ALLP230012,ALLP230008,ADS@5010";
        $codigos16 = "COMP3008,COMP4014,MATE230021,MATE230020,MATE230022,MAPC230001";
        $codigos17 = "COMP3038,COMP4015,GNES230002,GNES230003,GNES230038";
        $codigos19 = "COMP3035,COMP4030,PRIN220006,PRIN220007";

        $codigos20 = "COMP4037,PRIN220008,PRIN220009";


        $codigos21 = "COMP3029,COMP4017,FCOM230001,FCOM230002";


        $codigos22 = "COMP3025,COMP4018,COAP230023,COAP230024";


        $codigos23 = "COMP3012,COMP4019,MATE230002,MATE230024,MATE230025,MATE230026";


        $codigos24 = "COMP3018,COMP4020,BDAD230001,BDAD230002,BDAD230003,BDAD230009,ADS@5008";



        $codigos25 = "COMP3021,COMP4021,ALLP230005,ALLP230006";



        $codigos26 = "COMP3044,COMP4030,COMP4037";



        $codigos27 = "COMP3023,COMP4023,INRC230005,INRC230006,FCOM230009,FCOM230010,FCOM230011,FCOM230012,ADS@5019";


        $codigos28 = "COMP3024,COMP4024,BDAD230004,BDAD230005,BDAD230006,BDAD230007,BDAD230008,COAP230031,ADS@5013";


        $codigos29 = "COMP3031,COMP4025,MATE230013,MAPC230014,MAPC230004";


        $codigos30 = "COMP3034,COMP4026,COAP230029,COAP230011,COAP230012,COAP230030,COAP230031,COAP230032,COAP230028,ADS@5016";


        $codigos31 = "COMP3033,COMP4027,UXUI230001,UXUI230002,UXUI230003,EGSW230036,COAP230030,COAP230027,COAP230028,ADS@5005";

        $codigos32 = "COMP3015,COMP4028,FUNH230001,FUNH230004,FUNH230043,FUNH230044";

        $codigos33 = "COMP4029,ALLP220009,ALLP220010";


        $codigos34 = "COMP4097,EST230168,EST230169";


        $codigos35 = "COMP4031,EXTE230011,EXTE230012";


        $codigos36 = "COMP3041,COMP4032,GEIE230001,GEIE230002,GEIE230003,GEIE230004,PRIN221001,PRIN221002,PRIN221003,ADS@5001";


        $codigos37 = "COMP3013,COMP4033,ESDS230001,ESDS230002,ESDS230003,ESDS230004";

        $codigos38 = "COMP3022,COMP4034,FUNH230046,FUNH230047";

        $codigos39 = "COMP3026,COMP4035,EGSW230024,EGSW230025,EGSW230026,GNES230039";

        $codigos40 = "COMP4036,ALLP220011,ALLP220009";

        $codigos41 = "COMP3042,COMP4098,EST230170,EST230171";


        $codigos42 = "COMP4038,EXTE230013,EXTE230014";


        $codigos43 = "COMP3028,COMP4039,INRC230001,INRC230002,INRC230003,INRC230004,ADS@5021";


        $codigos44 = "COMP4040,ESDS230005,MATE230023,ESDS230001,ESDS230002,ESDS230003,ESDS230004";


        $codigos45 = "COMP4041,EGSW230012,EGSW230013,EGSW230030,INAR230005,INRC230011";

        $codigos46 = "COMP4042,INAR230001,INAR230006,INAR230007,INAR230008,INAR230002";



        $codigos47 = "COMP4043,FUNH230009,FUNH230010,FUNH230011";



        $codigos48 = "COMP4044,COAP230006,COAP230007,COAP221003,COAP221008";



        $codigos49 = "COMP3040,COMP4046,EGSW230007";



        $codigos50 = "COMP3001,COMP4047,GNES230004,GNES230005,GNES230006,GNES230007";


        $codigos51 = "COMP3032,COMP4048,FCOM230003,FCOM230004,FCOM230005,FCOM230006";


        $codigos52 = "COMP4049,INRC230007,INRC230008,INRC230009,GNES230039,INAR230005,INRC230011";



        $codigos53 = "COMP4049,INRC230007,INRC230008,INRC230009";


        $codigos54 = "COMP4050,EGSW230035";




        $codigos55 = "COMP4051,COAP230018,COAP230019,COAP230020,COAP230021";



        $codigos56 = "COMP3045,COMP4052,FUNH230005,FUNH230006,FUNH230045,GNES221003,GNES221004";


        $codigos57 = "COMP3030,COMP4045,TCC230005,TCC230006";



        $codigos58 = "COMP3036,COMP4053,TCC230007,TCC230008";



        $codigos59 = "COMP3039,COMP4054,COAP230001,COAP230002,COAP230003,COAP230004,COAP230005";



        $codigos60 = "COMP3009,FCOM230001,FCOM230002";

        $array = [$codigos1,$codigos2, $codigos3, $codigos4, $codigos5, $codigos6, $codigos7, $codigos8, $codigos9, $codigos10, $codigos11, $codigos12, $codigos13, $codigos14, $codigos15, $codigos16, $codigos17, $codigos19, $codigos20, $codigos21, $codigos22, $codigos23, $codigos24, $codigos25, $codigos26, $codigos27, $codigos28, $codigos29, $codigos30, $codigos31, $codigos32, $codigos33, $codigos34, $codigos35, $codigos36, $codigos37, $codigos38, $codigos39, $codigos40, $codigos41, $codigos42, $codigos43, $codigos44, $codigos45, $codigos46, $codigos47, $codigos48, $codigos49, $codigos50, $codigos51, $codigos52, $codigos53, $codigos54, $codigos55, $codigos56, $codigos57, $codigos58, $codigos59, $codigos60];

        $this->generateEquivalenciasQueries($array);
