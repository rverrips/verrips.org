<?php

return [

    'photos' => [
        ['src' => 'docs/images/verrips-2025.png',  'alt' => 'Roy, Luke, Don, Nathan and Angela — Reidville, SC 2025',                          'people' => 'Roy, Luke, Don, Nathan and Angela',              'location' => 'Reidville, SC',  'year' => '2025', 'span' => 'big',  'focus' => 'object-center'],
        ['src' => 'docs/images/verrips-2023.png',  'alt' => 'Don and Jenny Kirkwood, Luke, Angela, Roy, Nathan and Henri — Reidville, SC 2023', 'people' => 'Don & Jenny Kirkwood, Luke, Angela, Roy, Nathan', 'location' => 'Reidville, SC',  'year' => '2023', 'span' => 'big',  'focus' => 'object-center'],
        ['src' => 'docs/images/verrips-2022.png',  'alt' => 'Nathan, Don and Jenny Kirkwood, Angela, Roy and Luke — Greer, SC 2022',            'people' => 'Nathan, Don & Jenny Kirkwood, Angela, Roy, Luke', 'location' => 'Greer, SC',      'year' => '2022', 'span' => 'wide', 'focus' => 'object-top'],
        ['src' => 'docs/images/verrips-2021.png',  'alt' => 'Nathan, Angela, Roy and Luke — Naperville, IL 2021',                               'people' => 'Nathan, Angela, Roy and Luke',                   'location' => 'Naperville, IL', 'year' => '2021', 'span' => 'wide', 'focus' => 'object-top'],
        ['src' => 'docs/images/verrips-2020.png',  'alt' => 'Luke, Roy, Nathan and Angela — Naperville, IL 2020',                               'people' => 'Luke, Roy, Nathan and Angela',                   'location' => 'Naperville, IL', 'year' => '2020', 'span' => 'wide', 'focus' => 'object-top'],
        ['src' => 'docs/images/verrips-2018b.png', 'alt' => 'Luke, Angela, Roy and Nathan — Naperville, IL 2018',                               'people' => 'Luke, Angela, Roy and Nathan',                   'location' => 'Naperville, IL', 'year' => '2018', 'span' => '',     'focus' => 'object-center'],
        ['src' => 'docs/images/verrips-2014.png',  'alt' => 'Nathan, Angela, Luke and Roy — Doha, Qatar 2014',                                  'people' => 'Nathan, Angela, Luke and Roy',                   'location' => 'Doha, Qatar',    'year' => '2014', 'span' => '',     'focus' => 'object-center'],
        ['src' => 'docs/images/verrips-2012.png',  'alt' => 'Nathan, Roy, Angela and Luke — Abu Dhabi 2012',                                    'people' => 'Nathan, Roy, Angela and Luke',                   'location' => 'Abu Dhabi, UAE', 'year' => '2012', 'span' => '',     'focus' => 'object-center'],
        ['src' => 'docs/images/verrips-2010.png',  'alt' => 'Nathan, Angela, Luke and Roy — Dubai 2010',                                        'people' => 'Nathan, Angela, Luke and Roy',                   'location' => 'Dubai, UAE',     'year' => '2010', 'span' => '',     'focus' => 'object-center'],
    ],

    'members' => [
        [
            'id'    => 'roy',
            'name'  => 'Roy',
            'photo' => 'docs/images/Roy-2021-Smile-300x300.png',
            'focus' => 'object-center',
            'role'  => 'IT Director · Auro Hotels',
            'bio'   => 'Works at Auro Hotels in Greenville, SC. When not working, Roy loves reading and dabbles in PHP, JavaScript and Laravel on the side.',
            'links' => [
                ['label' => 'LinkedIn',  'url' => 'https://www.linkedin.com/in/rverrips'],
                ['label' => 'Instagram', 'url' => 'https://www.instagram.com/rverrips'],
                ['label' => 'Facebook',  'url' => 'https://www.facebook.com/rverrips'],
                ['label' => 'Keybase',   'url' => 'https://keybase.io/rverrips'],
            ],
        ],
        [
            'id'    => 'angela',
            'name'  => 'Angela',
            'photo' => 'docs/images/angela-300x300.png',
            'focus' => 'object-top',
            'role'  => 'Bookkeeper · QuickBooks Pro Advisor',
            'bio'   => 'Works from home as a bookkeeper and QuickBooks Pro Advisor. Also a Norwex consultant. Keeps our home a safe haven. Her oven-baked mac &amp; cheese is legendary — come hungry!',
            'links' => [
                ['label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/angela-verrips'],
                ['label' => 'Norwex',   'url' => 'https://angelaverrips.norwex.biz'],
                ['label' => 'Facebook', 'url' => 'https://www.facebook.com/averrips/'],
            ],
        ],
        [
            'id'    => 'nathan',
            'name'  => 'Nathan',
            'photo' => 'docs/images/nathan-300x300.png',
            'focus' => 'object-top',
            'role'  => 'Ophthalmic Scribe · Palmetto Eye &amp; Laser',
            'bio'   => 'Loves the Gray Havens, Lord of the Rings lore, and board games. Part-time student at USC Upstate. Member at Heritage Bible Church, Greenville.',
            'links' => [
                ['label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/nverrips/'],
            ],
        ],
        [
            'id'    => 'luke',
            'name'  => 'Luke',
            'photo' => 'docs/images/luke-300x300.png',
            'focus' => 'object-top',
            'role'  => 'Swing Dancer · Member, Woodruff Road PCA',
            'bio'   => 'Loves deep conversation, Covenant Theology, and Brandon Sanderson. Posts songs to Instagram as <em>Skilsings</em>. Works at Chick-fil-A, Duncan.',
            'links' => [
                ['label' => 'Instagram (SkilfulArcher)', 'url' => 'https://www.instagram.com/skilfularcher'],
                ['label' => 'Instagram (Skilsings)',      'url' => 'https://www.instagram.com/skilsings'],
                ['label' => 'YouTube',                    'url' => 'https://www.youtube.com/@skilfularcher'],
            ],
        ],
        [
            'id'        => 'don',
            'name'      => 'Don',
            'photo'     => 'docs/images/don-80x80.png',
            'focus'     => 'object-top',
            'role'      => 'Angela\'s Dad · Member, Roebuck PCA',
            'bio'       => 'Known as "Wuvie" by the grandkids. Don has been living with us since 2022, after immigrating from South Africa. Records weekly sermons — find the archives on YouTube.',
            'links' => [
                ['label' => 'YouTube',        'url' => 'https://www.youtube.com/@donaldkirkwood'],
                ['label' => 'DonKirkwood.com', 'url' => 'https://www.donkirkwood.com'],
            ],
        ],
        [
            'id'        => 'rachel',
            'name'      => 'Rachel',
            'photo'     => 'docs/images/rachel-80x80.png',
            'focus'     => 'object-center',
            'role'      => 'In God\'s Presence',
            'bio'       => 'Born March 2004. Her constant smile touched everyone it fell upon and we are honoured that God shared her with us, even for such a short time.',
            'links'     => [],
            'memorial'  => true,
            'memorial_year' => '2004',
        ],
        [
            'id'        => 'jenny',
            'name'      => 'Jenny',
            'photo'     => 'docs/images/jenny-300x300.png',
            'focus'     => 'object-top',
            'role'      => 'In God\'s Presence',
            'bio'       => 'Angela\'s Mom. Jenny immigrated with Don from South Africa in 2022 to live with us in Reidville, SC. She went on ahead to be with our Lord in November 2024.',
            'links'     => [],
            'memorial'  => true,
            'memorial_year' => '2024',
        ],
    ],

];
