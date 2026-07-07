<?php
function gerarRodadasRotativas($jogadores) {
    $ids = array_keys($jogadores);
    $rodadas = [];
    
    for ($r = 1; $r <= 7; $r++) {
        $copia = $ids;
        srand($r + 100);
        shuffle($copia);
        
        $rodadas[$r] = [
            'concluida' => false,
            'jogos' => [
                'quadra1' => [
                    'duplaA' => [$copia[0], $copia[1]],
                    'duplaB' => [$copia[2], $copia[3]],
                    'placarA' => '',
                    'placarB' => ''
                ],
                'quadra2' => [
                    'duplaA' => [$copia[4], $copia[5]],
                    'duplaB' => [$copia[6], $copia[7]],
                    'placarA' => '',
                    'placarB' => ''
                ]
            ]
        ];
    }
    return $rodadas;
}

function gerarRodadasFixas($jogadores) {
    $ids = array_keys($jogadores);
    $rodadas = [];
    
    $duplas = [
        'D1' => [$ids[0], $ids[1]],
        'D2' => [$ids[2], $ids[3]],
        'D3' => [$ids[4], $ids[5]],
        'D4' => [$ids[6], $ids[7]]
    ];
    
    $confrontos = [
        1 => [
            'quadra1' => ['A' => 'D1', 'B' => 'D2'],
            'quadra2' => ['A' => 'D3', 'B' => 'D4']
        ],
        2 => [
            'quadra1' => ['A' => 'D1', 'B' => 'D3'],
            'quadra2' => ['A' => 'D2', 'B' => 'D4']
        ],
        3 => [
            'quadra1' => ['A' => 'D1', 'B' => 'D4'],
            'quadra2' => ['A' => 'D2', 'B' => 'D3']
        ]
    ];
    
    foreach ($confrontos as $r => $quadras) {
        $rodadas[$r] = [
            'concluida' => false,
            'jogos' => [
                'quadra1' => [
                    'duplaA' => $duplas[$quadras['quadra1']['A']],
                    'duplaB' => $duplas[$quadras['quadra1']['B']],
                    'placarA' => '',
                    'placarB' => ''
                ],
                'quadra2' => [
                    'duplaA' => $duplas[$quadras['quadra2']['A']],
                    'duplaB' => $duplas[$quadras['quadra2']['B']],
                    'placarA' => '',
                    'placarB' => ''
                ]
            ]
        ];
    }
    return $rodadas;
}