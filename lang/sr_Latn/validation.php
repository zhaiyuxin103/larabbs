<?php

declare(strict_types=1);

return [
    'accepted' => 'Polje :attribute mora biti prihvaćeno.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'active_url' => 'Polje :attribute nije validan URL.',
    'after' => 'Polje :attribute mora biti datum posle :date.',
    'after_or_equal' => 'Polje :attribute mora da bude :date ili kasniji datum.',
    'alpha' => 'Polje :attribute može sadržati samo slova.',
    'alpha_dash' => 'Polje :attribute može sadržati samo slova, brojeve i povlake.',
    'alpha_num' => 'Polje :attribute može sadržati samo slova i brojeve.',
    'array' => 'Polje :attribute mora sadržati nekih niz stavki.',
    'before' => 'Polje :attribute mora biti datum pre :date.',
    'before_or_equal' => ':Attribute mora da bude :date ili raniji datum.',
    'between' => [
        'array' => 'Polje :attribute mora biti između :min - :max stavki.',
        'file' => 'Fajl :attribute mora biti između :min - :max kilobajta.',
        'numeric' => 'Polje :attribute mora biti između :min - :max.',
        'string' => 'Polje :attribute mora biti između :min - :max karaktera.',
    ],
    'boolean' => 'Polje :attribute mora biti tačno ili netačno',
    'confirmed' => 'Potvrda polja :attribute se ne poklapa.',
    'current_password' => 'The password is incorrect.',
    'date' => 'Polje :attribute nije važeći datum.',
    'date_equals' => 'Polje :attribute mora da bude datum: :date.',
    'date_format' => 'Polje :attribute ne odgovora prema formatu :format.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'different' => 'Polja :attribute i :other moraju biti različita.',
    'digits' => 'Polje :attribute mora sadržati :digits šifri.',
    'digits_between' => 'Polje :attribute mora biti izemđu :min i :max šifri.',
    'dimensions' => 'Polje :attribute ime nedozvoljene dimenzije slike.',
    'distinct' => 'Polje :attribute ima dupliranu vrednost.',
    'doesnt_end_with' => 'The :attribute may not end with one of the following: :values.',
    'doesnt_start_with' => 'The :attribute may not start with one of the following: :values.',
    'email' => 'Format polja :attribute nije validan.',
    'ends_with' => 'Polje :attribute mora da se završi sa nečim od sledećeg: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'Odabrano polje :attribute nije validno.',
    'file' => ':Attribute mora da bude datoteka.',
    'filled' => 'Polje :attribute je obavezno.',
    'gt' => [
        'array' => 'Polje :attribute mora da sadrži više od :value stavke.',
        'file' => 'Polje :attribute mora da bude veći od :value kilobajta.',
        'numeric' => 'Polje :attribute mora da bude veći od :value.',
        'string' => 'Polje :attribute mora da sadrži više od :value znakova.',
    ],
    'gte' => [
        'array' => 'Polje :attribute mora da sadrži :value stavki ili više.',
        'file' => 'Polje :attribute mora da ima :value ili više kilobajta.',
        'numeric' => 'Polje :attribute mora da bude :value ili veći.',
        'string' => 'Polje :attribute mora da sadrži :value ili više znakova.',
    ],
    'image' => 'Polje :attribute mora biti slika.',
    'in' => 'Polje Odabrano polje :attribute nije validno.',
    'in_array' => 'Polje :attribute ne postoji u :other.',
    'integer' => 'Polje :attribute mora biti broj.',
    'ip' => 'Polje :attribute mora biti validna IP adresa.',
    'ipv4' => 'Polje :attribute mora da bude važeća IPv4 adresa.',
    'ipv6' => 'Polje :attribute mora da bude važeća IPv6 adresa.',
    'json' => 'Polje :attribute mora da bude važeća JSON niska.',
    'lt' => [
        'array' => 'Polje :attribute mora da sadrži manje od :value stavki.',
        'file' => 'Polje :attribute mora da bude manji od :value kilobajta.',
        'numeric' => 'Polje :attribute mora da bude manji od :value.',
        'string' => 'Polje :attribute mora da sadrži manje od :value znakova.',
    ],
    'lte' => [
        'array' => 'Polje :attribute ne sme da sadrži više od :value stavki.',
        'file' => 'Polje :attribute mora da bude manji od :value kilobajta.',
        'numeric' => 'Polje :attribute mora da bude :value ili manji.',
        'string' => 'Polje :attribute mora da sadrži :value ili manje znakova.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'max' => [
        'array' => 'Polje :attribute ne smije da image više od :max stavki.',
        'file' => 'Polje :attribute mora biti manje od :max kilobajta.',
        'numeric' => 'Polje :attribute mora biti manje od :max.',
        'string' => 'Polje :attribute mora sadržati manje od :max karaktera.',
    ],
    'max_digits' => 'The :attribute must not have more than :max digits.',
    'mimes' => 'Polje :attribute mora biti fajl tipa: :values.',
    'mimetypes' => 'Polje :attribute mora biti fajl tipa: :values.',
    'min' => [
        'array' => 'Polje :attribute mora sadrzati najmanje :min stavku.',
        'file' => 'Fajl :attribute mora biti najmanje :min kilobajta.',
        'numeric' => 'Polje :attribute mora biti najmanje :min.',
        'string' => 'Polje :attribute mora sadržati najmanje :min karaktera.',
    ],
    'min_digits' => 'The :attribute must have at least :min digits.',
    'multiple_of' => 'Број :attribute треба да буде вишеструки од :value',
    'not_in' => 'Odabrani element polja :attribute nije validan.',
    'not_regex' => 'Format :attribute je nevažeći.',
    'numeric' => 'Polje :attribute mora biti broj.',
    'password' => [
        'letters' => 'The :attribute must contain at least one letter.',
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute must contain at least one number.',
        'symbols' => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'Polje :attribute mora da bude prisutno.',
    'prohibited' => 'Поље :attribute је забрањено.',
    'prohibited_if' => 'Поље :attribute је забрањено када је :other :value.',
    'prohibited_unless' => 'Поље :attribute је забрањено, осим ако :other није у :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'Format polja :attribute nije validan.',
    'required' => 'Polje :attribute je obavezno.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'Polje :attribute je potrebno kada polje :other sadrži :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => 'Polje :attribute je obavezno, osim ako je :other u :values.',
    'required_with' => 'Polje :attribute je potrebno kada polje :values je prisutan.',
    'required_with_all' => 'Polje :attribute je obavezno kada je :values prikazano.',
    'required_without' => 'Polje :attribute je potrebno kada polje :values nije prisutan.',
    'required_without_all' => 'Polje :attribute je potrebno kada nijedan od sledeći polja :values nisu prisutni.',
    'same' => 'Polja :attribute i :other se moraju poklapati.',
    'size' => [
        'array' => 'Polje :attribute mora sadržati :size stavki.',
        'file' => 'Fajl :attribute mora biti :size kilobajta.',
        'numeric' => 'Polje :attribute mora biti :size.',
        'string' => 'Polje :attribute mora biti :size karaktera.',
    ],
    'starts_with' => 'Polje :attribute mora da počne sa: :values',
    'string' => 'Polje :attribute mora sadržati slova.',
    'timezone' => 'Polje :attribute mora biti ispravna vremenska zona.',
    'unique' => 'Polje :attribute već postoji.',
    'uploaded' => ':Attribute nije otpremljen.',
    'url' => 'Format polja :attribute ne važi.',
    'uuid' => ':Attribute mora da bude važeći UUID.',
    'attributes' => [
        'address' => 'adresa',
        'age' => 'godine',
        'amount' => 'amount',
        'area' => 'area',
        'available' => 'available',
        'birthday' => 'birthday',
        'body' => 'telo poruke',
        'city' => 'grad',
        'content' => 'content',
        'country' => 'država',
        'created_at' => 'created at',
        'creator' => 'creator',
        'current_password' => 'current password',
        'date' => 'datum',
        'date_of_birth' => 'date of birth',
        'day' => 'dan',
        'deleted_at' => 'deleted at',
        'description' => 'opis',
        'district' => 'district',
        'duration' => 'duration',
        'email' => 'email',
        'excerpt' => 'izvod',
        'filter' => 'filter',
        'first_name' => 'ime',
        'gender' => 'pol',
        'group' => 'group',
        'hour' => 'sat',
        'image' => 'image',
        'last_name' => 'prezime',
        'lesson' => 'lesson',
        'line_address_1' => 'line address 1',
        'line_address_2' => 'line address 2',
        'message' => 'poruka',
        'middle_name' => 'middle name',
        'minute' => 'minut',
        'mobile' => 'mobilni',
        'month' => 'mesec',
        'name' => 'ime',
        'national_code' => 'national code',
        'number' => 'number',
        'password' => 'password',
        'password_confirmation' => 'ponovi password',
        'phone' => 'telefon',
        'photo' => 'photo',
        'postal_code' => 'postal code',
        'price' => 'price',
        'province' => 'province',
        'recaptcha_response_field' => 'recaptcha response field',
        'remember' => 'remember',
        'restored_at' => 'restored at',
        'result_text_under_image' => 'result text under image',
        'role' => 'role',
        'second' => 'sekunda',
        'sex' => 'pol',
        'short_text' => 'short text',
        'size' => 'size',
        'state' => 'state',
        'street' => 'street',
        'student' => 'student',
        'subject' => 'naslov',
        'teacher' => 'teacher',
        'terms' => 'terms',
        'test_description' => 'test description',
        'test_locale' => 'test locale',
        'test_name' => 'test name',
        'text' => 'text',
        'time' => 'vreme',
        'title' => 'naslov',
        'updated_at' => 'updated at',
        'username' => 'username',
        'year' => 'godina',
    ],
];
