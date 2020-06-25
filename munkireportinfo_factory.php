<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Munkireportinfo_model::class, function (Faker\Generator $faker) {

    $starttime = $faker->dateTimeThisMonth();
    $endtime = $faker->dateTimeBetween($starttime, 'now');

    $log_warning = $faker->optional($weight = 0.1)->word;
    $log_error = $faker->optional($weight = 0.1)->word;

    return [
        'version' => $faker->numerify('#####.#'),
        'baseurl' => $faker->randomElement(['http', 'https']) . '://example.com',
        'passphrase' => $faker->word,
        'reportitems' => $faker->sentence,
        'start_time' => $starttime->format('U'),
        'end_time' => $endtime->format('U'),
        'log' => $faker->word,
        'log_warning' => $log_warning,
        'log_error' => $log_error,
        'error_count' => $log_error !== null,
        'warning_count' => $log_warning !== null,
        'upload_size' => $faker->randomDigit . $faker->randomElement(['KB', 'GB', 'MB']),
        'log_size' => $faker->numberBetween(200, 200000),
        'warning_log_size' => $faker->numberBetween(10, 100000),
        'error_log_size' => $faker->numberBetween(10, 100000),
    ];
});


