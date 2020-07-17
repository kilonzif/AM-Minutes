<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CaseCharge;
use App\Admission;
use App\AdmissionCase;
use App\User;
use App\Inmate;
use App\Charge;
use App\Offence;
use App\DefaultOffence;
use App\Court;
use App\DefaulterSheet;
use App\Cases;
use App\Fine;
use App\FinePayment;
use App\Note;
use App\Warrant;
use App\Prison;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
function autoIncrement()
{
    for ($i = 0; $i <= 25; $i++) {
        yield $i;
    }
}



$autoIncrement1 = autoIncrement();
$autoIncrement2 = autoIncrement();
$autoIncrement3 = autoIncrement();
$autoIncrement4 = autoIncrement();
$autoIncrement5 = autoIncrement();
$autoIncrement6 = autoIncrement();
$autoIncrement7 = autoIncrement();
$autoIncrement8 = autoIncrement();
$autoIncrement8 = autoIncrement();
$autoIncrement9 = autoIncrement();
$autoIncrement10 = autoIncrement();
$autoIncrement11 = autoIncrement();

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Inmate::class, function(Faker $faker) use
($autoIncrement1) {
    $autoIncrement1->next();
    return [
        'name' => $faker->firstName,
        'fathers_name' => $faker->lastName,
        'grandfathers_name' => $faker->lastName,
        'date_of_birth' => date_create("10-10-1996"),
        'country_id' => 1,
        'gender' => 'Male',
        'profile_picture' => 'avatar-m-1.png',
        'state_id' => 2,
        'time_spent_in_prison' => "Six months or Under",
        'no_of_times_previously_imprisoned' => $faker->numberBetween(1, 10),
        'active' => true,
        'fext' => $faker->numberBetween(1, 10),
        'prison_id' => $autoIncrement1->current(),
        'home_address' => $faker->address,
        'trade' => $faker->jobTitle,
        'no_of_search_slip' => $faker->numberBetween(1, 7),
        'date_record_slip_taken' => date_create("10-10-1996"),
        'standard_of_literacy' => $faker->word,
        'physical_peculiarities' => $faker->word,
        'name_of_next_of_kin' => $faker->name,
        'address_of_next_of_kin' => $faker->address,
    ];
});


$factory->define(Admission::class, function (Faker $faker) use
($autoIncrement2) {
    $autoIncrement2->next();
    return [
        'date_of_admission' => date_create("10-10-2005"),
        'date_of_arrival' => date_create("09-10-1996"),
        'date_to_be_released' => date_create("10-10-2025"),
        'inmate_id' => $autoIncrement2->current(),
        'prison_id' => $autoIncrement2->current(),
//        'state_id' => 2,
        'prisoners_no' => '2019/'.$autoIncrement2->current(),
        'ward_id' => $autoIncrement2->current(),
        'from_where_received_type' => 'Court',
        'from_where_received_id' => $faker->numberBetween(1, 25),
        'kind_of_prison_treatment' => $faker->word,
    ];
});

$factory->define(Charge::class, function (Faker $faker){
    return [
        'name' => $faker->word,
        'section_of_law' => $faker->word,
    ];
});

$factory->define(Offence::class, function (Faker $faker){
    return [
        'name' => $faker->word,
        'prison_regulation_no' => $faker->numberBetween(200, 400),
    ];
});

$factory->define(Prison::class, function (Faker $faker){
    return [
        'name' => $faker->company . " Prison",
        'location' => $faker->streetAddress,
    ];
});

$factory->define(Court::class, function (Faker $faker){
    return [
        'name' => $faker->company . " Court",
        'location' => $faker->streetAddress,
    ];
});

$factory->define(DefaulterSheet::class, function (Faker $faker) use
($autoIncrement3) {
    $autoIncrement3->next();

    return [
        'inmate_id' => $autoIncrement3->current(),
        'prison_id' => $faker->numberBetween(1, 25),
        'status' => $faker->word,
        /*'offence' => $faker->word,*/
        'date_case_tried' => $faker->date(),
        'date_of_offence' => $faker->date(),
        'witnesses' => $faker->titleFemale . $faker->firstNameFemale . ' ' . $faker->lastName,
        'punishment' => $faker->word,
//        'no_of_offence_in_prison_regulations' => $faker->numberBetween(1, 10),
        'by_whose_order' => $faker->name,
        'no_of_receipt' => $faker->randomNumber(),
        'date_on_receipt' => $faker->date(),
        'accountant_initials' => $faker->name,
        'active' => true,
    ];
});

$factory->define(Fine::class, function (Faker $faker) use
($autoIncrement4) {
    $autoIncrement4->next();

    $fine = $faker->numberBetween(1, 10000);
    return [
        'inmate_id' => $autoIncrement4->current(),
        'amount_of_fine' => $fine,
        'amount_of_remission_sentence_years' => $faker->numberBetween(1, 100),
        'amount_of_remission_sentence_months' => $faker->numberBetween(1, 13),
        'amount_of_remission_sentence_days' => $faker->numberBetween(1, 32),
        'case_charge_id' => $autoIncrement4->current(),
        'due_date' => $faker->date(),
        'date_actually_guaranteed' => $faker->date(),
        'date_eligible_for_guarantee' => $faker->date(),
        'active' => true,
    ];
});

$factory->define(FinePayment::class, function (Faker $faker) use
($autoIncrement10) {
    $autoIncrement10->next();

    $finePayment = $faker->numberBetween(1, 10000);
    return [
        'fine_id' => $autoIncrement10->current(),
        'amount_paid' => $faker->numberBetween(100,1000),
        'receipt_no' => $faker->numberBetween(1, 100),
        'date_of_payment' => $faker->date(),
        'place_of_payment' => $faker->city,
        'method_of_payment' => "cash",
        'accepted_by' => $faker->name,
        'patron_name' => $faker->name,
        'inmate_relation' => 'Parent',
    ];
});


$factory->define(Note::class, function (Faker $faker) use
($autoIncrement5) {
    $autoIncrement5->next();

    return [
        'user_id' => 1,
        'inmate_id' => $autoIncrement5->current(),
        'notes_on_history_of_prisoner' => $faker->sentence(),
        'date_notes_was_recorded' => $faker->date(),
        'active' => true,
    ];
});

$factory->define(Warrant::class, function (Faker $faker) use
($autoIncrement6) {
    $autoIncrement6->next();

    return [
        'inmate_id' => $autoIncrement6->current(),
        'expiry_date' => $faker->date(),
        'disposed_of_date' => $faker->date(),
        'reason_for_disposed_date' => $faker->sentence(),
        'place_nice_investigation' => $faker->streetAddress,
        'no_of_investigation' => $faker->numberBetween(1, 10),
        'warrant_signee' => $faker->name(),
        'place_signed' => $faker->city,
        'date_signed' => $faker->date(),
        'active' => true,
    ];
});

$factory->define(Cases::class, function (Faker $faker) use
($autoIncrement7) {
    $autoIncrement7->next();
    return [
        'inmate_id' => $autoIncrement7->current(),
        'admission_id' => $autoIncrement7->current(),
        'case_no' => $faker->numberBetween(100, 200),
        'court_id' => $faker->numberBetween(1, 25),
        'court_data' => $faker->sentence(),
        'prison_id' => $faker->numberBetween(1, 25),
        'period_of_sentence_years' => $faker->numberBetween(1, 100),
        'period_of_sentence_months' => $faker->numberBetween(1, 11),
        'period_of_sentence_days' => $faker->numberBetween(1, 30),
        'type_of_sentence_id' => $faker->numberBetween(1, 4),
        'date_sentence_begins' => $faker->date(),
        'date_sentence_ends' => $faker->date(),
        'active' => true,
    ];
});

$factory->define(CaseCharge::class, function (Faker $faker) use
($autoIncrement8) {
    $autoIncrement8->next();
    return [
        'case_id' => $autoIncrement8->current(),
        'charge_id' => $autoIncrement8->current(),
        'inmate_id' => $autoIncrement8->current(),
        'count' => $faker->numberBetween(1, 3)
    ];
});

$factory->define(DefaultOffence::class, function (Faker $faker) use
($autoIncrement9) {
    $autoIncrement9->next();
    return [
        'default_id' => $autoIncrement9->current(),
        'offence_id' => $autoIncrement9->current(),
        'inmate_id' => $autoIncrement9->current(),
    ];
});

//$factory->define(AdmissionCase::class, function (Faker $faker) use
//($autoIncrement11) {
//    $autoIncrement11->next();
//    return [
//        'admission_id' => $autoIncrement11->current(),
//        'case_id' => $autoIncrement11->current(),
//    ];
//});




