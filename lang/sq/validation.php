<?php

declare(strict_types=1);

return [
    'accepted' => ':Attribute duhet të pranohet.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'active_url' => ':Attribute nuk është adresë e saktë.',
    'after' => ':Attribute duhet të jetë datë pas :date.',
    'after_or_equal' => ':Attribute duhet të jetë datë e barabartë ose pas :date.',
    'alpha' => ':Attribute mund të përmbajë vetëm shkronja.',
    'alpha_dash' => ':Attribute mund të përmbajë vetëm shkronja, numra, dhe viza.',
    'alpha_num' => ':Attribute mund të përmbajë vetëm shkronja dhe numra.',
    'array' => ':Attribute duhet të jetë një bashkësi (array).',
    'before' => ':Attribute duhet të jetë datë para :date.',
    'before_or_equal' => ':Attribute duhet të jetë datë e barabartë ose para :date.',
    'between' => [
        'array' => ':Attribute duhet të ketë ndërmjet :min - :max elementëve.',
        'file' => ':Attribute duhet të jetë ndërmjet :min - :max kilobajtëve.',
        'numeric' => ':Attribute duhet të jetë ndërmjet :min - :max.',
        'string' => ':Attribute duhet të ketë ndërmjet :min - :max karaktereve.',
    ],
    'boolean' => 'Fusha :attribute duhet të jetë e vërtetë ose e gabuar',
    'confirmed' => ':Attribute konfirmimi nuk përputhet.',
    'current_password' => 'The password is incorrect.',
    'date' => ':Attribute nuk është një datë e saktë.',
    'date_equals' => ':Attribute duhet të jetë datë e barabartë me :date.',
    'date_format' => ':Attribute nuk i përshtatet formatit :format.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'different' => ':Attribute dhe :other duhet të jenë të ndryshme.',
    'digits' => ':Attribute duhet të ketë :digits shifra.',
    'digits_between' => ':Attribute duhet të ketë midis :min dhe :max shifra.',
    'dimensions' => ':Attribute ka dimensione të gabuara.',
    'distinct' => ':Attribute ka një vlerë të përsëritur.',
    'doesnt_end_with' => 'The :attribute may not end with one of the following: :values.',
    'doesnt_start_with' => 'The :attribute may not start with one of the following: :values.',
    'email' => ':Attribute formati është i pasaktë.',
    'ends_with' => ':Attribute duhet të përfundojë me një nga vlerat: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => ':Attribute përzgjedhur është i/e pasaktë.',
    'file' => ':Attribute duhet të jetë një fajll.',
    'filled' => 'Fusha :attribute është e kërkuar.',
    'gt' => [
        'array' => ':Attribute duhet të ketë më shumë se :value elemente.',
        'file' => ':Attribute duhet të jetë më i/e madh/e se :value kilobajtë.',
        'numeric' => ':Attribute duhet të jetë më i/e madh/e se :value.',
        'string' => ':Attribute duhet të ketë më shumë se :value karaktere.',
    ],
    'gte' => [
        'array' => ':Attribute duhet të ketë :value ose më shumë elemente.',
        'file' => ':Attribute duhet të jetë më i/e madh/e ose i/e barabartë me :value kilobajtë.',
        'numeric' => ':Attribute duhet të jetë më i/e madh/e ose i/e barabartë me :value.',
        'string' => ':Attribute duhet të ketë :value ose më shumë karaktere.',
    ],
    'image' => ':Attribute duhet të jetë imazh.',
    'in' => ':Attribute përzgjedhur është i/e pasaktë.',
    'in_array' => ':Attribute nuk gjendet në :other.',
    'integer' => ':Attribute duhet të jetë numër i plotë.',
    'ip' => ':Attribute duhet të jetë një IP adresë.',
    'ipv4' => ':Attribute duhet të jetë një IPv4 adresë.',
    'ipv6' => ':Attribute duhet të jetë një IPv6 adresë.',
    'json' => ':Attribute duhet të ketë përmbajtje të vlefshme JSON.',
    'lt' => [
        'array' => ':Attribute duhet të ketë më pak se :value elemente.',
        'file' => ':Attribute duhet të jetë më i/e vogël se :value kilobajtë.',
        'numeric' => ':Attribute duhet të jetë më i/e vogël se :value.',
        'string' => ':Attribute duhet të ketë më pak se :value karaktere.',
    ],
    'lte' => [
        'array' => ':Attribute duhet të ketë :value ose më pak karaktere.',
        'file' => ':Attribute duhet të jetë më i/e vogël ose i/e barabartë me :value kilobajtë.',
        'numeric' => ':Attribute duhet të jetë më i/e vogël ose i/e barabartë me :value.',
        'string' => ':Attribute duhet të ketë :value ose më pak karaktere.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'max' => [
        'array' => ':Attribute nuk mund të ketë më tepër se :max elemente.',
        'file' => ':Attribute nuk mund të jetë më tepër se :max kilobajtë.',
        'numeric' => ':Attribute nuk mund të jetë më tepër se :max.',
        'string' => ':Attribute nuk mund të ketë më tepër se :max karaktere.',
    ],
    'max_digits' => 'The :attribute must not have more than :max digits.',
    'mimes' => ':Attribute duhet të jetë një dokument i tipit: :values.',
    'mimetypes' => ':Attribute duhet të jetë një dokument i tipit: :values.',
    'min' => [
        'array' => ':Attribute nuk mund të ketë më pak se :min elemente.',
        'file' => ':Attribute nuk mund të jetë më pak se :min kilobajtë.',
        'numeric' => ':Attribute nuk mund të jetë më pak se :min.',
        'string' => ':Attribute nuk mund të ketë më pak se :min karaktere.',
    ],
    'min_digits' => 'The :attribute must have at least :min digits.',
    'multiple_of' => ':Attribute duhet të jetë shumë nga :value',
    'not_in' => ':Attribute përzgjedhur është i/e pasaktë.',
    'not_regex' => 'Formati i :attribute është i pasaktë.',
    'numeric' => ':Attribute duhet të jetë një numër.',
    'password' => [
        'letters' => 'The :attribute must contain at least one letter.',
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute must contain at least one number.',
        'symbols' => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => ':Attribute duhet të jetë prezent/e.',
    'prohibited' => 'Fusha :attribute është e ndaluar.',
    'prohibited_if' => 'Fusha :attribute është e ndaluar kur :other është :value.',
    'prohibited_unless' => 'Fusha :attribute është e ndaluar nëse :other është në :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'Formati i :attribute është i pasaktë.',
    'required' => 'Fusha :attribute është e kërkuar.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'Fusha :attribute është e kërkuar kur :other është :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => 'Fusha :attribute është e kërkuar përveç kur :other është në :values.',
    'required_with' => 'Fusha :attribute është e kërkuar kur :values ekziston.',
    'required_with_all' => 'Fusha :attribute është e kërkuar kur :values ekziston.',
    'required_without' => 'Fusha :attribute është e kërkuar kur :values nuk ekziston.',
    'required_without_all' => 'Fusha :attribute është e kërkuar kur nuk ekziston asnjë nga :values.',
    'same' => ':Attribute dhe :other duhet të përputhen.',
    'size' => [
        'array' => ':Attribute duhet të ketë :size elemente.',
        'file' => ':Attribute duhet të jetë :size kilobajtë.',
        'numeric' => ':Attribute duhet të jetë :size.',
        'string' => ':Attribute duhet të ketë :size karaktere.',
    ],
    'starts_with' => ':Attribute duhet të fillojë me njërën nga vlerat: :values.',
    'string' => ':Attribute duhet të jetë varg.',
    'timezone' => ':Attribute duhet të jetë zonë kohore e saktë.',
    'unique' => ':Attribute është marrë tashmë.',
    'uploaded' => ':Attribute dështoi të ngarkohej.',
    'url' => 'Formati i :attribute është i pasaktë.',
    'uuid' => ':Attribute duhet të jetë UUID i/e saktë.',
    'attributes' => [
        'address' => 'address',
        'age' => 'age',
        'amount' => 'amount',
        'area' => 'area',
        'available' => 'available',
        'birthday' => 'birthday',
        'body' => 'body',
        'city' => 'city',
        'content' => 'content',
        'country' => 'country',
        'created_at' => 'created at',
        'creator' => 'creator',
        'current_password' => 'current password',
        'date' => 'date',
        'date_of_birth' => 'date of birth',
        'day' => 'day',
        'deleted_at' => 'deleted at',
        'description' => 'description',
        'district' => 'district',
        'duration' => 'duration',
        'email' => 'email',
        'excerpt' => 'excerpt',
        'filter' => 'filter',
        'first_name' => 'first name',
        'gender' => 'gender',
        'group' => 'group',
        'hour' => 'hour',
        'image' => 'image',
        'last_name' => 'last name',
        'lesson' => 'lesson',
        'line_address_1' => 'line address 1',
        'line_address_2' => 'line address 2',
        'message' => 'message',
        'middle_name' => 'middle name',
        'minute' => 'minute',
        'mobile' => 'mobile',
        'month' => 'month',
        'name' => 'name',
        'national_code' => 'national code',
        'number' => 'number',
        'password' => 'password',
        'password_confirmation' => 'password confirmation',
        'phone' => 'phone',
        'photo' => 'photo',
        'postal_code' => 'postal code',
        'price' => 'price',
        'province' => 'province',
        'recaptcha_response_field' => 'recaptcha response field',
        'remember' => 'remember',
        'restored_at' => 'restored at',
        'result_text_under_image' => 'result text under image',
        'role' => 'role',
        'second' => 'second',
        'sex' => 'sex',
        'short_text' => 'short text',
        'size' => 'size',
        'state' => 'state',
        'street' => 'street',
        'student' => 'student',
        'subject' => 'subject',
        'teacher' => 'teacher',
        'terms' => 'terms',
        'test_description' => 'test description',
        'test_locale' => 'test locale',
        'test_name' => 'test name',
        'text' => 'text',
        'time' => 'time',
        'title' => 'title',
        'updated_at' => 'updated at',
        'username' => 'username',
        'year' => 'year',
    ],
];
