<?php

namespace AppBundle\DataFixtures\ORM\BaseData;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\Film;

class Load65FilmData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $films = [
            '3M' => [
                '40C',
                '6 Mil Graffiti',
                '7 Mil Security',
                'Aerina SH2FGAR',
                'Affinity 15',
                'Affinity 30',
                'AG-4',
                'Altair (SH2FG AT)',
                'Arpa (SH2FGAP)',
                'Aura SH2PCA9',
                'Blackout',
                'Blackout Vinyl',
                'Blockout Black Adhesive',
                'Blockout White Adhesive',
                'CC75',
                'Ceramic 30',
                'Ceramic 40',
                'Chamonix SH2EM CH',
                'Cielo',
                'CL75',
                'Clear 2 Faded Frost (SH2FGL)',
                'CS20',
                'CS5',
                'Custom Red Vinyl',
                'DF Chill',
                'DRF',
                'Duranodic Bronze Vinyl',
                'Dusted Crystal',
                'Dusted Waters SX-3147',
                'Dusted/Frosted Crystal',
                'Essen SH2EMES',
                'EXTERIOR Prestige 40',
                'EXTERIOR Prestige 70',
                'EXTERIOR Prestige 90',
                'Fine Crystal SH2FNCR',
                'Fine SH2FGFN',
                'Frosted Crystal',
                'Glace SH2MAGL',
                'Graphic Black',
                'Illumina SH2FGIM',
                'Illumina-g SH2FGIM-G',
                'Lattice SH2FGLT',
                'Lausanne (SH2EMLA)',
                'Leise',
                'Linen SH2FGLN',
                'Luce SG2FGLU',
                'Luna 6 SH2PCL6',
                'Luna 6 SH2PCL9',
                'Mare SH2FGMR ',
                'Mat Crystal 2',
                'Matte Crystal',
                'Matte Gray',
                'Milano',
                'Milky Crystal',
                'NV 15',
                'NV 25',
                'NV 35',
                'NV 25 4 Mil',
                'NV 45',
                'OpaqueWhite SH2MAOW',
                'Oslo SH2EMOS',
                'P18',
                'Paracell SH2FGPR',
                'Prestige 40',
                'Prestige 50',
                'Prestige 60',
                'Prestige 70',
                'Prism Silver SH2CSPS',
                'RE 15 SIARXL',
                'RE 20',
                'RE 35',
                'RE 35 NEARLXL',
                'RE 35 SIARXL',
                'RE 50',
                'RE 70',
                'RE35 AMARL',
                'RE50 AMARL',
                'RE65',
                'Rice Paper',
                'Rikyu SH2PTRK',
                'Robe SH2FGRB',
                'S25',
                'S35NEAR400',
                'S40 EXT',
                'S50NEAR400',
                'S600',
                'S70 EXT',
                'S800',
                'Safety S70 SH7CLARL',
                'Safety S80 SH8CLARL',
                'Sagano',
                'San Marino',
                'Satin Aluminum',
                'Seattle',
                'Shutie SH2FGST',
                'Silver',
                'Silver Opaque',
                'Slat-G SH2FGSL-G',
                'Translucent White Vinyl',
                'Tsurugi SH2FGTG',
                'Ultra Neutral S35',
                'Ultra Night Vision S25',
                'Ultra PR50',
                'Ultra Prestige 70',
                'Ultra S400',
                'Ultra S600',
                'Vega SH2FGVG',
                'Venetian SH2FGVN',
                'Vivid Blue',
                'White Electrocut',
                'White/Black Electrocut',
                'Whiteout',
                'Yamato SH2PTYA'
            ],
            'ASWF' => [
                '4 Mil Graffiti',
                '4 Mil Security',
                '6 Mil Graffiti',
                'Blackout',
                'Blackout/Whiteout',
                'Frost',
                'Horizon 20',
                'Removable Whiteout',
                'Whiteout'
            ],
            'Avery' => [
                'Apple Red',
                'Black',
                'Black High Gloss HP700',
                'Cardinal Red',
                'Etchmark',
                'Frosted Sparkle SC900',
                'Light Gold Metallic',
                'Matte Black',
                'MPI 2903',
                'Slate Gray',
                'White Gloss (900)',
            ],
            'Clear Focus' => ['EconoVue 80/20'],
            'Datex' => ['C30', 'C50'],
            'Di-Noc' => ['WG-947'],
            'General Formulations' => [ 'Concept 255', 'Wall Frog 250', 'White Perf. 70/30'],
            'Hanita' => [
                '12 Mil Clear',
                '2 Mil Whiteout',
                '4 Mil Graffiti',
                '6 Mil Graffiti',
                '7 Mil Clear Security',
                '7 Mil Clear Xtra',
                'Blackout',
                'Blue Silver 35 Xtra',
                'C50',
                'Cold Steel 20',
                'Cold Steel 35',
                'Dusted Crystal',
                'E-Lite',
                'Frosted Crystal',
                'Matte 2 Mil',
                'Matte 5 Mil',
                'Natura 15',
                'Optilite 75',
                'Optitune 05',
                'Optitune 15',
                'Optitune 22',
                'Optitune 40',
                'Silver 20 Xtra',
                'Silver 35 Xtra',
                'Silver Matte 20',
                'Silver 20 Xtra PolyZone',
                'Skylight Silver 20',
                'Solar Bronze 20',
                'Solar Bronze 20 Xtra',
                'Titan 07',
                'Titan 20',
                'Titan 35',
                'Titan 50',
                'UV Filter',
            ],
            'Huper' => [
                'ACHT',
                'C20',
                'C30',
                'C40',
                'C5',
                'C50',
                'C60',
                'C70',
                'Ceramic 30',
                'DREI',
                'ESC 35',
                'ESC 45',
                'Exterior Neutral 40',
                'FUSION 10',
                'FUSION 20',
                'FUSION 28',
                'FUSION 30',
                'FUSION 40',
                'Klar 85',
                'Leise',
                'SECH',
            ],
            'Johnson' => [
                'Blue 20',
                'DN 15',
                'DN 35',
                'DN 60',
                'SB 20',
                'SB 50',
                'White Opaque',
            ],
            'Lintec' => [
                '7 Mil Clear Security',
                'E-2000ZC',
                'E-2001RC',
                'E-2100ZC',
                'n1040',
                'R20',
                'Sandblast',
            ],
            'Llumar' => [
                '2 Mil Clear',
                '4 MIL Graffiti',
                '4 MIL Security',
                '6 MIL Graffiti',
                '6 MIL Security',
                '7 Mil Clear Security',
                '8 MIL Security',
                'Air 80',
                'Air 80 EXT',
                'Barcode',
                'BLACKOUT',
                'Blizzard Gradient',
                'Bronze Frost',
                'Ceramic 40',
                'Crackled Glass NRMVCG',
                'Deco Green',
                'Deco Red',
                'Deco Yellow',
                'DL05G',
                'DL15B',
                'DL15G',
                'DL30G',
                'DR15',
                'DR25',
                'DR35',
                'DR45',
                'DRN 25',
                'DRN 35',
                'Dusted Crystal',
                'Dusted Frost',
                'E1220',
                'Etched Frost',
                'Etched Squares',
                'FROST',
                'Frosted Bands',
                'Frosted Glass',
                'Frosted Sparkle',
                'Frosted Squares',
                'Glacier',
                'Green Frost',
                'LS75GREEN',
                'Medium Etch Stripes',
                'Metro',
                'Mini Blinds',
                'Mini Dot Matrix Gradient',
                'Mirrored Mini Dot Gradient',
                'Mist',
                'n1020',
                'n1020 4 Mil',
                'n1020 8 Mil',
                'n1020B',
                'n1035',
                'n1035B',
                'n1040',
                'n1040 4 Mil',
                'n1040 8 Mil',
                'n1050',
                'n1050 4 Mil',
                'n1050 8 Mil',
                'n1050B',
                'n1065',
                'NHE 20',
                'NHE 35',
                'NRM 80 PS2 Mist',
                'NRM FIBG Fiber Glass',
                'NRM MFS Matte Stripes',
                'NRM MSQ Matte Sqs',
                'NRM/ Patterned',
                'NUV 65 4 Mil',
                'Pinstripes',
                'Privacy Stripes',
                'R15BL',
                'R15BR',
                'R15GR',
                'R20',
                'R20 4 MIL',
                'R20 8 Mil',
                'R35',
                'R50',
                'RHE 20',
                'RHE 35',
                'Rice Paper',
                'RN07G',
                'Sandblast',
                'Satin Crystal',
                'Satin Crystal Clear',
                'Silver Frost',
                'Silver Matte',
                'Silver Shimmer',
                'Small Etched Stripes',
                'Thin Lines',
                'UV Clear',
                'V14',
                'V18',
                'V28',
                'V31',
                'V38',
                'V40',
                'V41',
                'V45',
                'V48',
                'V50',
                'V51',
                'V58',
                'VRE20',
                'VS60',
                'VS61',
                'VS70',
                'White Light Diffuser',
                'Whiteout',
            ],
            'Mactac' => ['Rebel Matte White X-Perm 90', 'Roodle'],
            'Madico' => [
                '4 Mil Graffiti',
                '4 MIL Security',
                '6 Mil Graffiti',
                'Blackout',
                'Blackout/Whiteout',
                'Blister Free 2 Mil',
                'Ceramic 30',
                'Ceramic 40',
                'Ceramic 50',
                'Ceramic 60',
                'CH5',
                'CL-700-XSR',
                'Clear Water',
                'DG35',
                'DG45',
                'DG55',
                'FROST',
                'HG816',
                'Ice Crystal',
                'MAC5000',
                'MT-200-X Bronze / Grey 2mil',
                'n1020B',
                'NG-20-CSR',
                'NRW 200 C91',
                'Optivision 15',
                'Optivision 25',
                'Optivision 35',
                'Optivision 45',
                'Optivision 5',
                'P200 PS SR',
                'Purelight 60',
                'RLW150',
                'RS20',
                'SB 35',
                'SB-221-CSR',
                'SB-221-EXSR',
                'SB20',
                'SG 35',
                'Shoji',
                'Silver 15 Ext',
                'SL 180',
                'SRS-220EXSR',
                'SRS-330-CSR',
                'SRS-330EXSR',
                'TSG-335-CSR',
                'UV Gard 250',
                'UV-Gard 200',
            ],
            'MaxPro' => ['Custom Blue'],
            'Oracal' => ['Light Ivory 751CG018', 'Telegrey 751-076'],
            'Pentagon' => ['4 Mil Graffiti'],
            'Permagloss' => ['Saphire Blue'],
            'Rtape' => ['Smooth Gold'],
            'Solar Art' => ['Blackout', 'Custom Blue Exterior', 'Slate 40', 'Stardust'],
            'Solar Gard' => [
                '14 Mil Safety & Security',
                '2 Mil Clear',
                '4 Mil Clear',
                '4 mil Graffiti',
                '6 Mil Graffiti',
                '7 Mil Clear',
                '7 Mil Graffiti',
                '8 Mil Clear',
                'Black Opaque',
                'Bronze 20',
                'Bronze 30',
                'Bronze Silver 15',
                'Bronze Silver Bronze',
                'Clear Frost',
                'Deep Etch',
                'Grey Silver 15',
                'Grey Silver 20',
                'Grey Silver Grey 10',
                'Hilite 40',
                'Hilite 70',
                'HP SS 33',
                'Sentinel Silver 20 OSW',
                'Sentinel SS 15 OSW',
                'Sentinel SS 25 OSW',
                'Sentinel SS 40 OSW',
                'Sentinel SS 45 OSW',
                'Silver 20',
                'Silver 20 4 Mil',
                'Silver 35',
                'Silver 50',
                'Slate 10',
                'Slate 20',
                'Slate 30',
                'Slate 40',
                'Solar Bronze 20',
                'Solar Bronze 35',
                'Stainless Steal 10',
                'Stainless Steal 20',
                'Stainless Steal 30',
                'Stainless Steal 35',
                'Stainless Steal 50',
                'Stainless Steal 70',
                'Stainless Steel 20 4 Mil',
                'Stainless Steel 25',
                'Stainless Steel 40',
                'Stainless Steel 45',
                'Stainless Steel 50 4 Mil',
                'Sterling 20',
                'Sterling 40',
                'Sterling 50',
                'Sterling 60',
                'Sterling 70',
                'TrueVue 15',
                'TrueVue 30',
                'White Opaque',
                'Blackout',
                'Optivision 25',
            ],
            'Solyx' => [
                'Acid Etched',
                'Atlantis Mosaic (SXLT1108G)',
                'Beach Grass Gradient',
                'Broken Lines Gradient',
                'Brushed Metal',
                'Charcoal Matte 35 SXWF-CM',
                'Chicago',
                'Clear Brushed (SXHE-02)',
                'Clear Crushed Glass',
                'Clear Fine Brushed SXL-1017',
                'Clear Frost',
                'Clear Lens SXS2000',
                'Clear Sand Blast',
                'Clear Stucco Ice',
                'Clear Waters (SX-9000-48)',
                'Cool Grey Stripes',
                'Cracked Ice SX-1540',
                'Crosshatch Etch',
                'Crystal Quartz SX-1206',
                'Cut Glass Atlantis',
                'Cut Glass Mosaic SXLT-110G',
                'Cut Glass Neptune',
                'Deep Etch',
                'Deep Etch SXGF-0097',
                'Dusted Crystal',
                'Dusted Etch',
                'Dusted Waters SX-3147',
                'Eco Dusted SX3131',
                'Etch Leise',
                'Etch Transparent Stripes',
                'Etched Squares',
                'Etched Stripes',
                'Feather Gradient',
                'Fiberglass SX39002',
                'Fine Crystal Frost',
                'Fine Sand Static Cling SX-SCO315',
                'Frost Strie (SGV-6613)',
                'Frost Strip Clear (SXC-3510)',
                'Frosted Blue Mist',
                'Frosted Crystal',
                'Frosted Mini Blinds SX-3006',
                'Frosted Sparkle',
                'Frosted Squares',
                'Frosted Stripes (SX-316132)',
                'Frosted Stripes SXC3511',
                'Gotham SX-3148',
                'Gotham(SX-3148)',
                'Ice Blue (SXP056)',
                'Ice Forest',
                'Lite Etch (SXGF-0197)',
                'Manhatten SGD-6001',
                'Metal Lines SXSM700',
                'Micro Dot',
                'Mini Blinds SXHP6001',
                'Olive Gold Dusted Leaf SX 3145',
                'One Way Perforated',
                'Organic Etched Stripes',
                'Random Lines SXC376',
                'Rice Paper',
                'Safety Sand Blast',
                'Sand Matte',
                'Shoji Screen White',
                'Snow White Light Diffuser',
                'Static Cling Rice Paper',
                'SX-1164 Frosted Sq sqs',
                'SX-C300 Dusted Etch',
                'SXC-130SR-46',
                'SXF-5050 Total Blockout',
                'SXWF-CM Charcoal Matte',
                'Transparent White Matte',
                'White 70 Diffuser',
                'White Dot Gradation',
                'White Matte',
                'White Rice Paper SXG-0018',
                'White Squares SCHP2021',
                'White Squares SXC-134SR',
                'White Stripe SXC130',
                'White Stripe Vertical',
                'White Waters',
            ],
            'Suntek' => [
                '11 Mil Security',
                '4 Mil Graffiti',
                '4 Mil Security',
                '6 Mil Graffiti',
                '6MSY25',
                '6MSY35',
                '7 Mil Security',
                '8 Mil Security',
                'Blackout',
                'Carbon 18',
                'DRDS 15',
                'DRDS 25',
                'DRDS 35',
                'DRMDS 7',
                'DRMPS 7',
                'Frost',
                'IDS 20',
                'IDS 35',
                'IDS 50',
                'IXT 20',
                'SB 35',
                'SDS 20',
                'SDS 35',
                'SYDS 15',
                'SYDS 25',
                'SYDS 35',
                'SYLRDS10',
                'ULVDS 40',
                'ULVDS 50',
                'ULVDS 70',
                'VNDS 40',
                'VNDS 30',
            ],
            'View' => ['V28', 'V38', 'VC35', 'VC45', 'VC55', 'VC65', 'VS61'],
            'Vista' => [
                'n1040',
                'V14',
                'V18',
                'V28',
                'V28 8 Mil',
                'V31',
                'V33',
                'V38',
                'v38 8 Mil',
                'V40',
                'V41',
                'V45',
                'V48',
                'V51',
                'V58',
                'VEP 70',
                'VEP35',
                'VNE35',
                'VS60',
                'VS61',
                'VS70',
                'VS80',
            ],
            'VKool' => ['VKool 40', 'VKool 70'],
            'Wintech' => ['Silver 50']

        ];

        foreach ($films as $manufacturer => $filmTypes) {
            foreach ($filmTypes as $filmType) {
                $filmObj = new Film();
                $filmObj->setFilmType($this->getReference('film-type-'.str_replace(' ', '-', strtolower($filmType))));
                $filmObj->setManufacturer(
                    $this->getReference('manufacturer-'.str_replace(' ', '-', strtolower($manufacturer)))
                );

                $this->addReference('film-'.str_replace(' ', '-', strtolower($manufacturer.'-'.$filmType)), $filmObj);

                $manager->persist($filmObj);
            }
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return 65;
    }
}