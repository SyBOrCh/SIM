<?php

use App\Chemical;
use Faker\Generator as Faker;

$factory->define(App\Structure::class, function (Faker $faker) {
    return [
        'n_atoms'       => $faker->numberBetween(2, 10),
        'n_bonds'       => $faker->numberBetween(1, 10),
        'n_rings'       => $faker->numberBetween(0, 3),
        'n_C'           => $faker->numberBetween(0, 10),
        'n_C1'          => $faker->numberBetween(0, 10),
        'n_C2'          => $faker->numberBetween(0, 10),
        'n_CHB1p'       => $faker->numberBetween(0, 10),
        'n_CHB2p'       => $faker->numberBetween(0, 10),
        'n_CHB3p'       => $faker->numberBetween(0, 10),
        'n_CHB4'        => $faker->numberBetween(0, 10),
        'n_O2'          => $faker->numberBetween(0, 10),
        'n_O3'          => $faker->numberBetween(0, 10),
        'n_N1'          => $faker->numberBetween(0, 10),
        'n_N2'          => $faker->numberBetween(0, 10),
        'n_N3'          => $faker->numberBetween(0, 10),
        'n_S'           => $faker->numberBetween(0, 10),
        'n_SeTe'        => $faker->numberBetween(0, 10),
        'n_F'           => $faker->numberBetween(0, 10),
        'n_Cl'          => $faker->numberBetween(0, 10),
        'n_Br'          => $faker->numberBetween(0, 10),
        'n_I'           => $faker->numberBetween(0, 10),
        'n_P'           => $faker->numberBetween(0, 10),
        'n_B'           => $faker->numberBetween(0, 10),
        'n_Met'         => $faker->numberBetween(0, 10),
        'n_X'           => $faker->numberBetween(0, 10),
        'n_b1'          => $faker->numberBetween(0, 10),
        'n_b2'          => $faker->numberBetween(0, 10),
        'n_b3'          => $faker->numberBetween(0, 10),
        'n_bar'         => $faker->numberBetween(0, 10),
        'n_C1O'         => $faker->numberBetween(0, 10),
        'n_C2O'         => $faker->numberBetween(0, 10),
        'n_CN'         => $faker->numberBetween(0, 10),
        'n_XY'         => $faker->numberBetween(0, 10),
        'n_r3'         => $faker->numberBetween(0, 10),
        'n_r4'         => $faker->numberBetween(0, 10),
        'n_r5'         => $faker->numberBetween(0, 10),
        'n_r6'         => $faker->numberBetween(0, 10),
        'n_r7'         => $faker->numberBetween(0, 10),
        'n_r8'         => $faker->numberBetween(0, 10),
        'n_r9'         => $faker->numberBetween(0, 10),
        'n_r10'        => $faker->numberBetween(0, 10),
        'n_r11'        => $faker->numberBetween(0, 10),
        'n_r12'        => $faker->numberBetween(0, 10),
        'n_r13p'       => $faker->numberBetween(0, 10),
        'n_rN'         => $faker->numberBetween(0, 10),
        'n_rN1'        => $faker->numberBetween(0, 10),
        'n_rN2'        => $faker->numberBetween(0, 10),
        'n_rN3p'       => $faker->numberBetween(0, 10),
        'n_rO'         => $faker->numberBetween(0, 10),
        'n_rO1'        => $faker->numberBetween(0, 10),
        'n_rO2p'       => $faker->numberBetween(0, 10),
        'n_rS'         => $faker->numberBetween(0, 10),
        'n_rX'         => $faker->numberBetween(0, 10),
        'n_rar'        => $faker->numberBetween(0, 10),
        'molfile'      => 'fake molfile',
    ];
});
